<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incidencia;
use App\Models\Departamento;
use App\Models\Empleado;
use App\Models\TipoIncidencia;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\IncidenciasExport;
use Carbon\Carbon;

class ReporteController extends Controller
{
    public function index()
    {
        $departamentos = Departamento::where('activo', true)->orderBy('nombre')->get();
        $empleados     = Empleado::where('activo', true)->orderBy('nombre')->get();
        $tipos         = TipoIncidencia::where('activo', true)->orderBy('nombre')->get();

        // Datos iniciales (sin filtros) para el primer render
        $datosIniciales = $this->calcularDatos(new Request());

        return view('reportes.index', compact('departamentos', 'empleados', 'tipos', 'datosIniciales'));
    }

    /**
     * Endpoint AJAX: recibe filtros, devuelve JSON con KPIs, gráficas y tabla.
     */
    public function datos(Request $request)
    {
        return response()->json($this->calcularDatos($request));
    }

    // ─── Exportaciones ────────────────────────────────────────────────────────

    public function exportPdf(Request $request)
    {
        $incidencias = $this->buildQuery($request)->orderBy('fecha', 'desc')->get();
        $filtros     = $request->all();

        $pdf = Pdf::loadView('reportes.pdf', compact('incidencias', 'filtros'))
                  ->setPaper('a4', 'landscape');
        return $pdf->download('reporte_incidencias.pdf');
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(new IncidenciasExport($request->all()), 'reporte_incidencias.xlsx');
    }

    // ─── Helpers privados ─────────────────────────────────────────────────────

    /** Construye la query base aplicando los filtros del request. */
    private function buildQuery(Request $request)
    {
        $query = Incidencia::with(['empleado', 'departamento', 'tipoIncidencia', 'capturista']);

        if ($request->filled('fecha_inicio')) {
            $query->whereDate('fecha', '>=', $request->fecha_inicio);
        }
        if ($request->filled('fecha_fin')) {
            $query->whereDate('fecha', '<=', $request->fecha_fin);
        }
        if ($request->filled('departamento_id')) {
            $query->where('departamento_id', $request->departamento_id);
        }
        if ($request->filled('empleado_id')) {
            $query->where('empleado_id', $request->empleado_id);
        }
        if ($request->filled('estatus')) {
            $query->where('estatus', $request->estatus);
        }

        return $query;
    }

    /**
     * Retorna la quincena a la que pertenece una fecha.
     * Formato: "1a Qna Ene 2025" / "2a Qna Ene 2025"
     */
    private function claveQuincena(Carbon $fecha): string
    {
        $qna  = $fecha->day <= 15 ? '1a' : '2a';
        $mes  = $fecha->isoFormat('MMM');   // ej. "ene"
        $anio = $fecha->year;
        return "{$qna} Qna {$mes} {$anio}";
    }

    /**
     * Genera todas las claves de quincena entre dos fechas (para rellenar vacíos).
     */
    private function rangoQuincenas(Carbon $inicio, Carbon $fin): array
    {
        $claves  = [];
        $current = $inicio->copy()->startOfMonth();

        while ($current->lte($fin)) {
            // Primera quincena del mes
            $q1 = $current->copy()->day(1);
            if ($q1->between($inicio, $fin)) {
                $claves[$this->claveQuincena($q1)] = 0;
            }
            // Segunda quincena del mes
            $q2 = $current->copy()->day(16);
            if ($q2->between($inicio, $fin)) {
                $claves[$this->claveQuincena($q2)] = 0;
            }
            $current->addMonth();
        }
        return $claves;
    }

    /**
     * Determina el inicio y fin de la quincena actual.
     */
    private function quincenaActual(): array
    {
        $hoy = Carbon::today();
        if ($hoy->day <= 15) {
            return [
                'inicio' => $hoy->copy()->startOfMonth(),
                'fin'    => $hoy->copy()->day(15),
            ];
        }
        return [
            'inicio' => $hoy->copy()->day(16),
            'fin'    => $hoy->copy()->endOfMonth(),
        ];
    }

