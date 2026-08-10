<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Incidencia;
use App\Models\Departamento;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEmpleados = Empleado::where('activo', true)->count();
        $incidenciasHoy = Incidencia::whereDate('fecha', Carbon::today())->count();
        $departamentosCount = Departamento::where('activo', true)->count();
        
        // Personal en riesgo: 3 o más incidencias en el mes actual
        $personalRiesgoQuery = Incidencia::selectRaw('empleado_id, count(*) as total')
            ->whereMonth('fecha', Carbon::now()->month)
            ->whereYear('fecha', Carbon::now()->year)
            ->groupBy('empleado_id')
            ->having('total', '>=', 3)
            ->get();
        $personalRiesgo = $personalRiesgoQuery->count();

        // Datos para Gráfica 1: Incidencias por departamento
        $incidenciasDepto = Incidencia::join('departamentos', 'incidencias.departamento_id', '=', 'departamentos.id')
            ->selectRaw('departamentos.nombre, count(incidencias.id) as total')
            ->groupBy('departamentos.nombre')
            ->get();
            
        $chartLabelsDepto = $incidenciasDepto->pluck('nombre');
        $chartDataDepto = $incidenciasDepto->pluck('total');

        // Datos para Gráfica 2: Tipos de Incidencias
        $tiposData = Incidencia::join('tipo_incidencias', 'incidencias.tipo_incidencia_id', '=', 'tipo_incidencias.id')
            ->selectRaw('tipo_incidencias.nombre, count(incidencias.id) as total')
            ->groupBy('tipo_incidencias.nombre')
            ->get();
            
        $chartLabelsTipos = $tiposData->pluck('nombre');
        $chartDataTipos = $tiposData->pluck('total');

        return view('dashboard', compact(
            'totalEmpleados', 
            'incidenciasHoy', 
            'departamentosCount', 
            'personalRiesgo',
            'chartLabelsDepto',
            'chartDataDepto',
            'chartLabelsTipos',
            'chartDataTipos'
        ));
    }
}
