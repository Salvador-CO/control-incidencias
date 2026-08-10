<?php

namespace App\Http\Controllers;

use App\Models\Oficio;
use App\Models\Departamento;
use App\Models\OnedriveConfig;
use Illuminate\Http\Request;
use Carbon\Carbon;

/**
 * Controlador de administración global de oficios.
 * Solo accesible para el rol Administrador.
 */
class OficioAdminController extends Controller
{
    /** Vista global: todos los oficios de todos los departamentos. */
    public function globalIndex(Request $request)
    {
        $anioFiltro    = $request->get('anio', Carbon::now()->year);
        $deptoFiltro   = $request->get('departamento_id');
        $estatusFiltro = $request->get('estatus');
        $busqueda      = $request->get('q');

        $query = Oficio::with(['departamento', 'registradoPor'])
            ->orderByDesc('created_at');

        if ($anioFiltro) {
            $query->where('anio', $anioFiltro);
        }

        if ($deptoFiltro) {
            $query->where('departamento_id', $deptoFiltro);
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

        $departamentos = Departamento::where('activo', true)->orderBy('nombre')->get();

        $aniosDisponibles = Oficio::selectRaw('DISTINCT anio')
            ->orderByDesc('anio')
            ->pluck('anio')
            ->push(Carbon::now()->year)
            ->unique()->sort()->values();

        // Stats globales
        $statsGlobal = [
            'total'     => $oficios->count(),
            'pendiente' => $oficios->where('estatus', 'Pendiente')->count(),
            'entregado' => $oficios->where('estatus', 'Entregado')->count(),
            'cancelado' => $oficios->where('estatus', 'Cancelado')->count(),
        ];

        // Stats por departamento (año filtrado)
        $porDepto = Oficio::with('departamento')
            ->when($anioFiltro, fn($q) => $q->where('anio', $anioFiltro))
            ->selectRaw('departamento_id, estatus, count(*) as total')
            ->groupBy('departamento_id', 'estatus')
            ->get()
            ->groupBy('departamento_id');

        return view('oficios.admin.index', compact(
            'oficios', 'departamentos', 'anioFiltro', 'aniosDisponibles',
            'deptoFiltro', 'estatusFiltro', 'busqueda',
            'statsGlobal', 'porDepto'
        ));
    }

    /** Listado de configuraciones de OneDrive. */
    public function configIndex()
    {
        $configs      = OnedriveConfig::with('departamento')->get()->keyBy('departamento_id');
        $departamentos = Departamento::where('activo', true)->orderBy('nombre')->get();

        return view('oficios.admin.config', compact('configs', 'departamentos'));
    }

    /** Crea o actualiza la configuración OneDrive de un departamento. */
    public function configStore(Request $request)
    {
        $data = $request->validate([
            'departamento_id' => 'required|exists:departamentos,id',
            'onedrive_url'    => 'required|url|max:500',
            'descripcion'     => 'nullable|string|max:255',
        ]);

        $config = OnedriveConfig::updateOrCreate(
            ['departamento_id' => $data['departamento_id']],
            [
                'onedrive_url' => $data['onedrive_url'],
                'descripcion'  => $data['descripcion'] ?? null,
            ]
        );

        return response()->json([
            'success'     => true,
            'message'     => 'Configuración guardada correctamente.',
            'config'      => $config,
            'departamento'=> $config->departamento->nombre,
        ]);
    }

    /** Actualiza una configuración OneDrive existente. */
    public function configUpdate(Request $request, OnedriveConfig $config)
    {
        $data = $request->validate([
            'onedrive_url' => 'required|url|max:500',
            'descripcion'  => 'nullable|string|max:255',
        ]);

        $config->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Configuración actualizada correctamente.',
            'config'  => $config,
        ]);
    }

    /** Elimina una configuración OneDrive. */
    public function configDestroy(OnedriveConfig $config)
    {
        $config->delete();

        return response()->json([
            'success' => true,
            'message' => 'Configuración eliminada.',
        ]);
    }
}
