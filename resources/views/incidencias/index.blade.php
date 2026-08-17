<x-app-layout>
    <x-slot name="header">
        Control de Incidencias
    </x-slot>

    {{-- ═══════════════════════════════════════════
         DEPENDENCIAS EXTERNAS
    ═══════════════════════════════════════════ --}}
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        /* ── Paleta general ───────────────────────── */
        :root {
            --inc-green:   #1a7a3c;
            --inc-green2:  #26a65b;
            --inc-amber:   #f59e0b;
            --inc-blue:    #3b82f6;
            --inc-gray:    #6b7280;
        }

        /* ── Select2 ─────────────────────────────── */
        .select2-container .select2-selection--single {
            height: 38px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 4px 12px;
            background-color: #fff;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px; right: 10px;
        }
        .select2-container { width: 100% !important; }

        /* ── Tabs personalizados ─────────────────── */
        .inc-tabs .nav-link {
            border-radius: 10px 10px 0 0;
            font-weight: 600;
            color: #6b7280;
            border: 2px solid transparent;
            padding: 10px 22px;
            transition: all .2s;
        }
        .inc-tabs .nav-link.active {
            color: var(--inc-green);
            border-color: #dee2e6 #dee2e6 #fff;
            background: #fff;
        }
        .inc-tabs .nav-link:hover:not(.active) { background: #f8f9fa; color: #374151; }

        /* ── Badge contador tab ──────────────────── */
        .tab-badge {
            display: inline-flex; align-items: center; justify-content: center;
            min-width: 22px; height: 22px; border-radius: 50px;
            font-size: .72rem; font-weight: 700; padding: 0 6px;
            background: var(--inc-amber); color: #fff;
            margin-left: 6px; vertical-align: middle;
            transition: transform .3s;
        }
        .tab-badge.zero { background: #d1d5db; }

        /* ── Panel de filtros ────────────────────── */
        .filtros-panel {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 18px;
        }
        .filtros-panel .filtro-titulo {
            font-size: .8rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: .05em; color: #94a3b8; margin-bottom: 12px;
        }

        /* ── Tabla acciones ──────────────────────── */
        .btn-accion {
            width: 30px; height: 30px; padding: 0;
            display: inline-flex; align-items: center; justify-content: center;
            border-radius: 7px; transition: all .15s;
        }
        .btn-accion:hover { transform: scale(1.12); }

        /* ── Badges de estatus ───────────────────── */
        .badge-pendiente { background: #fff3cd; color: #856404; border: 1px solid #ffc107; }
        .badge-entregado { background: #d1e7dd; color: #0f5132; border: 1px solid #198754; }
        .badge-rechazado { background: #f8d7da; color: #842029; border: 1px solid #dc3545; }

        /* ── Offcanvas formulario ────────────────── */
        #offcanvasCaptura .offcanvas-header {
            background: linear-gradient(135deg, var(--inc-green), var(--inc-green2));
            color: #fff;
        }
        #offcanvasCaptura .offcanvas-header .btn-close { filter: invert(1); }
        #offcanvasCaptura { width: 480px !important; }

        /* ── Toast ───────────────────────────────── */
        #toastNotif { min-width: 280px; }

        /* ── Detalle modal ───────────────────────── */
        .detail-row { display: flex; gap: 8px; padding: 7px 0; border-bottom: 1px solid #f0f0f0; }
        .detail-label { font-weight: 600; min-width: 140px; color: #555; font-size: .83rem; }
        .detail-value { color: #222; font-size: .9rem; }

        /* ── Highlight al registrar ──────────────── */
        @keyframes rowFlash { 0%,100%{background:transparent} 50%{background:#d1fae5} }
        .row-new { animation: rowFlash 1.2s ease; }

        /* ── Fecha entrega chip ──────────────────── */
        .chip-fecha {
            display: inline-flex; align-items: center; gap: 4px;
            font-size: .78rem; background: #eff6ff; color: #1e40af;
            border-radius: 20px; padding: 2px 10px; border: 1px solid #bfdbfe;
        }

        /* ── Tabla sin search nativo ─────────────── */
        .dataTables_filter { display: none !important; }
        .dataTables_length  label { font-size: .85rem; }

        /* ── Animación de carga ──────────────────── */
        .skeleton-row td { background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%; animation: shimmer 1.2s infinite; height: 38px; }
        @keyframes shimmer { 0%{background-position:200% 0} 100%{background-position:-200% 0} }

        /* ── Pill info pendientes sin data ───────── */
        .empty-state { text-align:center; padding: 40px 20px; color: #9ca3af; }
        .empty-state i { font-size: 2.5rem; display:block; margin-bottom: 10px; }
    </style>

    {{-- ═══════════════════════════════════════════
         ENCABEZADO / ACCIONES GLOBALES
    ═══════════════════════════════════════════ --}}
    <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-3">
        <div>
            <h5 class="mb-0 fw-bold" style="color: var(--cb-black);">
                <i class="bi bi-card-checklist me-2"></i> Control de Incidencias
            </h5>
            <p class="text-muted small mb-0">Gestión y seguimiento de incidencias del personal</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-primary btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#modalDepartamento">
                <i class="bi bi-people-fill me-1"></i> Entregar por Departamento
            </button>
            <button class="btn btn-primary shadow-sm" style="background-color: var(--cb-green); border-color: var(--cb-green);"
                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasCaptura">
                <i class="bi bi-plus-lg me-1"></i> Capturar Incidencia
            </button>
        </div>
    </div>

    {{-- Alerta flash --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- ═══════════════════════════════════════════
         TABS
    ═══════════════════════════════════════════ --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-bottom-0 pt-3 pb-0 px-4">
            <ul class="nav nav-tabs inc-tabs border-0" id="incTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="tab-pendientes-btn" data-bs-toggle="tab"
                            data-bs-target="#tab-pendientes" type="button" role="tab">
                        <i class="bi bi-hourglass-split me-1"></i>
                        Pendientes
                        <span class="tab-badge {{ $pendientes->count() == 0 ? 'zero' : '' }}" id="badgePendientes">
                            {{ $pendientes->count() }}
                        </span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-historial-btn" data-bs-toggle="tab"
                            data-bs-target="#tab-historial" type="button" role="tab">
                        <i class="bi bi-clock-history me-1"></i>
                        Historial de Entregadas
                        <span class="tab-badge zero" id="badgeHistorial">
                            {{ $entregadas->count() }}
                        </span>
                    </button>
                </li>
            </ul>
        </div>

        <div class="tab-content" id="incTabsContent">

            {{-- ════════════════════════════════════
                 TAB 1 – PENDIENTES
            ════════════════════════════════════ --}}
            <div class="tab-pane fade show active p-4" id="tab-pendientes" role="tabpanel">

                {{-- Panel de filtros –– Pendientes --}}
                <div class="filtros-panel">
                    <div class="filtro-titulo"><i class="bi bi-funnel-fill me-1"></i> Filtros rápidos</div>
                    <div class="row g-2 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label small mb-1 fw-semibold">Nombre / Matrícula</label>
                            <input type="text" id="pNombre" class="form-control form-control-sm"
                                   placeholder="Buscar empleado…" autocomplete="off">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small mb-1 fw-semibold">Departamento</label>
                            <select id="pDepartamento" class="form-select form-select-sm">
                                <option value="">Todos</option>
                                @foreach($departamentos as $dep)
                                    <option value="{{ $dep->id }}">{{ $dep->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small mb-1 fw-semibold">Mes</label>
                            <select id="pMes" class="form-select form-select-sm">
                                <option value="">Todos</option>
                                <option value="1">Enero</option><option value="2">Febrero</option>
                                <option value="3">Marzo</option><option value="4">Abril</option>
                                <option value="5">Mayo</option><option value="6">Junio</option>
                                <option value="7">Julio</option><option value="8">Agosto</option>
                                <option value="9">Septiembre</option><option value="10">Octubre</option>
                                <option value="11">Noviembre</option><option value="12">Diciembre</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small mb-1 fw-semibold">Año</label>
                            <select id="pAnio" class="form-select form-select-sm">
                                <option value="">Todos</option>
                                @for($y = date('Y'); $y >= 2024; $y--)
                                    <option value="{{ $y }}" {{ $y == date('Y') ? 'selected' : '' }}>{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small mb-1 fw-semibold">Quincena</label>
                            <select id="pQuincena" class="form-select form-select-sm">
                                <option value="">Todas</option>
                                <option value="1">1ª (1–15)</option>
                                <option value="2">2ª (16–fin)</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small mb-1 fw-semibold">Rango de fechas</label>
                            <div class="d-flex gap-1">
                                <input type="date" id="pFechaDesde" class="form-control form-control-sm" placeholder="Desde">
                                <input type="date" id="pFechaHasta" class="form-control form-control-sm" placeholder="Hasta">
                            </div>
                        </div>
                        <div class="col-md-auto d-flex gap-2 mt-1">
                            <button id="btnFiltrarPendientes" class="btn btn-sm btn-primary px-3"
                                    style="background:var(--inc-green);border-color:var(--inc-green)">
                                <i class="bi bi-search me-1"></i> Filtrar
                            </button>
                            <button id="btnLimpiarPendientes" class="btn btn-sm btn-outline-secondary px-3">
                                <i class="bi bi-x-circle me-1"></i> Limpiar
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Tabla pendientes --}}
                <div class="table-responsive">
                    <table id="tablaPendientes" class="table table-hover align-middle" style="width:100%">
                        <thead class="table-light">
                            <tr>
                                <th>Fecha Incidencia</th>
                                <th>Empleado</th>
                                <th>Departamento</th>
                                <th>Tipo</th>
                                <th>Fecha Registro</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="pendientesBody">
                            @foreach($pendientes as $inc)
                            <tr id="row-p-{{ $inc->id }}"
                                data-id="{{ $inc->id }}"
                                data-departamento-id="{{ $inc->departamento_id }}"
                                data-estatus="Pendiente">
                                <td class="fw-bold">{{ \Carbon\Carbon::parse($inc->fecha)->format('d/m/Y') }}</td>
                                <td>
                                    <div class="fw-bold">{{ $inc->empleado->nombre }} {{ $inc->empleado->apellido_paterno }}</div>
                                    <div class="small text-muted">Mat: {{ $inc->empleado->numero_empleado }}</div>
                                </td>
                                <td>{{ optional($inc->departamento)->nombre ?? 'N/A' }}</td>
                                <td><span class="badge bg-secondary rounded-pill px-3">{{ optional($inc->tipoIncidencia)->nombre ?? 'N/A' }}</span></td>
                                <td class="small text-muted">{{ $inc->created_at->format('d/m/Y H:i') }}</td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-outline-secondary btn-accion btn-ver"
                                                title="Ver Detalles" data-id="{{ $inc->id }}">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-success btn-accion btn-entregar"
                                                title="Marcar como Entregado"
                                                data-id="{{ $inc->id }}"
                                                data-empleado="{{ $inc->empleado->nombre }} {{ $inc->empleado->apellido_paterno }}">
                                            <i class="bi bi-check-circle"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ════════════════════════════════════
                 TAB 2 – HISTORIAL ENTREGADAS
            ════════════════════════════════════ --}}
            <div class="tab-pane fade p-4" id="tab-historial" role="tabpanel">

                {{-- Panel de filtros –– Historial --}}
                <div class="filtros-panel">
                    <div class="filtro-titulo"><i class="bi bi-funnel-fill me-1"></i> Filtros de búsqueda</div>
                    <div class="row g-2 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label small mb-1 fw-semibold">Nombre / Matrícula</label>
                            <input type="text" id="hNombre" class="form-control form-control-sm"
                                   placeholder="Buscar empleado…" autocomplete="off">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small mb-1 fw-semibold">Departamento</label>
                            <select id="hDepartamento" class="form-select form-select-sm">
                                <option value="">Todos</option>
                                @foreach($departamentos as $dep)
                                    <option value="{{ $dep->id }}">{{ $dep->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small mb-1 fw-semibold">Persona que recibió</label>
                            <input type="text" id="hRecibidoPor" class="form-control form-select-sm"
                                   placeholder="Nombre del receptor…" autocomplete="off">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small mb-1 fw-semibold">Mes</label>
                            <select id="hMes" class="form-select form-select-sm">
                                <option value="">Todos</option>
                                <option value="1">Enero</option><option value="2">Febrero</option>
                                <option value="3">Marzo</option><option value="4">Abril</option>
                                <option value="5">Mayo</option><option value="6">Junio</option>
                                <option value="7">Julio</option><option value="8">Agosto</option>
                                <option value="9">Septiembre</option><option value="10">Octubre</option>
                                <option value="11">Noviembre</option><option value="12">Diciembre</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <label class="form-label small mb-1 fw-semibold">Año</label>
                            <select id="hAnio" class="form-select form-select-sm">
                                <option value="">Todos</option>
                                @for($y = date('Y'); $y >= 2024; $y--)
                                    <option value="{{ $y }}" {{ $y == date('Y') ? 'selected' : '' }}>{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-1">
                            <label class="form-label small mb-1 fw-semibold">Quincena</label>
                            <select id="hQuincena" class="form-select form-select-sm">
                                <option value="">Todas</option>
                                <option value="1">1ª (1–15)</option>
                                <option value="2">2ª (16–fin)</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <div class="row g-2 align-items-end">
                                <div class="col-md-4">
                                    <label class="form-label small mb-1 fw-semibold">Rango de fechas de incidencia</label>
                                    <div class="d-flex gap-1">
                                        <input type="date" id="hFechaDesde" class="form-control form-control-sm" placeholder="Desde">
                                        <input type="date" id="hFechaHasta" class="form-control form-control-sm" placeholder="Hasta">
                                    </div>
                                </div>
                                <div class="col-md-auto d-flex gap-2">
                                    <button id="btnFiltrarHistorial" class="btn btn-sm btn-primary px-3"
                                            style="background:var(--inc-green);border-color:var(--inc-green)">
                                        <i class="bi bi-search me-1"></i> Filtrar
                                    </button>
                                    <button id="btnLimpiarHistorial" class="btn btn-sm btn-outline-secondary px-3">
                                        <i class="bi bi-x-circle me-1"></i> Limpiar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tabla historial --}}
                <div class="table-responsive">
                    <table id="tablaHistorial" class="table table-hover align-middle" style="width:100%">
                        <thead class="table-light">
                            <tr>
                                <th>Fecha Incidencia</th>
                                <th>Empleado</th>
                                <th>Departamento</th>
                                <th>Tipo</th>
                                <th>Registrado</th>
                                <th>Entregado</th>
                                <th>Recibió</th>
                                <th class="text-center">Detalle</th>
                            </tr>
                        </thead>
                        <tbody id="historialBody">
                            @foreach($entregadas as $inc)
                            <tr id="row-h-{{ $inc->id }}" data-id="{{ $inc->id }}">
                                <td class="fw-bold">{{ \Carbon\Carbon::parse($inc->fecha)->format('d/m/Y') }}</td>
                                <td>
                                    <div class="fw-bold">{{ $inc->empleado->nombre }} {{ $inc->empleado->apellido_paterno }}</div>
                                    <div class="small text-muted">Mat: {{ $inc->empleado->numero_empleado }}</div>
                                </td>
                                <td>{{ optional($inc->departamento)->nombre ?? 'N/A' }}</td>
                                <td><span class="badge bg-secondary rounded-pill px-3">{{ optional($inc->tipoIncidencia)->nombre ?? 'N/A' }}</span></td>
                                <td class="small text-muted">{{ $inc->created_at->format('d/m/Y') }}</td>
                                <td>
                                    @if($inc->fecha_entrega)
                                        <span class="chip-fecha">
                                            <i class="bi bi-calendar-check"></i>
                                            {{ \Carbon\Carbon::parse($inc->fecha_entrega)->format('d/m/Y H:i') }}
                                        </span>
                                    @else
                                        <span class="text-muted small">—</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="fw-semibold text-success small">{{ $inc->recibido_por ?? '—' }}</span>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-outline-secondary btn-accion btn-ver"
                                            title="Ver Detalles" data-id="{{ $inc->id }}">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>{{-- fin tab-content --}}
    </div>{{-- fin card --}}

    {{-- ═══════════════════════════════════════════
         OFFCANVAS – CAPTURA RÁPIDA
    ═══════════════════════════════════════════ --}}
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCaptura" aria-labelledby="offcanvasCapturaLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title fw-bold" id="offcanvasCapturaLabel">
                <i class="bi bi-file-earmark-plus me-2"></i> Nueva Incidencia
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <div id="capturaAlert" class="alert alert-danger d-none small"></div>
            <form id="formCaptura" novalidate>
                @csrf
                <div class="mb-3">
                    <label for="oc_empleado_id" class="form-label fw-semibold">
                        Empleado <span class="text-danger">*</span>
                    </label>
                    <select id="oc_empleado_id" name="empleado_id" class="form-select" required>
                        <option value="">Buscar por Matrícula o Nombre…</option>
                        @foreach($empleados as $emp)
                            <option value="{{ $emp->id }}">[{{ $emp->numero_empleado }}] {{ $emp->nombre }} {{ $emp->apellido_paterno }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="oc_fecha" class="form-label fw-semibold">
                        Fecha <span class="text-danger">*</span>
                    </label>
                    <input type="date" id="oc_fecha" name="fecha"
                           class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>
                <div class="mb-3">
                    <label for="oc_tipo" class="form-label fw-semibold">
                        Tipo de Incidencia <span class="text-danger">*</span>
                    </label>
                    <select id="oc_tipo" name="tipo_incidencia_id" class="form-select" required>
                        <option value="">Seleccione el tipo…</option>
                        @foreach($tipos as $tipo)
                            <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="oc_motivo" class="form-label fw-semibold">Motivo <span class="text-muted fw-normal">(opcional)</span></label>
                    <input type="text" id="oc_motivo" name="motivo" class="form-control"
                           placeholder="Ej. Retardo por tráfico, Consulta médica…">
                </div>
                <div class="mb-4">
                    <label for="oc_observaciones" class="form-label fw-semibold">Observaciones <span class="text-muted fw-normal">(opcional)</span></label>
                    <textarea id="oc_observaciones" name="observaciones" class="form-control" rows="3"
                              placeholder="Detalles adicionales si son necesarios…"></textarea>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" id="btnGuardar" class="btn btn-primary fw-semibold py-2"
                            style="background-color: var(--cb-green); border-color: var(--cb-green);">
                        <i class="bi bi-save me-1"></i> Registrar Incidencia
                    </button>
                    <button type="button" id="btnGuardarOtro" class="btn btn-outline-secondary fw-semibold py-2">
                        <i class="bi bi-plus-circle me-1"></i> Guardar y Registrar Otra
                    </button>
                </div>
            </form>
            <hr>
            <p class="text-muted small text-center mb-0">
                <i class="bi bi-info-circle me-1"></i>
                La tabla se actualiza automáticamente al guardar.
            </p>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════
         MODAL – ENTREGA INDIVIDUAL
    ═══════════════════════════════════════════ --}}
    <div class="modal fade" id="modalEntregar" tabindex="-1" aria-labelledby="modalEntregarLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="modalEntregarLabel">
                        <i class="bi bi-check-circle-fill text-success me-2"></i> Registrar Entrega
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body pt-2">
                    <p class="text-muted small mb-3" id="entregaDescripcion">
                        Incidencia de <strong id="entregaEmpleado"></strong>
                    </p>
                    <div id="entregaAlert" class="alert alert-danger d-none small"></div>
                    <form id="formEntregar">
                        <input type="hidden" id="entregaIncidenciaId">
                        <div class="mb-3">
                            <label for="entregaRecibidoPor" class="form-label fw-semibold">
                                ¿A quién se le entrega? <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="entregaRecibidoPor" class="form-control form-control-lg"
                                   placeholder="Nombre completo de quien recibe" required autocomplete="off">
                            <div class="form-text">Este nombre quedará registrado en el historial.</div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="btnConfirmarEntrega" class="btn btn-success px-4 fw-semibold">
                        <i class="bi bi-check-lg me-1"></i> Confirmar Entrega
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════
         MODAL – ENTREGA POR DEPARTAMENTO
    ═══════════════════════════════════════════ --}}
    <div class="modal fade" id="modalDepartamento" tabindex="-1" aria-labelledby="modalDepartamentoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="modalDepartamentoLabel">
                        <i class="bi bi-people-fill text-primary me-2"></i> Entrega por Departamento
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body pt-2">
                    <div id="deptoAlert" class="alert alert-danger d-none small"></div>
                    <div id="deptoStep1">
                        <p class="text-muted small mb-3">Selecciona el departamento para ver sus incidencias pendientes.</p>
                        <div class="mb-3">
                            <label for="filtroDepartamento" class="form-label fw-semibold">Departamento</label>
                            <select id="filtroDepartamento" class="form-select">
                                <option value="">— Selecciona un departamento —</option>
                                @foreach($departamentos as $dep)
                                    <option value="{{ $dep->id }}">{{ $dep->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="button" id="btnBuscarPendientes" class="btn btn-primary">
                            <i class="bi bi-search me-1"></i> Buscar Pendientes
                        </button>
                    </div>
                    <div id="deptoStep2" class="d-none mt-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <strong id="deptoNombre" class="text-primary"></strong>
                            <button type="button" class="btn btn-sm btn-outline-secondary" id="btnSelectAll">
                                <i class="bi bi-check-all me-1"></i> Seleccionar todas
                            </button>
                        </div>
                        <div class="table-responsive mb-3" style="max-height:280px; overflow-y:auto;">
                            <table class="table table-sm table-hover align-middle mb-0">
                                <thead class="table-light sticky-top">
                                    <tr>
                                        <th style="width:36px"><input type="checkbox" id="chkAll" class="form-check-input"></th>
                                        <th>Empleado</th>
                                        <th>Fecha</th>
                                        <th>Tipo</th>
                                        <th>Registrado</th>
                                    </tr>
                                </thead>
                                <tbody id="pendientesList"></tbody>
                            </table>
                        </div>
                        <div id="sinPendientes" class="alert alert-info d-none small">
                            <i class="bi bi-info-circle me-1"></i> No hay incidencias pendientes en este departamento.
                        </div>
                        <div class="mb-3" id="campoReceptorDepto">
                            <label for="deptoRecibidoPor" class="form-label fw-semibold">
                                ¿A quién se le entregan? <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="deptoRecibidoPor" class="form-control"
                                   placeholder="Nombre completo de quien recibe" autocomplete="off">
                            <div class="form-text">Un solo receptor para todas las incidencias seleccionadas.</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="btnConfirmarDeptoEntrega" class="btn btn-success px-4 fw-semibold d-none">
                        <i class="bi bi-check-all me-1"></i> Entregar Seleccionadas
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════
         MODAL – VER DETALLES
    ═══════════════════════════════════════════ --}}
    <div class="modal fade" id="modalDetalle" tabindex="-1" aria-labelledby="modalDetalleLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header border-0 pb-0"
                     style="background: linear-gradient(135deg,#1a7a3c,#26a65b); color:#fff; border-radius: 1rem 1rem 0 0;">
                    <h5 class="modal-title fw-bold" id="modalDetalleLabel">
                        <i class="bi bi-file-text me-2"></i> Detalle de Incidencia
                    </h5>
                    <button type="button" class="btn-close" style="filter:invert(1);" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="detalleBody">
                    <div class="text-center py-4">
                        <div class="spinner-border text-success" role="status"></div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════
         TOAST – NOTIFICACIÓN
    ═══════════════════════════════════════════ --}}
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index:9999;">
        <div id="toastNotif" class="toast align-items-center border-0 text-white" role="alert" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body fw-semibold" id="toastMsg"></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════
         JAVASCRIPT
    ═══════════════════════════════════════════ --}}
    <script>
    const CSRF = document.querySelector('meta[name="csrf-token"]')?.content ?? '{{ csrf_token() }}';
    const ROUTE_STORE     = '{{ route("incidencias.store") }}';
    const ROUTE_FILTRAR   = '{{ route("incidencias.filtrar") }}';
    const ROUTE_DEP_ENT   = '{{ route("incidencias.entregar-departamento") }}';

    // ─── Helpers ─────────────────────────────────────────────────────────────
    function showToast(msg, type = 'success') {
        const t = document.getElementById('toastNotif');
        t.className = `toast align-items-center border-0 text-white bg-${type === 'success' ? 'success' : 'danger'}`;
        document.getElementById('toastMsg').textContent = msg;
        bootstrap.Toast.getOrCreateInstance(t, { delay: 3500 }).show();
    }

    function badgeHtml(estatus) {
        const cls = estatus === 'Pendiente' ? 'badge-pendiente'
                  : estatus === 'Entregado' ? 'badge-entregado' : 'badge-rechazado';
        return `<span class="badge rounded-pill px-3 badge-estatus ${cls}">${estatus}</span>`;
    }

    function chipFecha(fechaStr) {
        if (!fechaStr) return '<span class="text-muted small">—</span>';
        return `<span class="chip-fecha"><i class="bi bi-calendar-check"></i> ${fechaStr}</span>`;
    }

    // ─── DataTables ───────────────────────────────────────────────────────────
    const dtP = $('#tablaPendientes').DataTable({
        language: { url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-MX.json' },
        order: [[0, 'asc']],
        pageLength: 20,
        columnDefs: [{ orderable: false, targets: 5 }]
    });

    const dtH = $('#tablaHistorial').DataTable({
        language: { url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-MX.json' },
        order: [[5, 'desc']],
        pageLength: 20,
        columnDefs: [{ orderable: false, targets: 7 }]
    });

    // ─── Actualizar badge contador ─────────────────────────────────────────
    function actualizarBadgePendientes(total) {
        const badge = document.getElementById('badgePendientes');
        badge.textContent = total;
        badge.classList.toggle('zero', total == 0);
    }

    // ─── Select2 en offcanvas ─────────────────────────────────────────────────
    document.getElementById('offcanvasCaptura').addEventListener('shown.bs.offcanvas', () => {
        if (!$('#oc_empleado_id').hasClass('select2-hidden-accessible')) {
            $('#oc_empleado_id').select2({
                placeholder: 'Buscar empleado…', allowClear: true,
                width: '100%', dropdownParent: $('#offcanvasCaptura')
            });
        }
        document.getElementById('oc_fecha').value = new Date().toISOString().split('T')[0];
    });

    // ─── SUBMIT Offcanvas ────────────────────────────────────────────────────
    async function submitCaptura(keepOpen) {
        const form  = document.getElementById('formCaptura');
        const alert = document.getElementById('capturaAlert');
        const btn   = document.getElementById('btnGuardar');
        alert.classList.add('d-none');

        if (!form.checkValidity()) { form.reportValidity(); return; }

        const fd = new FormData(form);
        fd.append('_token', CSRF);

        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Guardando…';

        try {
            const res  = await fetch(ROUTE_STORE, {
                method: 'POST',
                headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF },
                body: fd
            });
            const json = await res.json();
            if (!res.ok || !json.success) throw new Error(json.message ?? 'Error al guardar.');

            const inc = json.incidencia;

            // Agregar fila a la tabla de Pendientes
            const node = dtP.row.add([
                `<span class="fw-bold">${inc.fecha}</span>`,
                `<div class="fw-bold">${inc.empleado}</div><div class="small text-muted">Mat: ${inc.matricula}</div>`,
                inc.departamento,
                `<span class="badge bg-secondary rounded-pill px-3">${inc.tipo}</span>`,
                `<span class="small text-muted">${inc.fecha_registro}</span>`,
                `<div class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-outline-secondary btn-accion btn-ver" title="Ver Detalles" data-id="${inc.id}"><i class="bi bi-eye"></i></button>
                    <button type="button" class="btn btn-outline-success btn-accion btn-entregar" title="Marcar como Entregado" data-id="${inc.id}" data-empleado="${inc.empleado}"><i class="bi bi-check-circle"></i></button>
                </div>`
            ]).draw(false).node();

            $(node).attr('id', `row-p-${inc.id}`)
                   .attr('data-id', inc.id)
                   .attr('data-departamento-id', inc.departamento_id || '')
                   .attr('data-estatus', 'Pendiente')
                   .addClass('row-new');

            actualizarBadgePendientes(dtP.rows().count());
            showToast('Incidencia registrada correctamente ✓');

            if (keepOpen) {
                form.reset();
                $('#oc_empleado_id').val(null).trigger('change');
                document.getElementById('oc_fecha').value = new Date().toISOString().split('T')[0];
            } else {
                bootstrap.Offcanvas.getInstance(document.getElementById('offcanvasCaptura')).hide();
                form.reset();
                $('#oc_empleado_id').val(null).trigger('change');
            }
        } catch (err) {
            alert.textContent = err.message;
            alert.classList.remove('d-none');
        } finally {
            btn.disabled = false;
            btn.innerHTML = '<i class="bi bi-save me-1"></i> Registrar Incidencia';
        }
    }

    document.getElementById('btnGuardar').addEventListener('click',     () => submitCaptura(false));
    document.getElementById('btnGuardarOtro').addEventListener('click', () => submitCaptura(true));

    // ─── FILTROS – Pendientes ─────────────────────────────────────────────────
    async function filtrarPendientes() {
        const params = new URLSearchParams({
            estatus:         'Pendiente',
            nombre:          document.getElementById('pNombre').value.trim(),
            departamento_id: document.getElementById('pDepartamento').value,
            mes:             document.getElementById('pMes').value,
            anio:            document.getElementById('pAnio').value,
            quincena:        document.getElementById('pQuincena').value,
            fecha_desde:     document.getElementById('pFechaDesde').value,
            fecha_hasta:     document.getElementById('pFechaHasta').value,
        });

        try {
            const res  = await fetch(`${ROUTE_FILTRAR}?${params}`, { headers: { 'Accept': 'application/json' } });
            const json = await res.json();
            if (!json.success) throw new Error('Error al filtrar');

            dtP.clear();
            json.incidencias.forEach(inc => {
                const node = dtP.row.add([
                    `<span class="fw-bold">${inc.fecha}</span>`,
                    `<div class="fw-bold">${inc.empleado}</div><div class="small text-muted">Mat: ${inc.matricula}</div>`,
                    inc.departamento,
                    `<span class="badge bg-secondary rounded-pill px-3">${inc.tipo}</span>`,
                    `<span class="small text-muted">${inc.fecha_registro}</span>`,
                    `<div class="btn-group btn-group-sm">
                        <button type="button" class="btn btn-outline-secondary btn-accion btn-ver" title="Ver Detalles" data-id="${inc.id}"><i class="bi bi-eye"></i></button>
                        <button type="button" class="btn btn-outline-success btn-accion btn-entregar" title="Marcar como Entregado" data-id="${inc.id}" data-empleado="${inc.empleado}"><i class="bi bi-check-circle"></i></button>
                    </div>`
                ]).node();
                $(node).attr('id', `row-p-${inc.id}`)
                       .attr('data-id', inc.id)
                       .attr('data-departamento-id', inc.departamento_id || '')
                       .attr('data-estatus', 'Pendiente');
            });
            dtP.draw();
            actualizarBadgePendientes(json.total);
        } catch (err) {
            showToast('Error al aplicar filtros', 'danger');
        }
    }

    document.getElementById('btnFiltrarPendientes').addEventListener('click', filtrarPendientes);
    document.getElementById('btnLimpiarPendientes').addEventListener('click', () => {
        ['pNombre','pDepartamento','pMes','pAnio','pQuincena','pFechaDesde','pFechaHasta']
            .forEach(id => document.getElementById(id).value = '');
        document.getElementById('pAnio').value = new Date().getFullYear();
        filtrarPendientes();
    });

    // Enter en campos de filtro pendientes
    ['pNombre','pFechaDesde','pFechaHasta'].forEach(id => {
        document.getElementById(id).addEventListener('keydown', e => {
            if (e.key === 'Enter') filtrarPendientes();
        });
    });

    // ─── FILTROS – Historial ──────────────────────────────────────────────────
    async function filtrarHistorial() {
        const params = new URLSearchParams({
            estatus:         'Entregado',
            nombre:          document.getElementById('hNombre').value.trim(),
            departamento_id: document.getElementById('hDepartamento').value,
            recibido_por:    document.getElementById('hRecibidoPor').value.trim(),
            mes:             document.getElementById('hMes').value,
            anio:            document.getElementById('hAnio').value,
            quincena:        document.getElementById('hQuincena').value,
            fecha_desde:     document.getElementById('hFechaDesde').value,
            fecha_hasta:     document.getElementById('hFechaHasta').value,
        });

        try {
            const res  = await fetch(`${ROUTE_FILTRAR}?${params}`, { headers: { 'Accept': 'application/json' } });
            const json = await res.json();
            if (!json.success) throw new Error('Error al filtrar');

            dtH.clear();
            json.incidencias.forEach(inc => {
                dtH.row.add([
                    `<span class="fw-bold">${inc.fecha}</span>`,
                    `<div class="fw-bold">${inc.empleado}</div><div class="small text-muted">Mat: ${inc.matricula}</div>`,
                    inc.departamento,
                    `<span class="badge bg-secondary rounded-pill px-3">${inc.tipo}</span>`,
                    `<span class="small text-muted">${inc.fecha_registro}</span>`,
                    chipFecha(inc.fecha_entrega),
                    `<span class="fw-semibold text-success small">${inc.recibido_por ?? '—'}</span>`,
                    `<button type="button" class="btn btn-outline-secondary btn-accion btn-ver" title="Ver Detalles" data-id="${inc.id}"><i class="bi bi-eye"></i></button>`
                ]);
            });
            dtH.draw();
            document.getElementById('badgeHistorial').textContent = json.total;
        } catch (err) {
            showToast('Error al aplicar filtros', 'danger');
        }
    }

    document.getElementById('btnFiltrarHistorial').addEventListener('click', filtrarHistorial);
    document.getElementById('btnLimpiarHistorial').addEventListener('click', () => {
        ['hNombre','hDepartamento','hRecibidoPor','hMes','hAnio','hQuincena','hFechaDesde','hFechaHasta']
            .forEach(id => document.getElementById(id).value = '');
        document.getElementById('hAnio').value = new Date().getFullYear();
        filtrarHistorial();
    });

    ['hNombre','hRecibidoPor','hFechaDesde','hFechaHasta'].forEach(id => {
        document.getElementById(id).addEventListener('keydown', e => {
            if (e.key === 'Enter') filtrarHistorial();
        });
    });

    // ─── DELEGACIÓN: botón Ver ────────────────────────────────────────────────
    document.addEventListener('click', async e => {
        const btnVer = e.target.closest('.btn-ver');
        if (!btnVer) return;

        const id    = btnVer.dataset.id;
        const modal = new bootstrap.Modal(document.getElementById('modalDetalle'));
        document.getElementById('detalleBody').innerHTML = `
            <div class="text-center py-4">
                <div class="spinner-border text-success" role="status"></div>
            </div>`;
        modal.show();

        try {
            const res  = await fetch(`/incidencias/${id}`, { headers: { 'Accept': 'application/json' } });
            const json = await res.json();
            const inc  = json.incidencia;

            const estatusBadge = inc.estatus === 'Pendiente'
                ? `<span class="badge badge-pendiente rounded-pill px-3">${inc.estatus}</span>`
                : `<span class="badge badge-entregado rounded-pill px-3">${inc.estatus}</span>`;

            document.getElementById('detalleBody').innerHTML = `
                <div>
                    <div class="detail-row"><span class="detail-label"><i class="bi bi-person-badge me-1"></i>Empleado</span><span class="detail-value fw-bold">${inc.empleado}</span></div>
                    <div class="detail-row"><span class="detail-label"><i class="bi bi-tag me-1"></i>Matrícula</span><span class="detail-value">${inc.matricula}</span></div>
                    <div class="detail-row"><span class="detail-label"><i class="bi bi-building me-1"></i>Departamento</span><span class="detail-value">${inc.departamento}</span></div>
                    <div class="detail-row"><span class="detail-label"><i class="bi bi-briefcase me-1"></i>Puesto</span><span class="detail-value">${inc.puesto}</span></div>
                    <div class="detail-row"><span class="detail-label"><i class="bi bi-calendar-event me-1"></i>Fecha incidencia</span><span class="detail-value">${inc.fecha}</span></div>
                    <div class="detail-row"><span class="detail-label"><i class="bi bi-exclamation-circle me-1"></i>Tipo</span><span class="detail-value">${inc.tipo}</span></div>
                    <div class="detail-row"><span class="detail-label"><i class="bi bi-chat-left-text me-1"></i>Motivo</span><span class="detail-value">${inc.motivo}</span></div>
                    <div class="detail-row"><span class="detail-label"><i class="bi bi-journal-text me-1"></i>Observaciones</span><span class="detail-value">${inc.observaciones}</span></div>
                    <div class="detail-row"><span class="detail-label"><i class="bi bi-circle-fill me-1"></i>Estatus</span><span class="detail-value">${estatusBadge}</span></div>
                    <div class="detail-row"><span class="detail-label"><i class="bi bi-person-plus me-1"></i>Capturó</span><span class="detail-value">${inc.capturado_por}</span></div>
                    <div class="detail-row"><span class="detail-label"><i class="bi bi-clock me-1"></i>Fecha registro</span><span class="detail-value text-muted">${inc.fecha_registro}</span></div>
                    ${inc.recibido_por ? `
                    <div class="detail-row"><span class="detail-label"><i class="bi bi-person-check me-1"></i>Recibió</span><span class="detail-value fw-bold text-success">${inc.recibido_por}</span></div>` : ''}
                    ${inc.fecha_entrega ? `
                    <div class="detail-row border-0"><span class="detail-label"><i class="bi bi-calendar-check me-1"></i>Fecha entrega</span><span class="detail-value">${chipFecha(inc.fecha_entrega)}</span></div>` : ''}
                </div>`;
        } catch {
            document.getElementById('detalleBody').innerHTML = `<div class="alert alert-danger">Error al cargar los detalles.</div>`;
        }
    });

    // ─── DELEGACIÓN: botón Entregar (individual) ──────────────────────────────
    document.addEventListener('click', e => {
        const btn = e.target.closest('.btn-entregar');
        if (!btn) return;

        document.getElementById('entregaIncidenciaId').value = btn.dataset.id;
        document.getElementById('entregaEmpleado').textContent = btn.dataset.empleado;
        document.getElementById('entregaRecibidoPor').value = '';
        document.getElementById('entregaAlert').classList.add('d-none');
        new bootstrap.Modal(document.getElementById('modalEntregar')).show();
    });

    document.getElementById('btnConfirmarEntrega').addEventListener('click', async () => {
        const id          = document.getElementById('entregaIncidenciaId').value;
        const recibidoPor = document.getElementById('entregaRecibidoPor').value.trim();
        const alertEl     = document.getElementById('entregaAlert');
        alertEl.classList.add('d-none');

        if (!recibidoPor) {
            alertEl.textContent = 'Debes indicar quién recibe la incidencia.';
            alertEl.classList.remove('d-none');
            return;
        }

        const btn = document.getElementById('btnConfirmarEntrega');
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Guardando…';

        try {
            const res  = await fetch(`/incidencias/${id}/entregar`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF },
                body: JSON.stringify({ recibido_por: recibidoPor })
            });
            const json = await res.json();
            if (!res.ok || !json.success) throw new Error(json.message ?? 'Error al guardar.');

            const inc = json.incidencia;

            // Quitar de tabla Pendientes
            const rowP = document.getElementById(`row-p-${id}`);
            if (rowP) {
                dtP.row(rowP).remove().draw(false);
                actualizarBadgePendientes(dtP.rows().count());
            }

            // Agregar a tabla Historial
            dtH.row.add([
                `<span class="fw-bold">${inc.fecha}</span>`,
                `<div class="fw-bold">${inc.empleado}</div><div class="small text-muted">Mat: ${inc.matricula}</div>`,
                inc.departamento,
                `<span class="badge bg-secondary rounded-pill px-3">${inc.tipo}</span>`,
                `<span class="small text-muted">${inc.fecha_registro}</span>`,
                chipFecha(inc.fecha_entrega),
                `<span class="fw-semibold text-success small">${recibidoPor}</span>`,
                `<button type="button" class="btn btn-outline-secondary btn-accion btn-ver" title="Ver Detalles" data-id="${inc.id}"><i class="bi bi-eye"></i></button>`
            ]).draw(false);

            bootstrap.Modal.getInstance(document.getElementById('modalEntregar')).hide();
            showToast(`Entregado a ${recibidoPor} ✓`);
        } catch (err) {
            alertEl.textContent = err.message;
            alertEl.classList.remove('d-none');
        } finally {
            btn.disabled = false;
            btn.innerHTML = '<i class="bi bi-check-lg me-1"></i> Confirmar Entrega';
        }
    });

    // ─── MODAL DEPARTAMENTO ───────────────────────────────────────────────────
    let pendientesDatos = [];

    document.getElementById('btnBuscarPendientes').addEventListener('click', () => {
        const deptoId     = document.getElementById('filtroDepartamento').value;
        const deptoNombre = document.getElementById('filtroDepartamento').selectedOptions[0]?.text ?? '';
        if (!deptoId) { showToast('Selecciona un departamento.', 'danger'); return; }

        // Buscar en DataTable de Pendientes
        pendientesDatos = [];
        dtP.rows().nodes().each(function () {
            const tr = this;
            if ($(tr).attr('data-departamento-id') == deptoId) {
                const id       = $(tr).attr('data-id');
                const cells    = $(tr).find('td');
                const fecha    = cells.eq(0).text().trim();
                const empleado = cells.eq(1).find('.fw-bold').text().trim();
                const tipo     = cells.eq(3).text().trim();
                const registro = cells.eq(4).text().trim();
                pendientesDatos.push({ id, fecha, empleado, tipo, registro });
            }
        });

        const tbody  = document.getElementById('pendientesList');
        const sinP   = document.getElementById('sinPendientes');
        const campoR = document.getElementById('campoReceptorDepto');
        const btnConf = document.getElementById('btnConfirmarDeptoEntrega');

        document.getElementById('deptoNombre').textContent = deptoNombre;
        document.getElementById('deptoStep2').classList.remove('d-none');

        if (pendientesDatos.length === 0) {
            tbody.innerHTML = '';
            sinP.classList.remove('d-none');
            campoR.classList.add('d-none');
            btnConf.classList.add('d-none');
        } else {
            sinP.classList.add('d-none');
            campoR.classList.remove('d-none');
            btnConf.classList.remove('d-none');
            tbody.innerHTML = pendientesDatos.map(p => `
                <tr>
                    <td><input type="checkbox" class="form-check-input chk-pendiente" value="${p.id}" checked></td>
                    <td class="fw-semibold">${p.empleado}</td>
                    <td>${p.fecha}</td>
                    <td>${p.tipo}</td>
                    <td class="small text-muted">${p.registro}</td>
                </tr>`).join('');
        }
    });

    document.getElementById('chkAll').addEventListener('change', function () {
        document.querySelectorAll('.chk-pendiente').forEach(c => c.checked = this.checked);
    });
    document.getElementById('btnSelectAll').addEventListener('click', () => {
        document.querySelectorAll('.chk-pendiente').forEach(c => c.checked = true);
        document.getElementById('chkAll').checked = true;
    });

    document.getElementById('btnConfirmarDeptoEntrega').addEventListener('click', async () => {
        const recibidoPor = document.getElementById('deptoRecibidoPor').value.trim();
        const deptoId     = document.getElementById('filtroDepartamento').value;
        const alertEl     = document.getElementById('deptoAlert');
        alertEl.classList.add('d-none');

        const seleccionadas = [...document.querySelectorAll('.chk-pendiente:checked')].map(c => c.value);

        if (!recibidoPor) {
            alertEl.textContent = 'Indica quién recibe las incidencias.';
            alertEl.classList.remove('d-none');
            return;
        }
        if (seleccionadas.length === 0) {
            alertEl.textContent = 'Selecciona al menos una incidencia.';
            alertEl.classList.remove('d-none');
            return;
        }

        const btn = document.getElementById('btnConfirmarDeptoEntrega');
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Procesando…';

        try {
            const res  = await fetch(ROUTE_DEP_ENT, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF },
                body: JSON.stringify({ departamento_id: deptoId, recibido_por: recibidoPor, ids: seleccionadas })
            });
            const json = await res.json();
            if (!res.ok || !json.success) throw new Error(json.message ?? 'Error.');

            // Mover filas de Pendientes → Historial
            json.ids.forEach(id => {
                const rowP = document.getElementById(`row-p-${id}`);
                if (!rowP) return;
                const cells   = $(rowP).find('td');
                const fecha   = cells.eq(0).text().trim();
                const emp     = cells.eq(1).find('.fw-bold').text().trim();
                const mat     = cells.eq(1).find('.text-muted').text().replace('Mat:', '').trim();
                const depto   = cells.eq(2).text().trim();
                const tipo    = cells.eq(3).text().trim();
                const reg     = cells.eq(4).text().trim();

                dtP.row(rowP).remove();

                dtH.row.add([
                    `<span class="fw-bold">${fecha}</span>`,
                    `<div class="fw-bold">${emp}</div><div class="small text-muted">Mat: ${mat}</div>`,
                    depto,
                    `<span class="badge bg-secondary rounded-pill px-3">${tipo}</span>`,
                    `<span class="small text-muted">${reg}</span>`,
                    chipFecha(new Date().toLocaleDateString('es-MX', { day:'2-digit', month:'2-digit', year:'numeric', hour:'2-digit', minute:'2-digit' })),
                    `<span class="fw-semibold text-success small">${recibidoPor}</span>`,
                    `<button type="button" class="btn btn-outline-secondary btn-accion btn-ver" title="Ver Detalles" data-id="${id}"><i class="bi bi-eye"></i></button>`
                ]);
            });
            dtP.draw(false);
            dtH.draw(false);
            actualizarBadgePendientes(dtP.rows().count());

            bootstrap.Modal.getInstance(document.getElementById('modalDepartamento')).hide();
            showToast(`${seleccionadas.length} incidencias entregadas a ${recibidoPor} ✓`);
        } catch (err) {
            alertEl.textContent = err.message;
            alertEl.classList.remove('d-none');
        } finally {
            btn.disabled = false;
            btn.innerHTML = '<i class="bi bi-check-all me-1"></i> Entregar Seleccionadas';
        }
    });

    // Limpiar modal departamento al cerrar
    document.getElementById('modalDepartamento').addEventListener('hidden.bs.modal', () => {
        document.getElementById('deptoStep2').classList.add('d-none');
        document.getElementById('filtroDepartamento').value = '';
        document.getElementById('deptoRecibidoPor').value = '';
        document.getElementById('deptoAlert').classList.add('d-none');
        document.getElementById('btnConfirmarDeptoEntrega').classList.add('d-none');
        document.getElementById('pendientesList').innerHTML = '';
        document.getElementById('chkAll').checked = true;
    });
    </script>

</x-app-layout>
