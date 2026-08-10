<?php

namespace App\Http\Controllers;

use App\Models\Oficio;
use App\Models\Departamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

/**
 * Controlador para asistentes autenticadas.
 * Solo gestiona oficios del departamento del usuario en sesión.
 */
class OficioController extends Controller
{
    /**
     * Obtiene el departamento_id del usuario en sesión,
     * a través de su empleado vinculado.
     */
    private function departamentoId(): ?int
    {
        $user = Auth::user();

        // Admin puede ver todo — no restricción
        if ($user->hasRole('Administrador')) {
            return null;
        }

        return optional($user->empleado)->departamento_id;
    }

    /** Listado de oficios del departamento del usuario. */
    public function index(Request $request)
    {
        $user         = Auth::user();
        $deptoId      = $this->departamentoId();
        $anioFiltro   = $request->get('anio', Carbon::now()->year);
        $estatusFiltro = $request->get('estatus');
        $busqueda     = $request->get('q');

        $query = Oficio::with(['departamento', 'registradoPor'])
            ->orderByDesc('created_at');

        // Filtrar por departamento si NO es administrador
        if ($deptoId) {
            $query->where('departamento_id', $deptoId);
        }

        if ($anioFiltro) {
            $query->where('anio', $anioFiltro);
        }

        if ($estatusFiltro) {
            $query->where('estatus', $estatusFiltro);
        }

        if ($busqueda) {
            $query->where(function ($q) use ($busqueda) {
                $q->where('numero_oficio', 'like', "%{$busqueda}%")
                  ->orWhere('asunto', 'like', "%{$busqueda}%")
                  ->orWhere('dirigido_a', 'like', "%{$busqueda}%");
            });
        }

        $oficios = $query->get();

        // Datos del departamento actual para el encabezado
        $departamento = $deptoId
            ? Departamento::find($deptoId)
            : null;

        // Años disponibles para el filtro
        $aniosDisponibles = Oficio::when($deptoId, fn($q) => $q->where('departamento_id', $deptoId))
            ->selectRaw('DISTINCT anio')
            ->orderByDesc('anio')
            ->pluck('anio')
            ->push(Carbon::now()->year)
            ->unique()
            ->sort()
            ->values();

        // Stats del año seleccionado
        $stats = [
            'total'     => $oficios->count(),
            'pendiente' => $oficios->where('estatus', 'Pendiente')->count(),
            'entregado' => $oficios->where('estatus', 'Entregado')->count(),
            'cancelado' => $oficios->where('estatus', 'Cancelado')->count(),
        ];

        return view('oficios.index', compact(
            'oficios', 'departamento', 'anioFiltro', 'aniosDisponibles',
            'estatusFiltro', 'busqueda', 'stats'
        ));
    }

    /** Guarda un nuevo oficio y genera el folio automáticamente. */
    public function store(Request $request)
    {
        $user    = Auth::user();
        $deptoId = $this->departamentoId();

        // Si no tiene departamento asignado, bloquear
        if (! $deptoId && ! $user->hasRole('Administrador')) {
            return response()->json([
                'success' => false,
                'message' => 'Tu usuario no tiene un departamento asignado. Contacta al administrador.',
            ], 422);
        }

        // Si es admin puede seleccionar el departamento
        if ($user->hasRole('Administrador') && $request->filled('departamento_id')) {
            $deptoId = $request->departamento_id;
        }

        $data = $request->validate([
            'fecha_registro'        => 'required|date',
            'jefe_referencia'       => 'required|string|max:255',
            'registrado_por_nombre' => 'required|string|max:255',
            'asunto'                => 'required|string|max:500',
            'dirigido_a'            => 'required|string|max:255',
        ]);

        $anio   = Carbon::parse($data['fecha_registro'])->year;
        $folio  = Oficio::siguienteNumero($deptoId, $anio);

        $oficio = Oficio::create([
            'numero_oficio'         => $folio['numeroOficio'],
            'consecutivo'           => $folio['consecutivo'],
            'anio'                  => $anio,
            'departamento_id'       => $deptoId,
            'registrado_por_user_id'=> $user->id,
            'fecha_registro'        => $data['fecha_registro'],
            'jefe_referencia'       => $data['jefe_referencia'],
            'registrado_por_nombre' => $data['registrado_por_nombre'],
            'asunto'                => $data['asunto'],
            'dirigido_a'            => $data['dirigido_a'],
            'estatus'               => 'Pendiente',
        ]);

        $oficio->load('departamento', 'registradoPor');

        return response()->json([
            'success' => true,
            'message' => "Oficio {$oficio->numero_oficio} registrado correctamente.",
            'oficio'  => $this->formatOficio($oficio),
        ]);
    }

