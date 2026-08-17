<x-app-layout>
    <x-slot name="header">
        Reportes y Analítica
    </x-slot>

    {{-- ═══════════════════════════════════════════════════
         DEPENDENCIAS
    ═══════════════════════════════════════════════════ --}}
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>

    <style>
        /* ── Paleta ──────────────────────────────────────── */
        :root {
            --rp-green:      #006039;
            --rp-green-dark: #004a2c;
            --rp-surface:    #ffffff;
            --rp-bg:         #f4f6f9;
        }

        /* ── Select2 ─────────────────────────────────────── */
        .select2-container .select2-selection--single {
            height: 40px; border: 1px solid #dee2e6; border-radius: 8px;
            padding: 6px 12px; background-color: #f8f9fa;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow { height: 38px; right: 10px; }
        .select2-container { width: 100% !important; }

        /* ── Zona Filtros — glassmorphism verde suave ─────── */
        .filtros-card {
            background: linear-gradient(135deg, rgba(0,96,57,.72) 0%, rgba(0,74,44,.80) 100%);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(255,255,255,.18);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0,96,57,.18), inset 0 1px 0 rgba(255,255,255,.12);
        }
        .filtros-card .form-label {
            color: rgba(255,255,255,.85); font-size: .78rem; font-weight: 600;
            text-transform: uppercase; letter-spacing: .5px;
        }
        .filtros-card .form-control,
        .filtros-card .form-select {
            background: rgba(255,255,255,.13); border-color: rgba(255,255,255,.22);
            color: #fff; border-radius: 9px;
            transition: background .2s, border-color .2s;
        }
        .filtros-card .form-control::placeholder { color: rgba(255,255,255,.45); }
        .filtros-card .form-control:focus,
        .filtros-card .form-select:focus {
            background: rgba(255,255,255,.22); border-color: rgba(255,255,255,.55);
            color: #fff; box-shadow: 0 0 0 3px rgba(255,255,255,.12);
        }
        .filtros-card .form-select option { color: #1a1a1a; background: #fff; }

        /* Select2 dentro del card de filtros */
        .filtros-card .select2-container .select2-selection--single {
            background: rgba(255,255,255,.13); border-color: rgba(255,255,255,.22);
            height: 40px; border-radius: 9px;
        }
        .filtros-card .select2-container--default .select2-selection--single .select2-selection__rendered { color: #fff; }
        .filtros-card .select2-container--default .select2-selection--single .select2-selection__placeholder { color: rgba(255,255,255,.45); }

        /* Botón principal dentro del card */
        .btn-generar {
            background: rgba(255,255,255,.18);
            border: 1px solid rgba(255,255,255,.38);
            color: #fff; font-weight: 600; border-radius: 10px;
            transition: background .2s, transform .1s;
        }
        .btn-generar:hover { background: rgba(255,255,255,.28); color:#fff; transform:translateY(-1px); }

        /* ── KPI Cards ───────────────────────────────────── */
        .kpi-card { border-radius: 16px; border: none; overflow: hidden; transition: transform .2s, box-shadow .2s; }
        .kpi-card:hover { transform: translateY(-4px); box-shadow: 0 12px 30px rgba(0,0,0,.12) !important; }
        .kpi-icon { font-size: 2.4rem; opacity: .15; }
        .kpi-value { font-size: 2.5rem; font-weight: 700; line-height: 1; }
        .kpi-label { font-size: .72rem; text-transform: uppercase; letter-spacing: .8px; font-weight: 600; opacity: .7; }
        .kpi-sub   { font-size: .68rem; opacity: .55; margin-top: 2px; }
        @keyframes countUp { from { opacity:0; transform:translateY(8px); } to { opacity:1; transform:translateY(0); } }
        .kpi-value { animation: countUp .4s ease; }

        /* ── Sección títulos ─────────────────────────────── */
        .section-title {
            font-size: .95rem; font-weight: 700; color: var(--rp-green-dark);
            border-left: 4px solid var(--rp-green); padding-left: .75rem;
        }

        /* ── Gráfica cards ───────────────────────────────── */
        .chart-card { border-radius: 16px; border: none; background: #fff; }

        /* ── Top Empleados ───────────────────────────────── */
        .emp-bar-wrap { background: #f0fdf4; border-radius: 8px; height: 8px; overflow: hidden; }
        .emp-bar-fill { height: 100%; border-radius: 8px; background: linear-gradient(90deg,#006039,#26a65b); transition: width .6s cubic-bezier(.34,1.56,.64,1); }
        .emp-bar-fill.riesgo { background: linear-gradient(90deg,#dc2626,#ef4444); }
        .badge-riesgo { background:#fee2e2; color:#dc2626; font-size:.68rem; font-weight:700; padding:2px 8px; border-radius:99px; }
        .badge-ok     { background:#d1fae5; color:#065f46; font-size:.68rem; font-weight:700; padding:2px 8px; border-radius:99px; }
        .badge-qna    { background:#eff6ff; color:#1d4ed8; font-size:.65rem; font-weight:600; padding:2px 7px; border-radius:99px; }

        /* ── Top Mensual ─────────────────────────────────────── */
        #tablaTopMensual { font-size: .8rem; }
        #tablaTopMensual thead th {
            text-align: center; white-space: nowrap;
            font-size: .72rem; color: #6b7280; font-weight: 700;
            text-transform: uppercase; letter-spacing: .4px;
        }
        #tablaTopMensual thead th.th-emp {
            text-align: left; min-width: 180px;
        }
        #tablaTopMensual td { text-align: center; vertical-align: middle; }
        #tablaTopMensual td.td-emp { text-align: left; }
        .mes-cell {
            display: flex; flex-direction: column; align-items: center;
            gap: 2px; cursor: default;
        }
        .mes-total {
            font-weight: 700; font-size: .92rem; line-height: 1;
        }
        .mes-total.cero { color: #d1d5db; }
        .mes-total.bajo  { color: #16a34a; }
        .mes-total.medio { color: #d97706; }
        .mes-total.alto  { color: #dc2626; }
        .mes-qna-chips {
            display: flex; gap: 3px; justify-content: center; flex-wrap: nowrap;
        }
        .mes-qna-chip {
            font-size: .6rem; font-weight: 700; padding: 1px 5px;
            border-radius: 99px; white-space: nowrap;
        }
        .mes-qna-chip.q1 { background: rgba(0,96,57,.12); color: #006039; }
        .mes-qna-chip.q2 { background: rgba(38,166,91,.15); color: #1a7a3c; }
        .mes-qna-chip.q-cero { background: #f3f4f6; color: #d1d5db; }
        /* Heatmap de fondo de celda */
        .mes-heat-0  { background: #fff; }
        .mes-heat-1  { background: #f0fdf4; }
        .mes-heat-2  { background: #dcfce7; }
        .mes-heat-3  { background: #fef9c3; }
        .mes-heat-4  { background: #fef3c7; }
        .mes-heat-5p { background: #fee2e2; }

        /* ── Chips de filtros activos ─────────────────────── */
        .filtro-chip {
            display:inline-flex; align-items:center; gap:5px;
            background:rgba(255,255,255,.22); border:1px solid rgba(255,255,255,.3);
            color:#fff; font-size:.76rem; font-weight:600;
            padding:3px 10px; border-radius:99px;
        }

        /* ── Loader overlay ──────────────────────────────── */
        #loaderOverlay {
            display:none; position:fixed; inset:0; background:rgba(255,255,255,.55);
            backdrop-filter:blur(4px); z-index:9999;
            align-items:center; justify-content:center;
        }
        #loaderOverlay.show { display:flex; }

        /* ── Tabla ───────────────────────────────────────── */
        .badge-pendiente { background:#fff3cd; color:#856404; border:1px solid #ffc107; }
        .badge-entregado { background:#d1e7dd; color:#0f5132; border:1px solid #198754; }

        /* ── Separador de secciones ──────────────────────── */
        .zona-label {
            font-size:.68rem; font-weight:700; text-transform:uppercase;
            letter-spacing:1.2px; color:#adb5bd; margin-bottom:.5rem;
        }
    </style>

    {{-- ══════════════════════════════════
         LOADER
    ══════════════════════════════════ --}}
    <div id="loaderOverlay">
        <div class="text-center">
            <div class="spinner-border text-success mb-2" style="width:3rem;height:3rem;border-width:4px;"></div>
            <div class="fw-semibold text-success small">Calculando…</div>
        </div>
    </div>

    {{-- ══════════════════════════════════
         ZONA 1 — FILTROS (glassmorphism)
    ══════════════════════════════════ --}}
    <div class="filtros-card p-4 mb-4">
        <div class="d-flex justify-content-between align-items-start mb-3 flex-wrap gap-2">
            <div>
                <h5 class="text-white fw-bold mb-0">
                    <i class="bi bi-funnel-fill me-2"></i>Filtros de Análisis
                </h5>
                <p class="mb-0 small" style="color:rgba(255,255,255,.6);">
                    Ajusta los filtros y presiona <strong class="text-white">"Generar Reporte"</strong> para actualizar todo.
                </p>
            </div>
            <button id="btnLimpiar" class="btn btn-sm btn-outline-light" style="border-radius:8px;">
                <i class="bi bi-x-circle me-1"></i> Limpiar
            </button>
        </div>

        <div class="row g-3 align-items-end">
            <div class="col-6 col-md-2">
                <label class="form-label">Fecha Inicio</label>
                <input type="date" id="f_inicio" class="form-control">
            </div>
            <div class="col-6 col-md-2">
                <label class="form-label">Fecha Fin</label>
                <input type="date" id="f_fin" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="form-label">Departamento</label>
                <select id="f_depto" class="form-select">
                    <option value="">Todos los departamentos</option>
                    @foreach($departamentos as $dep)
                        <option value="{{ $dep->id }}">{{ $dep->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Empleado</label>
                <select id="f_empleado" class="form-select">
                    <option value="">Todos los empleados</option>
                    @foreach($empleados as $emp)
                        <option value="{{ $emp->id }}">[{{ $emp->numero_empleado }}] {{ $emp->nombre }} {{ $emp->apellido_paterno }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Estatus</label>
                <select id="f_estatus" class="form-select">
                    <option value="">Todos</option>
                    <option value="Pendiente">Pendiente</option>
                    <option value="Entregado">Entregado</option>
                </select>
            </div>
        </div>

        <div class="d-flex flex-wrap gap-2 align-items-center mt-3">
            <button id="btnGenerar" class="btn-generar btn px-4 py-2">
                <i class="bi bi-bar-chart-line-fill me-1"></i> Generar Reporte
            </button>

            {{-- Exportar --}}
            <form id="frmPdf"   method="POST" action="{{ route('reportes.pdf') }}"   class="d-inline">@csrf</form>
            <form id="frmExcel" method="POST" action="{{ route('reportes.excel') }}" class="d-inline">@csrf</form>

            <button type="button" id="btnPdf" class="btn btn-light btn-sm px-3 shadow-sm" style="border-radius:8px;">
                <i class="bi bi-file-earmark-pdf text-danger me-1"></i> PDF
            </button>
            <button type="button" id="btnExcel" class="btn btn-light btn-sm px-3 shadow-sm" style="border-radius:8px;">
                <i class="bi bi-file-earmark-excel text-success me-1"></i> Excel
            </button>

            {{-- Chips de filtros activos --}}
            <div id="filtrosActivos" class="d-flex gap-2 flex-wrap ms-1"></div>
        </div>
    </div>

    {{-- ══════════════════════════════════
         ZONA 2 — KPIs
    ══════════════════════════════════ --}}
    <div class="zona-label"><i class="bi bi-lightning-charge me-1"></i>Indicadores Clave</div>
    <div class="row g-3 mb-4" id="kpisRow">
        {{-- Total --}}
        <div class="col-6 col-md-3">
            <div class="kpi-card card shadow-sm h-100" style="background:linear-gradient(135deg,#006039,#004a2c);color:#fff;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="kpi-label">Total Incidencias</div>
                        <div class="kpi-value mt-1" id="kpiTotal">{{ $datosIniciales['kpis']['total'] }}</div>
                        <div class="kpi-sub">en el período seleccionado</div>
                    </div>
                    <i class="bi bi-card-checklist kpi-icon"></i>
                </div>
            </div>
        </div>
        {{-- Pendientes --}}
        <div class="col-6 col-md-3">
            <div class="kpi-card card shadow-sm h-100 bg-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="kpi-label text-muted">Pendientes</div>
                        <div class="kpi-value mt-1 text-warning" id="kpiPendientes">{{ $datosIniciales['kpis']['pendientes'] }}</div>
                        <div class="kpi-sub text-muted">sin entregar</div>
                    </div>
                    <i class="bi bi-clock-history kpi-icon text-warning"></i>
                </div>
            </div>
        </div>
        {{-- Entregadas --}}
        <div class="col-6 col-md-3">
            <div class="kpi-card card shadow-sm h-100 bg-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="kpi-label text-muted">Entregadas</div>
                        <div class="kpi-value mt-1 text-success" id="kpiEntregadas">{{ $datosIniciales['kpis']['entregadas'] }}</div>
                        <div class="kpi-sub text-muted">ya atendidas</div>
                    </div>
                    <i class="bi bi-check-circle kpi-icon text-success"></i>
                </div>
            </div>
        </div>
        {{-- En riesgo QUINCENA ACTUAL --}}
        <div class="col-6 col-md-3">
            <div class="kpi-card card shadow-sm h-100 bg-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="kpi-label text-muted">Personal en Riesgo</div>
                        <div class="kpi-value mt-1 text-danger" id="kpiRiesgo">{{ $datosIniciales['kpis']['en_riesgo'] }}</div>
                        <div class="kpi-sub text-muted" id="kpiQnaLabel" title="Se reinicia cada quincena">
                            <i class="bi bi-arrow-repeat me-1"></i>{{ $datosIniciales['kpis']['qna_label'] }}
                        </div>
                    </div>
                    <i class="bi bi-exclamation-triangle kpi-icon text-danger"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════
         ZONA 3 — GRÁFICAS PRINCIPALES
    ══════════════════════════════════ --}}
    <div class="zona-label"><i class="bi bi-bar-chart me-1"></i>Análisis Gráfico</div>
    <div class="row g-3 mb-4">
        {{-- Barras horizontales: por departamento --}}
        <div class="col-md-6">
            <div class="chart-card card shadow-sm h-100 p-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="section-title">Por Departamento</span>
                    <i class="bi bi-bar-chart-fill text-success opacity-50 fs-5"></i>
                </div>
                <div style="position:relative;height:240px;">
                    <canvas id="chartDepto"></canvas>
                    <div id="emptyDepto" class="d-none text-center text-muted pt-5">
                        <i class="bi bi-info-circle fs-3 d-block mb-2"></i>Sin datos
                    </div>
                </div>
            </div>
        </div>

        {{-- Dona: por tipo --}}
        <div class="col-md-3">
            <div class="chart-card card shadow-sm h-100 p-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="section-title">Por Tipo</span>
                    <i class="bi bi-pie-chart-fill text-success opacity-50 fs-5"></i>
                </div>
                <div style="position:relative;height:240px;">
                    <canvas id="chartTipo"></canvas>
                    <div id="emptyTipo" class="d-none text-center text-muted pt-5">
                        <i class="bi bi-info-circle fs-3 d-block mb-2"></i>Sin datos
                    </div>
                </div>
            </div>
        </div>

        {{-- Línea: tendencia mensual --}}
        <div class="col-md-3">
            <div class="chart-card card shadow-sm h-100 p-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="section-title">Tendencia Mensual</span>
                    <i class="bi bi-graph-up-arrow text-success opacity-50 fs-5"></i>
                </div>
                <div style="position:relative;height:240px;">
                    <canvas id="chartLinea"></canvas>
                    <div id="emptyLinea" class="d-none text-center text-muted pt-5">
                        <i class="bi bi-info-circle fs-3 d-block mb-2"></i>Sin datos
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════
         ZONA 3b — TENDENCIA POR QUINCENA
    ══════════════════════════════════ --}}
    <div class="chart-card card shadow-sm mb-4 p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <span class="section-title">Incidencias por Quincena</span>
                <span class="ms-3 small text-muted">1ª Qna = días 1–15 · 2ª Qna = días 16–fin de mes</span>
            </div>
            <i class="bi bi-calendar2-range text-success opacity-50 fs-5"></i>
        </div>
        <div style="position:relative;height:220px;">
            <canvas id="chartQuincena"></canvas>
            <div id="emptyQuincena" class="d-none text-center text-muted pt-5">
                <i class="bi bi-info-circle fs-3 d-block mb-2"></i>Sin datos
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════
         ZONA 3c — TOP EMPLEADOS (TOTAL)
    ══════════════════════════════════ --}}
    <div class="card chart-card shadow-sm mb-4 p-3">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <div>
                <span class="section-title">Top 10 Empleados con más Incidencias</span>
                <span class="ms-2 badge bg-secondary rounded-pill" style="font-size:.68rem;">Acumulado del período</span>
            </div>
            <div class="d-flex gap-3 align-items-center small text-muted">
                <span><span class="badge-riesgo">⚠ Riesgo</span> = ≥3 incidencias en la quincena actual</span>
                <span><span class="badge-qna">Qna</span> = incidencias en la quincena vigente</span>
            </div>
        </div>
        <div id="topEmpleadosContainer"></div>
    </div>

    {{-- ══════════════════════════════════
         ZONA 3d — TOP 10 DESGLOSE MENSUAL
    ══════════════════════════════════ --}}
    <div class="card chart-card shadow-sm mb-4" id="cardTopMensual">
        <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2 py-3"
             style="border-radius:16px 16px 0 0;">
            <div>
                <span class="section-title">Top 10 · Desglose por Mes y Quincena</span>
                <span class="ms-2 badge rounded-pill px-2" style="background:#eff6ff;color:#1d4ed8;font-size:.68rem;">Nuevo</span>
            </div>
            <div class="d-flex gap-3 align-items-center small text-muted flex-wrap">
                <span>
                    <span class="mes-qna-chip q1" style="font-size:.7rem;">Q1</span> = días 1–15
                    &nbsp;
                    <span class="mes-qna-chip q2" style="font-size:.7rem;">Q2</span> = días 16–fin
                </span>
                <span>Color de celda: <span style="font-size:.72rem;padding:1px 6px;border-radius:4px;background:#fee2e2;color:#dc2626;">rojo = ≥5</span></span>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="tablaTopMensual" class="table table-bordered table-hover mb-0">
                    <thead class="table-light" id="topMensualHead">
                        <tr>
                            <th class="th-emp ps-3">#&nbsp; Empleado / Depto</th>
                            <th style="min-width:60px;">Total</th>
                            {{-- Columnas de meses se insertan por JS --}}
                        </tr>
                    </thead>
                    <tbody id="topMensualBody">
                        <tr><td colspan="2" class="text-center text-muted py-4 small">Generando reporte…</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-top text-muted" style="font-size:.72rem;border-radius:0 0 16px 16px;">
            <i class="bi bi-info-circle me-1"></i>
            Los números de cada celda indican el total mensual. Las chips Q1/Q2 muestran cuántas caen en cada quincena.
            El color de fondo es un mapa de calor: más rojo = más incidencias ese mes.
        </div>
    </div>

    {{-- ══════════════════════════════════
         ZONA 4 — TABLA DE DATOS
    ══════════════════════════════════ --}}
    <div class="zona-label mt-2"><i class="bi bi-table me-1"></i>Detalle de Registros</div>
    <div class="card chart-card shadow-sm mb-4">
        <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3"
             style="border-radius:16px 16px 0 0;">
            <span class="section-title mb-0">Todos los Registros</span>
            <span id="tablaCount" class="badge bg-secondary rounded-pill">—</span>
        </div>
        <div class="card-body p-3">
            <div class="table-responsive">
                <table id="tablaReporte" class="table table-hover table-sm align-middle" style="width:100%">
                    <thead class="table-light">
                        <tr>
                            <th>Fecha</th>
                            <th>Empleado</th>
                            <th>Matrícula</th>
                            <th>Departamento</th>
                            <th>Tipo</th>
                            <th>Motivo</th>
                            <th>Estatus</th>
                            <th>Recibió</th>
                        </tr>
                    </thead>
                    <tbody id="tablaBody"></tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════
         JAVASCRIPT
    ══════════════════════════════════ --}}
    <script>
    Chart.defaults.font.family = "'Inter', sans-serif";
    Chart.defaults.color       = '#6c757d';

    const PALETTE = ['#006039','#26a65b','#3b82f6','#f59e0b','#ef4444','#14b8a6','#8b5cf6','#ec4899','#f97316','#84cc16'];

    let chartDepto, chartTipo, chartLinea, chartQuincena, dtReporte;

    // ─── Select2 ──────────────────────────────────────────────────────────────
    $(function() {
        $('#f_empleado').select2({ placeholder:'Todos los empleados', allowClear:true, width:'100%' });
    });

    // ─── DataTable ────────────────────────────────────────────────────────────
    dtReporte = $('#tablaReporte').DataTable({
        language: { url:'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-MX.json' },
        order: [[0,'desc']],
        pageLength: 15,
        data: [],
        columns: [
            { data:'fecha' },
            { data:'empleado' },
            { data:'matricula' },
            { data:'departamento' },
            { data:'tipo' },
            { data:'motivo' },
            { data:'estatus', render: d => {
                const c = d === 'Pendiente' ? 'badge-pendiente' : 'badge-entregado';
                return `<span class="badge rounded-pill px-3 ${c}">${d}</span>`;
            }},
            { data:'recibido_por' },
        ]
    });

    // ─── Helpers gráficas ─────────────────────────────────────────────────────
    const destroy = ref => { if (ref) ref.destroy(); return null; };

    function toggleEmpty(id, hasData) {
        const el = document.getElementById(id);
        el.classList.toggle('d-none', hasData);
    }

    function renderDepto(labels, data) {
        const ctx = document.getElementById('chartDepto');
        chartDepto = destroy(chartDepto);
        const ok = labels.length > 0;
        toggleEmpty('emptyDepto', ok);
        ctx.style.display = ok ? 'block' : 'none';
        if (!ok) return;
        chartDepto = new Chart(ctx, {
            type:'bar',
            data:{ labels, datasets:[{ label:'Incidencias', data, backgroundColor:PALETTE, borderRadius:8, maxBarThickness:44 }] },
            options:{
                indexAxis:'y', responsive:true, maintainAspectRatio:false,
                plugins:{ legend:{ display:false } },
                scales:{
                    x:{ beginAtZero:true, grid:{ color:'#f0f0f0' }, ticks:{ precision:0 } },
                    y:{ grid:{ display:false } }
                }
            }
        });
    }

    function renderTipo(labels, data) {
        const ctx = document.getElementById('chartTipo');
        chartTipo = destroy(chartTipo);
        const ok = labels.length > 0;
        toggleEmpty('emptyTipo', ok);
        ctx.style.display = ok ? 'block' : 'none';
        if (!ok) return;
        chartTipo = new Chart(ctx, {
            type:'doughnut',
            data:{ labels, datasets:[{ data, backgroundColor:PALETTE, borderWidth:0, hoverOffset:6 }] },
            options:{
                responsive:true, maintainAspectRatio:false,
                plugins:{ legend:{ position:'bottom', labels:{ boxWidth:10, font:{ size:10 } } } },
                cutout:'65%'
            }
        });
    }

    function renderLinea(labels, data) {
        const ctx = document.getElementById('chartLinea');
        chartLinea = destroy(chartLinea);
        const ok = labels.length > 0;
        toggleEmpty('emptyLinea', ok);
        ctx.style.display = ok ? 'block' : 'none';
        if (!ok) return;
        chartLinea = new Chart(ctx, {
            type:'line',
            data:{ labels, datasets:[{
                label:'Incidencias', data,
                borderColor:'#006039', backgroundColor:'rgba(0,96,57,.08)',
                tension:.4, fill:true, pointRadius:4, pointBackgroundColor:'#006039'
            }] },
            options:{
                responsive:true, maintainAspectRatio:false,
                plugins:{ legend:{ display:false } },
                scales:{
                    y:{ beginAtZero:true, ticks:{ precision:0 }, grid:{ color:'#f0f0f0' } },
                    x:{ grid:{ display:false }, ticks:{ maxRotation:40, font:{ size:9 } } }
                }
            }
        });
    }

    function renderQuincena(labels, data) {
        const ctx = document.getElementById('chartQuincena');
        chartQuincena = destroy(chartQuincena);
        const ok = labels.length > 0;
        toggleEmpty('emptyQuincena', ok);
        ctx.style.display = ok ? 'block' : 'none';
        if (!ok) return;

        const bgColors    = labels.map(l => l.startsWith('1') ? 'rgba(0,96,57,.82)'    : 'rgba(38,166,91,.68)');
        const borderColors = labels.map(l => l.startsWith('1') ? '#006039'              : '#26a65b');

        chartQuincena = new Chart(ctx, {
            type:'bar',
            data:{ labels, datasets:[{
                label:'Incidencias por Quincena',
                data,
                backgroundColor: bgColors,
                borderColor: borderColors,
                borderWidth: 1.5,
                borderRadius: 6,
                maxBarThickness: 52,
            }] },
            options:{
                responsive:true, maintainAspectRatio:false,
                plugins:{
                    legend:{ display:true, labels:{ boxWidth:0, generateLabels: () => [
                        { text:'1ª Quincena (1–15)',  fillStyle:'rgba(0,96,57,.82)',  strokeStyle:'#006039', lineWidth:1 },
                        { text:'2ª Quincena (16–fin)', fillStyle:'rgba(38,166,91,.68)', strokeStyle:'#26a65b', lineWidth:1 }
                    ]}},
                    tooltip:{ callbacks:{
                        title: c => c[0].label,
                        label: c => ` ${c.parsed.y} incidencia${c.parsed.y !== 1 ? 's' : ''}`
                    }}
                },
                scales:{
                    y:{ beginAtZero:true, ticks:{ precision:0 }, grid:{ color:'#f0f0f0' } },
                    x:{ grid:{ display:false }, ticks:{ font:{ size:10 } } }
                }
            }
        });
    }

    // ─── Top 10 – Total del período ───────────────────────────────────────────
    function renderTop(empleados) {
        const cont = document.getElementById('topEmpleadosContainer');
        if (!empleados.length) {
            cont.innerHTML = '<p class="text-muted text-center py-3 small">Sin datos para el filtro seleccionado.</p>';
            return;
        }
        const max = empleados[0].total;
        cont.innerHTML = empleados.map((e, i) => {
            const pct    = max > 0 ? Math.round((e.total / max) * 100) : 0;
            const riesgo = e.riesgo;
            const qnaBadge = e.en_qna_actual > 0
                ? `<span class="badge-qna ms-1">Qna: ${e.en_qna_actual}</span>`
                : '';
            return `
            <div class="d-flex align-items-center gap-3 py-2 ${i < empleados.length - 1 ? 'border-bottom' : ''}">
                <div class="fw-bold text-muted text-center" style="min-width:24px;font-size:.82rem;">#${i+1}</div>
                <div style="min-width:210px;">
                    <div class="fw-semibold" style="font-size:.88rem;">
                        ${e.nombre}
                        <span class="${riesgo ? 'badge-riesgo' : 'badge-ok'} ms-1">${riesgo ? '⚠ Riesgo' : '✓ Normal'}</span>
                        ${qnaBadge}
                    </div>
                    <div class="text-muted" style="font-size:.73rem;">${e.depto} · Matrícula: ${e.matricula}</div>
                </div>
                <div class="flex-grow-1">
                    <div class="emp-bar-wrap">
                        <div class="emp-bar-fill ${riesgo ? 'riesgo' : ''}" style="width:${pct}%;"></div>
                    </div>
                </div>
                <div class="text-end" style="min-width:80px;">
                    <span class="fw-bold fs-6">${e.total}</span>
                    <span class="text-muted small"> total</span>
                    <div class="text-muted" style="font-size:.7rem;">${e.pendientes} pendiente${e.pendientes !== 1 ? 's' : ''}</div>
                </div>
            </div>`;
        }).join('');
    }

    // ─── Top 10 – Desglose mensual/quincena ──────────────────────────────────
    function heatClass(n) {
        if (n === 0) return 'mes-heat-0';
        if (n === 1) return 'mes-heat-1';
        if (n === 2) return 'mes-heat-2';
        if (n === 3) return 'mes-heat-3';
        if (n === 4) return 'mes-heat-4';
        return 'mes-heat-5p';
    }
    function totalColor(n) {
        if (n === 0) return 'cero';
        if (n <= 2)  return 'bajo';
        if (n <= 4)  return 'medio';
        return 'alto';
    }

    function renderTopMensual(data) {
        const { meses, empleados } = data;
        const thead = document.getElementById('topMensualHead');
        const tbody = document.getElementById('topMensualBody');

        if (!empleados.length || !meses.length) {
            thead.innerHTML = `<tr><th class="th-emp ps-3"># Empleado / Depto</th><th>Total</th></tr>`;
            tbody.innerHTML = `<tr><td colspan="2" class="text-center text-muted py-4 small">Sin datos para el filtro seleccionado.</td></tr>`;
            return;
        }

        // ── Encabezado dinámico: fila 1 = mes (colspan 2), fila 2 = Q1 | Q2 ────
        thead.innerHTML = `
            <tr>
                <th class="th-emp ps-3" rowspan="2">#&nbsp; Empleado / Depto</th>
                <th rowspan="2" style="min-width:56px;text-align:center;">Total</th>
                ${meses.map(m => `<th colspan="2" style="min-width:90px;text-align:center;">${m}</th>`).join('')}
            </tr>
            <tr>
                ${meses.map(() => `
                    <th style="width:46px;font-size:.65rem;color:#006039;text-align:center;">
                        Q1<br><span style="font-weight:400;color:#adb5bd;font-size:.58rem;">1–15</span>
                    </th>
                    <th style="width:46px;font-size:.65rem;color:#1a7a3c;text-align:center;">
                        Q2<br><span style="font-weight:400;color:#adb5bd;font-size:.58rem;">16–fin</span>
                    </th>
                `).join('')}
            </tr>`;

        // ── Filas de empleados: 2 td por mes (Q1 y Q2 separadas) ─────────────
        tbody.innerHTML = empleados.map((e, i) => {
            const riesgo = e.riesgo;

            // Genera DOS celdas por mes: una Q1 y una Q2
            const celdas = e.por_mes.map(m => {
                const hcQ1 = heatClass(m.q1);
                const tcQ1 = totalColor(m.q1);
                const hcQ2 = heatClass(m.q2);
                const tcQ2 = totalColor(m.q2);

                const tdQ1 = `
                    <td class="${hcQ1}" title="1ª Quincena (días 1–15): ${m.q1}" style="text-align:center;vertical-align:middle;padding:4px 2px;">
                        <span class="mes-total ${tcQ1}" style="font-size:.85rem;">${m.q1 > 0 ? m.q1 : '—'}</span>
                    </td>`;
                const tdQ2 = `
                    <td class="${hcQ2}" title="2ª Quincena (días 16–fin): ${m.q2}" style="text-align:center;vertical-align:middle;padding:4px 2px;">
                        <span class="mes-total ${tcQ2}" style="font-size:.85rem;">${m.q2 > 0 ? m.q2 : '—'}</span>
                    </td>`;

                return tdQ1 + tdQ2;
            }).join('');

            return `
            <tr>
                <td class="td-emp ps-3">
                    <div class="fw-semibold" style="font-size:.82rem;">
                        <span class="text-muted me-1">#${i+1}</span>
                        ${e.nombre}
                        <span class="${riesgo ? 'badge-riesgo' : 'badge-ok'} ms-1">${riesgo ? '⚠' : '✓'}</span>
                    </div>
                    <div class="text-muted" style="font-size:.7rem;">${e.depto} · ${e.matricula}</div>
                </td>
                <td class="fw-bold" style="font-size:1rem;text-align:center;">${e.total}</td>
                ${celdas}
            </tr>`;
        }).join('');
    }


    // ─── Aplicar todos los datos a la UI ──────────────────────────────────────
    function aplicarDatos(d) {
        // KPIs
        document.getElementById('kpiTotal').textContent      = d.kpis.total;
        document.getElementById('kpiPendientes').textContent  = d.kpis.pendientes;
        document.getElementById('kpiEntregadas').textContent  = d.kpis.entregadas;
        document.getElementById('kpiRiesgo').textContent     = d.kpis.en_riesgo;
        document.getElementById('kpiQnaLabel').innerHTML     = `<i class="bi bi-arrow-repeat me-1"></i>${d.kpis.qna_label}`;

        // Gráficas
        renderDepto   (d.graficas.depto.labels,    d.graficas.depto.data);
        renderTipo    (d.graficas.tipo.labels,     d.graficas.tipo.data);
        renderLinea   (d.graficas.linea.labels,    d.graficas.linea.data);
        renderQuincena(d.graficas.quincena.labels, d.graficas.quincena.data);

        // Top empleados — acumulado
        renderTop(d.top_empleados);

        // Top empleados — desglose mensual/quincena
        renderTopMensual(d.top_empleados_mensual);

        // Tabla
        dtReporte.clear();
        dtReporte.rows.add(d.tabla).draw();
        document.getElementById('tablaCount').textContent = d.tabla.length + ' registros';

        // Chips
        const chips = [];
        const fi = document.getElementById('f_inicio').value;
        const ff = document.getElementById('f_fin').value;
        const fd = document.getElementById('f_depto').selectedOptions[0];
        const fe = document.getElementById('f_empleado').selectedOptions[0];
        const fs = document.getElementById('f_estatus').value;
        if (fi) chips.push('Desde ' + fi);
        if (ff) chips.push('Hasta ' + ff);
        if (fd?.value) chips.push(fd.text);
        if (fe?.value) chips.push(fe.text.replace(/^\[.*?\]\s*/, ''));
        if (fs) chips.push(fs);
        document.getElementById('filtrosActivos').innerHTML = chips
            .map(c => `<span class="filtro-chip"><i class="bi bi-filter-circle me-1"></i>${c}</span>`).join('');
    }

    // ─── Fetch AJAX ───────────────────────────────────────────────────────────
    async function generarReporte() {
        document.getElementById('loaderOverlay').classList.add('show');
        const params = new URLSearchParams({
            fecha_inicio:    document.getElementById('f_inicio').value,
            fecha_fin:       document.getElementById('f_fin').value,
            departamento_id: document.getElementById('f_depto').value,
            empleado_id:     document.getElementById('f_empleado').value,
            estatus:         document.getElementById('f_estatus').value,
        });
        try {
            const res  = await fetch(`{{ route('reportes.datos') }}?${params}`, { headers:{ Accept:'application/json' } });
            const json = await res.json();
            aplicarDatos(json);
        } catch(e) {
            console.error('Error generando reporte:', e);
        } finally {
            document.getElementById('loaderOverlay').classList.remove('show');
        }
    }

    // ─── Botones ──────────────────────────────────────────────────────────────
    document.getElementById('btnGenerar').addEventListener('click', generarReporte);

    document.getElementById('btnLimpiar').addEventListener('click', () => {
        document.getElementById('f_inicio').value  = '';
        document.getElementById('f_fin').value     = '';
        document.getElementById('f_depto').value   = '';
        document.getElementById('f_estatus').value = '';
        $('#f_empleado').val(null).trigger('change');
        generarReporte();
    });

    function exportar(formId) {
        const frm = document.getElementById(formId);
        frm.querySelectorAll('input.filtro-hidden').forEach(el => el.remove());
        const campos = {
            fecha_inicio:    document.getElementById('f_inicio').value,
            fecha_fin:       document.getElementById('f_fin').value,
            departamento_id: document.getElementById('f_depto').value,
            empleado_id:     document.getElementById('f_empleado').value,
            estatus:         document.getElementById('f_estatus').value,
        };
        Object.entries(campos).forEach(([k,v]) => {
            const inp = document.createElement('input');
            inp.type = 'hidden'; inp.name = k; inp.value = v; inp.className = 'filtro-hidden';
            frm.appendChild(inp);
        });
        frm.submit();
    }
    document.getElementById('btnPdf').addEventListener('click',   () => exportar('frmPdf'));
    document.getElementById('btnExcel').addEventListener('click', () => exportar('frmExcel'));

    // ─── Carga inicial ────────────────────────────────────────────────────────
    document.addEventListener('DOMContentLoaded', () => {
        const init = @json($datosIniciales);
        aplicarDatos(init);
    });
    </script>
</x-app-layout>