    /** Calcula todos los datos analíticos para una respuesta (view o JSON). */
    private function calcularDatos(Request $request): array
    {
        $incidencias = $this->buildQuery($request)->orderBy('fecha', 'asc')->get();

        // ── KPIs ─────────────────────────────────────────────────────────────
        $total      = $incidencias->count();
        $pendientes = $incidencias->where('estatus', 'Pendiente')->count();
        $entregadas = $incidencias->where('estatus', 'Entregado')->count();

        // Personal en riesgo de la QUINCENA ACTUAL (≥3 incidencias en la qna vigente)
        $qna       = $this->quincenaActual();
        $enRiesgo  = Incidencia::whereBetween('fecha', [$qna['inicio']->toDateString(), $qna['fin']->toDateString()])
            ->when($request->filled('departamento_id'), fn($q) => $q->where('departamento_id', $request->departamento_id))
            ->when($request->filled('empleado_id'),    fn($q) => $q->where('empleado_id',    $request->empleado_id))
            ->selectRaw('empleado_id, count(*) as total')
            ->groupBy('empleado_id')
            ->having('total', '>=', 3)
            ->count();

        // ── Gráfica 1: Barras por departamento ───────────────────────────────
        $porDepto = $incidencias->groupBy(fn($i) => optional($i->departamento)->nombre ?? 'Sin departamento')
            ->map->count()
            ->sortDesc();

        // ── Gráfica 2: Dona por tipo de incidencia ───────────────────────────
        $porTipo = $incidencias->groupBy(fn($i) => optional($i->tipoIncidencia)->nombre ?? 'Sin tipo')
            ->map->count()
            ->sortDesc();

        // ── Gráfica 3: Tendencia mensual ─────────────────────────────────────
        $tendencia = $incidencias
            ->groupBy(fn($i) => Carbon::parse($i->fecha)->format('Y-m'))
            ->map->count()
            ->sortKeys();

        $tendenciaLabels = $tendencia->keys()->map(function ($ym) {
            return Carbon::createFromFormat('Y-m', $ym)->isoFormat('MMM YYYY');
        });

        // ── Gráfica 4: Tendencia por quincena ────────────────────────────────
        if ($incidencias->isNotEmpty()) {
            $fechaMin = Carbon::parse($incidencias->first()->fecha);
            $fechaMax = Carbon::parse($incidencias->last()->fecha);
        } else {
            $fechaMin = Carbon::now()->startOfMonth();
            $fechaMax = Carbon::now()->endOfMonth();
        }

        $quincenasBase = $this->rangoQuincenas($fechaMin, $fechaMax);

        $porQuincena = $incidencias
            ->groupBy(fn($i) => $this->claveQuincena(Carbon::parse($i->fecha)))
            ->map->count();

        $quincenasFinal = collect($quincenasBase)->merge($porQuincena)->sortKeys();

        // ── Top 10 empleados – TOTAL del período (tabla existente) ────────────
        $topEmpleados = $incidencias
            ->groupBy('empleado_id')
            ->map(function ($grupo) use ($qna) {
                $emp              = $grupo->first()->empleado;
                $totalGrupo       = $grupo->count();
                $enQnaActual      = $grupo->filter(function ($i) use ($qna) {
                    $f = Carbon::parse($i->fecha);
                    return $f->between($qna['inicio'], $qna['fin']);
                })->count();

                return [
                    'nombre'        => $emp ? ($emp->nombre . ' ' . $emp->apellido_paterno) : 'Desconocido',
                    'matricula'     => $emp?->numero_empleado ?? '—',
                    'depto'         => optional($grupo->first()->departamento)->nombre ?? 'N/A',
                    'total'         => $totalGrupo,
                    'pendientes'    => $grupo->where('estatus', 'Pendiente')->count(),
                    'en_qna_actual' => $enQnaActual,
                    // Riesgo se evalúa SÓLO por la quincena actual
                    'riesgo'        => $enQnaActual >= 3,
                ];
            })
            ->sortByDesc('total')
            ->take(10)
            ->values();

        // ── Top 10 empleados – DESGLOSE POR MES/QUINCENA (nueva tabla) ───────
        // Meses presentes en el período (ordenados)
        $mesesPresentes = $incidencias
            ->groupBy(fn($i) => Carbon::parse($i->fecha)->format('Y-m'))
            ->keys()
            ->sort()
            ->values();

        $top10Mensual = $incidencias
            ->groupBy('empleado_id')
            ->map(function ($grupo) use ($mesesPresentes, $qna) {
                $emp = $grupo->first()->empleado;

                // Para cada mes: total, q1 (días 1-15), q2 (días 16-fin)
                $porMes = $mesesPresentes->map(function ($ym) use ($grupo) {
                    $delMes = $grupo->filter(fn($i) => Carbon::parse($i->fecha)->format('Y-m') === $ym);
                    $q1 = $delMes->filter(fn($i) => Carbon::parse($i->fecha)->day <= 15)->count();
                    $q2 = $delMes->filter(fn($i) => Carbon::parse($i->fecha)->day > 15)->count();
                    return ['total' => $delMes->count(), 'q1' => $q1, 'q2' => $q2];
                })->values();

                $enQnaActual = $grupo->filter(function ($i) use ($qna) {
                    return Carbon::parse($i->fecha)->between($qna['inicio'], $qna['fin']);
                })->count();

                return [
                    'nombre'        => $emp ? ($emp->nombre . ' ' . $emp->apellido_paterno) : 'Desconocido',
                    'matricula'     => $emp?->numero_empleado ?? '—',
                    'depto'         => optional($grupo->first()->departamento)->nombre ?? 'N/A',
                    'total'         => $grupo->count(),
                    'por_mes'       => $porMes,
                    'riesgo'        => $enQnaActual >= 3,
                    'en_qna_actual' => $enQnaActual,
                ];
            })
            ->sortByDesc('total')
            ->take(10)
            ->values();

        // Labels de meses formateados para cabeceras de columna
        $mesesLabels = $mesesPresentes->map(
            fn($ym) => Carbon::createFromFormat('Y-m', $ym)->isoFormat('MMM YYYY')
        )->values();

        // ── Tabla de incidencias (serializada) ───────────────────────────────
        $tablaRows = $incidencias->sortByDesc('fecha')->map(fn($i) => [
            'fecha'        => Carbon::parse($i->fecha)->format('d/m/Y'),
            'empleado'     => ($i->empleado?->nombre ?? '') . ' ' . ($i->empleado?->apellido_paterno ?? ''),
            'matricula'    => $i->empleado?->numero_empleado ?? '—',
            'departamento' => optional($i->departamento)->nombre ?? 'N/A',
            'tipo'         => optional($i->tipoIncidencia)->nombre ?? 'N/A',
            'motivo'       => $i->motivo ?? '—',
            'estatus'      => $i->estatus,
            'recibido_por' => $i->recibido_por ?? '—',
            'capturista'   => optional($i->capturista)->name ?? 'Sistema',
        ])->values();

        // ── Info de quincena actual (para la vista) ───────────────────────────
        $qnaLabel = ($qna['inicio']->day === 1 ? '1ª' : '2ª')
            . ' Quincena de '
            . $qna['inicio']->isoFormat('MMMM YYYY');

        return [
            'kpis' => [
                'total'      => $total,
                'pendientes' => $pendientes,
                'entregadas' => $entregadas,
                'en_riesgo'  => $enRiesgo,
                'qna_label'  => $qnaLabel,
            ],
            'graficas' => [
                'depto'     => ['labels' => $porDepto->keys()->values(),         'data' => $porDepto->values()],
                'tipo'      => ['labels' => $porTipo->keys()->values(),          'data' => $porTipo->values()],
                'linea'     => ['labels' => $tendenciaLabels->values(),          'data' => $tendencia->values()],
                'quincena'  => ['labels' => $quincenasFinal->keys()->values(), 'data' => $quincenasFinal->values()],
            ],
            'top_empleados'         => $topEmpleados,
            'top_empleados_mensual' => [
                'meses'     => $mesesLabels,
                'empleados' => $top10Mensual,
            ],
            'tabla' => $tablaRows,
        ];
    }
}