    /** Detalle completo de un oficio (modal). */
    public function show(Oficio $oficio)
    {
        $this->autorizarAcceso($oficio);
        $oficio->load('departamento', 'registradoPor');

        return response()->json([
            'success' => true,
            'oficio'  => $this->formatOficio($oficio),
        ]);
    }

    /** Cancela un oficio. */
    public function cancelar(Request $request, Oficio $oficio)
    {
        $this->autorizarAcceso($oficio);

        if ($oficio->estatus === 'Cancelado') {
            return response()->json([
                'success' => false,
                'message' => 'El oficio ya está cancelado.',
            ], 422);
        }

        $data = $request->validate([
            'motivo_cancelacion' => 'nullable|string|max:500',
        ]);

        $oficio->update([
            'estatus'             => 'Cancelado',
            'cancelado_por'       => Auth::user()->name,
            'motivo_cancelacion'  => $data['motivo_cancelacion'] ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Oficio cancelado correctamente.',
            'oficio'  => $this->formatOficio($oficio->fresh('departamento', 'registradoPor')),
        ]);
    }

    /** Guarda el acuse (URL de OneDrive) en el oficio. */
    public function subirAcuse(Request $request, Oficio $oficio)
    {
        $this->autorizarAcceso($oficio);

        $data = $request->validate([
            'acuse_url'    => 'required|url|max:500',
            'acuse_nombre' => 'nullable|string|max:255',
            'fecha_acuse'  => 'nullable|date',
        ]);

        $oficio->update([
            'acuse_url'    => $data['acuse_url'],
            'acuse_nombre' => $data['acuse_nombre'] ?? 'Acuse',
            'fecha_acuse'  => $data['fecha_acuse'] ?? now()->toDateString(),
            'estatus'      => 'Entregado',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Acuse registrado. El oficio fue marcado como Entregado.',
            'oficio'  => $this->formatOficio($oficio->fresh('departamento', 'registradoPor')),
        ]);
    }

    // ─── Helpers privados ────────────────────────────────────────────────────

    /**
     * Verifica que el usuario pueda acceder al oficio.
     * Administradores pueden ver todos. Asistentes solo los de su departamento.
     */
    private function autorizarAcceso(Oficio $oficio): void
    {
        $user    = Auth::user();
        $deptoId = $this->departamentoId();

        if (! $user->hasRole('Administrador') && $oficio->departamento_id !== $deptoId) {
            abort(403, 'No tienes acceso a este oficio.');
        }
    }

    private function formatOficio(Oficio $o): array
    {
        return [
            'id'                    => $o->id,
            'numero_oficio'         => $o->numero_oficio,
            'consecutivo'           => $o->consecutivo,
            'anio'                  => $o->anio,
            'departamento'          => optional($o->departamento)->nombre,
            'departamento_clave'    => optional($o->departamento)->clave,
            'fecha_registro'        => $o->fecha_registro?->format('d/m/Y'),
            'jefe_referencia'       => $o->jefe_referencia,
            'registrado_por_nombre' => $o->registrado_por_nombre,
            'registrado_por_user'   => optional($o->registradoPor)->name,
            'asunto'                => $o->asunto,
            'dirigido_a'            => $o->dirigido_a,
            'estatus'               => $o->estatus,
            'badge_class'           => $o->badgeClass(),
            'cancelado_por'         => $o->cancelado_por,
            'motivo_cancelacion'    => $o->motivo_cancelacion,
            'acuse_url'             => $o->acuse_url,
            'acuse_nombre'          => $o->acuse_nombre,
            'fecha_acuse'           => $o->fecha_acuse?->format('d/m/Y'),
            'created_at'            => $o->created_at->format('d/m/Y H:i'),
        ];
    }
}
