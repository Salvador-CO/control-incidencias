<?php

namespace App\Http\Controllers;

use App\Models\Incidencia;
use App\Models\Empleado;
use App\Models\Departamento;
use App\Models\TipoIncidencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class IncidenciaController extends Controller
{
    /**
     * Vista principal con pendientes y entregadas separadas.
     */
    public function index()
    {
        $pendientes = Incidencia::with(['empleado', 'tipoIncidencia', 'departamento', 'capturista'])
            ->where('estatus', 'Pendiente')
            ->orderBy('fecha', 'asc')           // más antiguas primero
            ->orderBy('created_at', 'asc')
            ->get();

        $entregadas = Incidencia::with(['empleado', 'tipoIncidencia', 'departamento', 'capturista'])
            ->where('estatus', 'Entregado')
            ->orderBy('fecha_entrega', 'desc')  // más recientes primero
            ->get();

        $empleados     = Empleado::where('activo', true)->orderBy('nombre')->get();
        $tipos         = TipoIncidencia::where('activo', true)->orderBy('nombre')->get();
        $departamentos = Departamento::orderBy('nombre')->get();

        return view('incidencias.index', compact(
            'pendientes', 'entregadas', 'empleados', 'tipos', 'departamentos'
        ));
    }

    public function create()
    {
        $empleados = Empleado::where('activo', true)->get();
        $tipos     = TipoIncidencia::where('activo', true)->get();
        return view('incidencias.create', compact('empleados', 'tipos'));
    }

    /** Guarda una incidencia; responde JSON si la petición lo espera (AJAX). */
    public function store(Request $request)
    {
        $data = $request->validate([
            'fecha'              => 'required|date',
            'empleado_id'        => 'required|exists:empleados,id',
            'tipo_incidencia_id' => 'required|exists:tipo_incidencias,id',
            'motivo'             => 'nullable|string|max:255',
            'observaciones'      => 'nullable|string',
        ]);

        $empleado = Empleado::findOrFail($data['empleado_id']);

        $incidencia = Incidencia::create([
            'fecha'              => $data['fecha'],
            'empleado_id'        => $empleado->id,
            'departamento_id'    => $empleado->departamento_id,
            'direccion_id'       => $empleado->direccion_id,
            'tipo_incidencia_id' => $data['tipo_incidencia_id'],
            'motivo'             => $data['motivo']        ?? null,
            'observaciones'      => $data['observaciones'] ?? null,
            'capturado_por'      => Auth::id(),
            'estatus'            => 'Pendiente',
        ]);

        if ($request->expectsJson()) {
            $incidencia->load(['empleado', 'tipoIncidencia', 'departamento', 'capturista']);
            return response()->json([
                'success'    => true,
                'message'    => 'Incidencia registrada correctamente.',
                'incidencia' => $this->formatIncidencia($incidencia),
            ]);
        }

        return redirect()->route('incidencias.index')
            ->with('success', 'Incidencia registrada correctamente.');
    }

    /** Devuelve el detalle completo de una incidencia (modal ver detalles). */
    public function show(Incidencia $incidencia)
    {
        $incidencia->load(['empleado.departamento', 'empleado.puesto', 'tipoIncidencia', 'departamento', 'capturista']);

        return response()->json([
            'success'    => true,
            'incidencia' => [
                'id'             => $incidencia->id,
                'fecha'          => Carbon::parse($incidencia->fecha)->format('d/m/Y'),
                'empleado'       => $incidencia->empleado->nombre . ' ' . $incidencia->empleado->apellido_paterno,
                'matricula'      => $incidencia->empleado->numero_empleado,
                'departamento'   => $incidencia->departamento->nombre  ?? 'N/A',
                'puesto'         => optional($incidencia->empleado->puesto)->nombre ?? 'N/A',
                'tipo'           => optional($incidencia->tipoIncidencia)->nombre ?? 'N/A',
                'motivo'         => $incidencia->motivo       ?? '—',
                'observaciones'  => $incidencia->observaciones ?? '—',
                'estatus'        => $incidencia->estatus,
                'capturado_por'  => optional($incidencia->capturista)->name ?? 'Sistema',
                'recibido_por'   => $incidencia->recibido_por  ?? null,
                'fecha_registro' => $incidencia->created_at->format('d/m/Y H:i'),
                'fecha_entrega'  => $incidencia->fecha_entrega
                    ? Carbon::parse($incidencia->fecha_entrega)->format('d/m/Y H:i')
                    : null,
            ],
        ]);
    }

    /** Cambia estatus a "Entregado" y guarda quién recibió y cuándo. */
    public function entregar(Request $request, Incidencia $incidencia)
    {
        $data = $request->validate([
            'recibido_por' => 'required|string|max:255',
        ]);

        $incidencia->update([
            'estatus'       => 'Entregado',
            'recibido_por'  => $data['recibido_por'],
            'fecha_entrega' => now(),
        ]);

        return response()->json([
            'success'    => true,
            'message'    => 'Incidencia marcada como entregada.',
            'incidencia' => $this->formatIncidencia($incidencia->fresh(['empleado', 'tipoIncidencia', 'departamento', 'capturista'])),
        ]);
    }

    /** Entrega en lote todas las incidencias pendientes de un departamento. */
    public function entregarDepartamento(Request $request)
    {
        $data = $request->validate([
            'departamento_id' => 'required|exists:departamentos,id',
            'recibido_por'    => 'required|string|max:255',
            'ids'             => 'required|array|min:1',
            'ids.*'           => 'integer|exists:incidencias,id',
        ]);

        Incidencia::whereIn('id', $data['ids'])
            ->where('estatus', 'Pendiente')
            ->update([
                'estatus'       => 'Entregado',
                'recibido_por'  => $data['recibido_por'],
                'fecha_entrega' => now(),
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Incidencias entregadas correctamente.',
            'ids'     => $data['ids'],
        ]);
    }

    /**
     * Endpoint AJAX para filtrar incidencias con criterios avanzados.
     * GET /incidencias/filtrar?estatus=Pendiente&departamento_id=1&nombre=juan&mes=8&año=2026&quincena=1&recibido_por=...
     */
    public function filtrar(Request $request)
    {
        $query = Incidencia::with(['empleado', 'tipoIncidencia', 'departamento', 'capturista'])
            ->when($request->estatus, fn($q, $v) => $q->where('estatus', $v))
            ->when($request->departamento_id, fn($q, $v) => $q->where('departamento_id', $v))
            ->when($request->tipo_incidencia_id, fn($q, $v) => $q->where('tipo_incidencia_id', $v))
            ->when($request->recibido_por, fn($q, $v) => $q->where('recibido_por', 'like', "%{$v}%"))
            ->when($request->nombre, function ($q, $v) {
                $q->whereHas('empleado', fn($eq) =>
                    $eq->where('nombre', 'like', "%{$v}%")
                       ->orWhere('apellido_paterno', 'like', "%{$v}%")
                       ->orWhere('apellido_materno', 'like', "%{$v}%")
                       ->orWhere('numero_empleado', 'like', "%{$v}%")
                );
            })
            ->when($request->mes && $request->anio, function ($q) use ($request) {
                $q->whereYear('fecha', $request->anio)->whereMonth('fecha', $request->mes);
            })
            ->when($request->quincena && $request->mes && $request->anio, function ($q) use ($request) {
                if ($request->quincena == 1) {
                    $q->whereDay('fecha', '>=', 1)->whereDay('fecha', '<=', 15);
                } else {
                    $q->whereDay('fecha', '>=', 16);
                }
            })
            ->when($request->fecha_desde, fn($q, $v) => $q->where('fecha', '>=', $v))
            ->when($request->fecha_hasta, fn($q, $v) => $q->where('fecha', '<=', $v));

        // Orden según estatus
        if ($request->estatus === 'Pendiente') {
            $query->orderBy('fecha', 'asc')->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('fecha_entrega', 'desc');
        }

        $incidencias = $query->get()->map(fn($inc) => $this->formatIncidencia($inc));

        return response()->json([
            'success'     => true,
            'incidencias' => $incidencias,
            'total'       => $incidencias->count(),
        ]);
    }

    /** Formatea una incidencia para devolverla en JSON. */
    private function formatIncidencia(Incidencia $inc): array
    {
        return [
            'id'             => $inc->id,
            'fecha'          => Carbon::parse($inc->fecha)->format('d/m/Y'),
            'empleado'       => $inc->empleado->nombre . ' ' . $inc->empleado->apellido_paterno,
            'matricula'      => $inc->empleado->numero_empleado,
            'departamento'   => optional($inc->departamento)->nombre ?? 'N/A',
            'departamento_id'=> $inc->departamento_id,
            'tipo'           => optional($inc->tipoIncidencia)->nombre ?? 'N/A',
            'estatus'        => $inc->estatus,
            'capturista'     => optional($inc->capturista)->name ?? 'Sistema',
            'recibido_por'   => $inc->recibido_por ?? null,
            'fecha_registro' => $inc->created_at->format('d/m/Y H:i'),
            'fecha_entrega'  => $inc->fecha_entrega
                ? Carbon::parse($inc->fecha_entrega)->format('d/m/Y H:i')
                : null,
        ];
    }
}
