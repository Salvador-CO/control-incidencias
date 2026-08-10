<?php

namespace App\Http\Controllers;

use App\Models\Incidencia;
use App\Models\Empleado;
use App\Models\Departamento;
use App\Models\TipoIncidencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncidenciaController extends Controller
{
    public function index()
    {
        $incidencias = Incidencia::with(['empleado', 'tipoIncidencia', 'departamento', 'capturista'])
            ->latest()
            ->get();

        $empleados   = Empleado::where('activo', true)->orderBy('nombre')->get();
        $tipos       = TipoIncidencia::where('activo', true)->orderBy('nombre')->get();
        $departamentos = Departamento::orderBy('nombre')->get();

        return view('incidencias.index', compact('incidencias', 'empleados', 'tipos', 'departamentos'));
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
                'id'              => $incidencia->id,
                'fecha'           => \Carbon\Carbon::parse($incidencia->fecha)->format('d/m/Y'),
                'empleado'        => $incidencia->empleado->nombre . ' ' . $incidencia->empleado->apellido_paterno,
                'matricula'       => $incidencia->empleado->numero_empleado,
                'departamento'    => $incidencia->departamento->nombre  ?? 'N/A',
                'puesto'          => optional($incidencia->empleado->puesto)->nombre ?? 'N/A',
                'tipo'            => optional($incidencia->tipoIncidencia)->nombre ?? 'N/A',
                'motivo'          => $incidencia->motivo       ?? '—',
                'observaciones'   => $incidencia->observaciones ?? '—',
                'estatus'         => $incidencia->estatus,
                'capturado_por'   => optional($incidencia->capturista)->name ?? 'Sistema',
                'recibido_por'    => $incidencia->recibido_por  ?? null,
                'fecha_registro'  => $incidencia->created_at->format('d/m/Y H:i'),
            ],
        ]);
    }

    /** Cambia estatus a "Entregado" y guarda quién recibió. */
    public function entregar(Request $request, Incidencia $incidencia)
    {
        $data = $request->validate([
            'recibido_por' => 'required|string|max:255',
        ]);

        $incidencia->update([
            'estatus'      => 'Entregado',
            'recibido_por' => $data['recibido_por'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Incidencia marcada como entregada.',
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
                'estatus'      => 'Entregado',
                'recibido_por' => $data['recibido_por'],
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Incidencias entregadas correctamente.',
            'ids'     => $data['ids'],
        ]);
    }

    /** Formatea una incidencia para devolverla en JSON. */
    private function formatIncidencia(Incidencia $inc): array
    {
        return [
            'id'           => $inc->id,
            'fecha'        => \Carbon\Carbon::parse($inc->fecha)->format('d/m/Y'),
            'empleado'     => $inc->empleado->nombre . ' ' . $inc->empleado->apellido_paterno,
            'matricula'    => $inc->empleado->numero_empleado,
            'departamento' => optional($inc->departamento)->nombre ?? 'N/A',
            'tipo'         => optional($inc->tipoIncidencia)->nombre ?? 'N/A',
            'estatus'      => $inc->estatus,
            'capturista'   => optional($inc->capturista)->name ?? 'Sistema',
            'recibido_por' => $inc->recibido_por ?? null,
        ];
    }
}
