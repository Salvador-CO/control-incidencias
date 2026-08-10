<x-app-layout>
    @push('styles')
    <style>
        /* ── Oficios: variables extra ── */
        :root {
            --of-green: #006039;
            --of-green-lt: #e8f5ee;
            --of-yellow: #856404;
            --of-yellow-lt: #fff9e6;
            --of-red: #842029;
            --of-red-lt: #fdf3f3;
        }

        /* ── Stats cards ── */
        .stat-card {
            border-radius: 16px;
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            border: none;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,0.08); }
        .stat-icon {
            width: 48px; height: 48px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem;
            flex-shrink: 0;
        }
        .stat-val { font-size: 1.6rem; font-weight: 800; line-height: 1; }
        .stat-lbl { font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.8px; opacity: 0.7; }

        /* ── Table ── */
        .oficios-table th {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            color: #6c757d;
            border-bottom: 2px solid #e9ecef;
            padding: 0.75rem 1rem;
            white-space: nowrap;
        }
        .oficios-table td {
            padding: 0.85rem 1rem;
            vertical-align: middle;
            font-size: 0.875rem;
            border-color: #f0f0f0;
        }
        .oficios-table tbody tr { transition: background .15s; }
        .oficios-table tbody tr:hover { background: #f8fffe; }

        .folio-badge {
            font-weight: 700;
            font-size: 0.9rem;
            color: var(--of-green);
            font-family: 'Courier New', monospace;
            background: var(--of-green-lt);
            padding: 0.25rem 0.6rem;
            border-radius: 6px;
            display: inline-block;
        }

        .status-badge {
            padding: 0.35rem 0.85rem;
            border-radius: 50px;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }
        .status-pendiente { background: #fff9e6; color: #856404; border: 1px solid #ffc10740; }
        .status-entregado { background: var(--of-green-lt); color: #155724; border: 1px solid #00603930; }
        .status-cancelado { background: var(--of-red-lt); color: var(--of-red); border: 1px solid #84202930; }

        /* ── Filters bar ── */
        .filters-bar {
            background: #fff;
            border-radius: 12px;
            padding: 1rem 1.25rem;
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
            border: 1px solid #e9ecef;
        }
        .filters-bar .form-select,
        .filters-bar .form-control {
            border-radius: 8px;
            font-size: 0.85rem;
            border-color: #dee2e6;
        }
        .filters-bar .form-select:focus,
        .filters-bar .form-control:focus {
            border-color: var(--of-green);
            box-shadow: 0 0 0 3px rgba(0,96,57,0.12);
        }

        /* ── Modal ── */
        .modal-header-green {
            background: linear-gradient(135deg, var(--of-green), #004a2c);
            color: white;
            border-radius: 16px 16px 0 0;
        }
        .modal-content { border-radius: 16px; border: none; box-shadow: 0 25px 60px rgba(0,0,0,0.15); }
        .modal-body .form-label { font-size: 0.82rem; font-weight: 600; color: #495057; text-transform: uppercase; letter-spacing: 0.5px; }
        .modal-body .form-control, .modal-body .form-select {
            border-radius: 10px;
            border-color: #dee2e6;
            font-size: 0.9rem;
        }
        .modal-body .form-control:focus, .modal-body .form-select:focus {
            border-color: var(--of-green);
            box-shadow: 0 0 0 3px rgba(0,96,57,0.12);
        }
        .btn-green {
            background: var(--of-green);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.2s;
        }
        .btn-green:hover { background: #004a2c; color: white; transform: translateY(-1px); box-shadow: 0 4px 14px rgba(0,96,57,0.3); }

        /* ── Detail labels ── */
        .detail-lbl { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px; color: #adb5bd; font-weight: 700; }
        .detail-val { font-size: 0.9rem; color: #212529; font-weight: 500; word-break: break-word; }

        /* ── Empty state ── */
        .empty-state { text-align: center; padding: 4rem 2rem; color: #adb5bd; }
        .empty-state i { font-size: 3rem; display: block; margin-bottom: 1rem; }
        .empty-state h5 { color: #6c757d; font-weight: 600; }
    </style>
    @endpush

    @php
        $deptoClave = optional($departamento)->clave ?? '???';
        $deptoNombre = optional($departamento)->nombre ?? 'Todos los departamentos';
        $anioActual = now()->year;
    @endphp

    {{-- ── Header ── --}}
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold mb-0">
                <i class="bi bi-envelope-paper me-2" style="color:var(--cb-green);"></i>
                Control de Oficios
            </h1>
            <p class="text-muted small mb-0 mt-1">
                <span class="fw-semibold" style="color:var(--cb-green);">{{ $deptoNombre }}</span>
                &mdash; Año {{ $anioFiltro }}
            </p>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <a href="{{ route('oficios.portal') }}" class="btn btn-outline-secondary btn-sm rounded-3" target="_blank">
                <i class="bi bi-box-arrow-up-right me-1"></i>Portal público
            </a>
            @can('crear-oficios')
            <button class="btn btn-sm rounded-3 btn-green px-3" data-bs-toggle="modal" data-bs-target="#modalNuevoOficio">
                <i class="bi bi-plus-lg me-1"></i>Nuevo Oficio
            </button>
            @endcan
        </div>
    </div>

    {{-- ── Stats ── --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="stat-card bg-white shadow-sm">
                <div class="stat-icon" style="background:#e8f5ee;color:var(--of-green);"><i class="bi bi-envelope-paper"></i></div>
                <div>
                    <div class="stat-val" style="color:var(--of-green);">{{ $stats['total'] }}</div>
                    <div class="stat-lbl">Total</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card bg-white shadow-sm">
                <div class="stat-icon" style="background:#fff9e6;color:#856404;"><i class="bi bi-clock"></i></div>
                <div>
                    <div class="stat-val" style="color:#856404;">{{ $stats['pendiente'] }}</div>
                    <div class="stat-lbl">Pendientes</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card bg-white shadow-sm">
                <div class="stat-icon" style="background:#e8f5ee;color:#155724;"><i class="bi bi-check-circle"></i></div>
                <div>
                    <div class="stat-val" style="color:#155724;">{{ $stats['entregado'] }}</div>
                    <div class="stat-lbl">Entregados</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card bg-white shadow-sm">
                <div class="stat-icon" style="background:#fdf3f3;color:var(--of-red);"><i class="bi bi-x-circle"></i></div>
                <div>
                    <div class="stat-val" style="color:var(--of-red);">{{ $stats['cancelado'] }}</div>
                    <div class="stat-lbl">Cancelados</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Filtros ── --}}
    <div class="filters-bar mb-4">
        <form method="GET" action="{{ route('oficios.index') }}" class="row g-2 align-items-end">
            <div class="col-6 col-md-2">
                <label class="form-label small fw-semibold mb-1">Año</label>
                <select name="anio" class="form-select form-select-sm" onchange="this.form.submit()">
                    @foreach($aniosDisponibles as $a)
                    <option value="{{ $a }}" {{ $anioFiltro == $a ? 'selected' : '' }}>{{ $a }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6 col-md-2">
                <label class="form-label small fw-semibold mb-1">Estatus</label>
                <select name="estatus" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">Todos</option>
                    <option value="Pendiente" {{ $estatusFiltro === 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="Entregado" {{ $estatusFiltro === 'Entregado' ? 'selected' : '' }}>Entregado</option>
                    <option value="Cancelado" {{ $estatusFiltro === 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                </select>
            </div>
            <div class="col-12 col-md-5">
                <label class="form-label small fw-semibold mb-1">Buscar</label>
                <input type="text" name="q" class="form-control form-control-sm" placeholder="Número, asunto, dirigido a..." value="{{ $busqueda }}">
            </div>
            <div class="col-6 col-md-2">
                <button type="submit" class="btn btn-sm btn-green w-100"><i class="bi bi-funnel me-1"></i>Filtrar</button>
            </div>
            @if($busqueda || $estatusFiltro)
            <div class="col-6 col-md-1">
                <a href="{{ route('oficios.index', ['anio' => $anioFiltro]) }}" class="btn btn-sm btn-outline-secondary w-100" title="Limpiar filtros">
                    <i class="bi bi-x-lg"></i>
                </a>
            </div>
            @endif
        </form>
    </div>

    {{-- ── Tabla de Oficios ── --}}
    <div class="card border-0 shadow-sm" style="border-radius:16px;overflow:hidden;">
        <div class="card-body p-0">
            @if($oficios->isEmpty())
            <div class="empty-state">
                <i class="bi bi-envelope-open"></i>
                <h5>No hay oficios registrados</h5>
                <p class="small">{{ $busqueda || $estatusFiltro ? 'No se encontraron resultados con los filtros aplicados.' : 'Registra el primer oficio del año ' . $anioFiltro . '.' }}</p>
                @can('crear-oficios')
                <button class="btn btn-green btn-sm px-4 mt-2" data-bs-toggle="modal" data-bs-target="#modalNuevoOficio">
                    <i class="bi bi-plus-lg me-1"></i>Registrar primer oficio
                </button>
                @endcan
            </div>
            @else
            <div class="table-responsive">
                <table class="table oficios-table mb-0">
                    <thead>
                        <tr>
                            <th>Folio</th>
                            <th>Fecha</th>
                            <th>Jefe / Referencia</th>
                            <th>Asunto</th>
                            <th>Dirigido a</th>
                            <th>Registrado por</th>
                            <th>Estatus</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($oficios as $oficio)
                        <tr>
                            <td>
                                <span class="folio-badge">{{ $oficio->numero_oficio }}</span>
                            </td>
                            <td class="text-nowrap">{{ $oficio->fecha_registro?->format('d/m/Y') }}</td>
                            <td>{{ $oficio->jefe_referencia }}</td>
                            <td style="max-width:200px;" class="text-truncate" title="{{ $oficio->asunto }}">
                                {{ $oficio->asunto }}
                            </td>
                            <td style="max-width:160px;" class="text-truncate" title="{{ $oficio->dirigido_a }}">
                                {{ $oficio->dirigido_a }}
                            </td>
                            <td>{{ $oficio->registrado_por_nombre }}</td>
                            <td>
                                <span class="status-badge status-{{ strtolower($oficio->estatus) }}">
                                    @if($oficio->estatus === 'Entregado') <i class="bi bi-check-circle-fill"></i>
                                    @elseif($oficio->estatus === 'Cancelado') <i class="bi bi-x-circle-fill"></i>
                                    @else <i class="bi bi-clock-fill"></i>
                                    @endif
                                    {{ $oficio->estatus }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    {{-- Ver detalle --}}
                                    <button class="btn btn-sm btn-outline-secondary rounded-2 py-1 px-2"
                                        title="Ver detalle"
                                        onclick="verDetalle({{ $oficio->id }})">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    {{-- Subir acuse --}}
                                    @if($oficio->estatus !== 'Cancelado')
                                    <button class="btn btn-sm btn-outline-success rounded-2 py-1 px-2"
                                        title="Registrar acuse"
                                        onclick="abrirAcuse({{ $oficio->id }}, '{{ $oficio->numero_oficio }}', {{ $oficio->acuse_url ? 'true' : 'false' }})">
                                        <i class="bi bi-paperclip"></i>
                                    </button>
                                    @endif
                                    {{-- Cancelar --}}
                                    @can('cancelar-oficios')
                                    @if($oficio->estatus === 'Pendiente')
                                    <button class="btn btn-sm btn-outline-danger rounded-2 py-1 px-2"
                                        title="Cancelar oficio"
                                        onclick="cancelarOficio({{ $oficio->id }}, '{{ $oficio->numero_oficio }}')">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                    @endif
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>

    {{-- ═══════════════ MODALES ═══════════════ --}}

    {{-- Modal: Nuevo Oficio --}}
    <div class="modal fade" id="modalNuevoOficio" tabindex="-1" aria-labelledby="labelNuevoOficio" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-header-green border-0 py-3">
                    <h5 class="modal-title fw-bold" id="labelNuevoOficio">
                        <i class="bi bi-plus-circle me-2"></i>Registrar Nuevo Oficio
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div id="alertNuevoOficio"></div>
                    <form id="formNuevoOficio" novalidate>
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Fecha de registro <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="fecha_registro" id="fFechaRegistro"
                                    value="{{ now()->toDateString() }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Registrado por <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="registrado_por_nombre" id="fRegistradoPor"
                                    value="{{ Auth::user()->empleado?->nombre ? (Auth::user()->empleado->nombre . ' ' . Auth::user()->empleado->apellido_paterno) : Auth::user()->name }}"
                                    placeholder="Nombre de quien registra" required>
                                <div class="form-text">Puedes editar si alguien más está registrando.</div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Jefe o Subdirector que necesita la referencia <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="jefe_referencia" id="fJefeRef"
                                    placeholder="Nombre completo y cargo" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Asunto <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="asunto" id="fAsunto" rows="2"
                                    placeholder="Asunto tal como aparece en el oficio" required></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Dirigido a <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="dirigido_a" id="fDirigidoA"
                                    placeholder="Nombre completo, institución (si es externo)" required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-green px-4" id="btnGuardarOficio">
                        <span id="spinnerGuardar" class="spinner-border spinner-border-sm me-2 d-none"></span>
                        <i class="bi bi-floppy me-1"></i>Guardar Oficio
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal: Detalle --}}
    <div class="modal fade" id="modalDetalle" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-header-green border-0 py-3">
                    <h5 class="modal-title fw-bold"><i class="bi bi-info-circle me-2"></i>Detalle del Oficio</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4" id="detalleBody">
                    <div class="text-center py-4"><div class="spinner-border text-success"></div></div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal: Acuse --}}
    <div class="modal fade" id="modalAcuse" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-header-green border-0 py-3">
                    <h5 class="modal-title fw-bold"><i class="bi bi-paperclip me-2"></i>Registrar Acuse</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div id="alertAcuse"></div>
                    <p class="text-muted small mb-3">
                        <i class="bi bi-info-circle me-1"></i>
                        Sube el acuse a tu carpeta de OneDrive, copia el enlace compartido y pégalo aquí.
                        El oficio quedará marcado como <strong>Entregado</strong>.
                    </p>
                    <div id="acuseFolioInfo" class="mb-3 p-3 rounded-3" style="background:#e8f5ee;">
                        <span class="small text-muted">Oficio:</span>
                        <div class="fw-bold" style="color:var(--of-green);" id="acuseFolioNum">—</div>
                    </div>
                    <form id="formAcuse" novalidate>
                        <div class="mb-3">
                            <label class="form-label">Enlace del acuse (URL OneDrive) <span class="text-danger">*</span></label>
                            <input type="url" class="form-control" name="acuse_url" id="fAcuseUrl"
                                placeholder="https://1drv.ms/..." required>
                            <div class="form-text">Pega el enlace de compartir del archivo en OneDrive.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nombre del archivo</label>
                            <input type="text" class="form-control" name="acuse_nombre" id="fAcuseNombre"
                                placeholder="Acuse_oficio_DASE_283.pdf">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fecha del acuse</label>
                            <input type="date" class="form-control" name="fecha_acuse" id="fAcuseFecha"
                                value="{{ now()->toDateString() }}">
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-green px-4" id="btnGuardarAcuse">
                        <span class="spinner-border spinner-border-sm me-2 d-none" id="spinnerAcuse"></span>
                        <i class="bi bi-cloud-upload me-1"></i>Guardar Acuse
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal: Cancelar --}}
    <div class="modal fade" id="modalCancelar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 py-3" style="background:#842029;border-radius:16px 16px 0 0;">
                    <h5 class="modal-title fw-bold text-white"><i class="bi bi-x-circle me-2"></i>Cancelar Oficio</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div id="alertCancelar"></div>
                    <p class="text-muted small">¿Seguro que deseas cancelar el oficio <strong id="cancelFolioNum" class="text-danger">—</strong>? Esta acción no se puede deshacer.</p>
                    <div class="mb-3">
                        <label class="form-label">Motivo de cancelación (opcional)</label>
                        <textarea class="form-control" id="fMotivoCancelacion" rows="2" placeholder="Razón de la cancelación..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">No, regresar</button>
                    <button type="button" class="btn btn-danger px-4" id="btnConfirmarCancelar">
                        <span class="spinner-border spinner-border-sm me-2 d-none" id="spinnerCancelar"></span>
                        <i class="bi bi-x-circle me-1"></i>Sí, cancelar oficio
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    const CSRF = document.querySelector('meta[name="csrf-token"]').content;
    let currentOficioId = null;

    /* ── Helpers de UI ── */
    function showAlert(containerId, msg, type = 'danger') {
        document.getElementById(containerId).innerHTML =
            `<div class="alert alert-${type} alert-dismissible fade show small py-2" role="alert">
                <i class="bi bi-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} me-2"></i>${msg}
                <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert"></button>
            </div>`;
    }
    function clearAlert(id) { document.getElementById(id).innerHTML = ''; }
    function spin(id, state) { document.getElementById(id).classList.toggle('d-none', !state); }

    /* ── Nuevo oficio ── */
    document.getElementById('btnGuardarOficio').addEventListener('click', async function () {
        clearAlert('alertNuevoOficio');
        const form = document.getElementById('formNuevoOficio');
        const data = new FormData(form);
        spin('spinnerGuardar', true);
        this.disabled = true;

        try {
            const res = await fetch('{{ route("oficios.store") }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
                body: data,
            });
            const json = await res.json();
            if (!res.ok || !json.success) throw new Error(json.message || 'Error al guardar.');
            showAlert('alertNuevoOficio', `✓ ${json.message} — Folio: <strong>${json.oficio.numero_oficio}</strong>`, 'success');
            form.reset();
            document.getElementById('fFechaRegistro').value = '{{ now()->toDateString() }}';
            setTimeout(() => location.reload(), 1800);
        } catch(e) {
            showAlert('alertNuevoOficio', e.message);
        } finally {
            spin('spinnerGuardar', false);
            this.disabled = false;
        }
    });

    /* ── Ver detalle ── */
    async function verDetalle(id) {
        const modal = new bootstrap.Modal(document.getElementById('modalDetalle'));
        document.getElementById('detalleBody').innerHTML = '<div class="text-center py-4"><div class="spinner-border text-success"></div></div>';
        modal.show();

        try {
            const res = await fetch(`/mis-oficios/${id}`, { headers: { 'Accept': 'application/json' } });
            const json = await res.json();
            if (!json.success) throw new Error('No se pudo cargar el detalle.');
            const o = json.oficio;
            const badgeColor = { Entregado: 'success', Cancelado: 'danger', Pendiente: 'warning' };
            const badgeIcon  = { Entregado: 'check-circle-fill', Cancelado: 'x-circle-fill', Pendiente: 'clock-fill' };
            document.getElementById('detalleBody').innerHTML = `
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                    <h5 class="mb-0 fw-bold" style="font-family:monospace;color:var(--of-green);">${o.numero_oficio}</h5>
                    <span class="badge bg-${badgeColor[o.estatus]} rounded-pill fs-6 px-3">
                        <i class="bi bi-${badgeIcon[o.estatus]} me-1"></i>${o.estatus}
                    </span>
                </div>
                <div class="row g-3">
                    <div class="col-md-4"><div class="detail-lbl">Departamento</div><div class="detail-val">${o.departamento || '—'}</div></div>
                    <div class="col-md-4"><div class="detail-lbl">Fecha de registro</div><div class="detail-val">${o.fecha_registro || '—'}</div></div>
                    <div class="col-md-4"><div class="detail-lbl">Registrado en sistema</div><div class="detail-val">${o.created_at}</div></div>
                    <div class="col-md-6"><div class="detail-lbl">Jefe / Referencia</div><div class="detail-val">${o.jefe_referencia}</div></div>
                    <div class="col-md-6"><div class="detail-lbl">Registrado por</div><div class="detail-val">${o.registrado_por_nombre}</div></div>
                    <div class="col-12"><div class="detail-lbl">Asunto</div><div class="detail-val">${o.asunto}</div></div>
                    <div class="col-12"><div class="detail-lbl">Dirigido a</div><div class="detail-val">${o.dirigido_a}</div></div>
                    ${o.acuse_url ? `<div class="col-12"><div class="detail-lbl">Acuse</div><div class="detail-val"><a href="${o.acuse_url}" target="_blank" class="text-success fw-semibold"><i class="bi bi-file-earmark-check-fill me-1"></i>${o.acuse_nombre || 'Ver acuse'}</a> ${o.fecha_acuse ? '<span class="text-muted small ms-2">('+o.fecha_acuse+')</span>' : ''}</div></div>` : ''}
                    ${o.estatus === 'Cancelado' ? `
                    <div class="col-md-6"><div class="detail-lbl">Cancelado por</div><div class="detail-val text-danger">${o.cancelado_por || '—'}</div></div>
                    <div class="col-md-6"><div class="detail-lbl">Motivo</div><div class="detail-val">${o.motivo_cancelacion || '—'}</div></div>` : ''}
                </div>`;
        } catch(e) {
            document.getElementById('detalleBody').innerHTML = `<div class="alert alert-danger">${e.message}</div>`;
        }
    }

    /* ── Acuse ── */
    function abrirAcuse(id, folio, tieneAcuse) {
        currentOficioId = id;
        document.getElementById('acuseFolioNum').textContent = folio;
        clearAlert('alertAcuse');
        document.getElementById('formAcuse').reset();
        document.getElementById('fAcuseFecha').value = '{{ now()->toDateString() }}';
        new bootstrap.Modal(document.getElementById('modalAcuse')).show();
    }

    document.getElementById('btnGuardarAcuse').addEventListener('click', async function() {
        clearAlert('alertAcuse');
        const form = document.getElementById('formAcuse');
        const data = new FormData(form);
        spin('spinnerAcuse', true); this.disabled = true;

        try {
            const res = await fetch(`/mis-oficios/${currentOficioId}/acuse`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json', 'X-HTTP-Method-Override': 'PATCH' },
                body: data,
            });
            const json = await res.json();
            if (!res.ok || !json.success) throw new Error(json.message || 'Error al guardar el acuse.');
            showAlert('alertAcuse', json.message, 'success');
            setTimeout(() => location.reload(), 1500);
        } catch(e) {
            showAlert('alertAcuse', e.message);
        } finally {
            spin('spinnerAcuse', false); this.disabled = false;
        }
    });

    /* ── Cancelar ── */
    function cancelarOficio(id, folio) {
        currentOficioId = id;
        document.getElementById('cancelFolioNum').textContent = folio;
        document.getElementById('fMotivoCancelacion').value = '';
        clearAlert('alertCancelar');
        new bootstrap.Modal(document.getElementById('modalCancelar')).show();
    }

    document.getElementById('btnConfirmarCancelar').addEventListener('click', async function() {
        clearAlert('alertCancelar');
        const motivo = document.getElementById('fMotivoCancelacion').value;
        const data   = new FormData();
        data.append('motivo_cancelacion', motivo);
        spin('spinnerCancelar', true); this.disabled = true;

        try {
            const res = await fetch(`/mis-oficios/${currentOficioId}/cancelar`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json', 'X-HTTP-Method-Override': 'PATCH' },
                body: data,
            });
            const json = await res.json();
            if (!res.ok || !json.success) throw new Error(json.message || 'Error al cancelar.');
            showAlert('alertCancelar', json.message, 'success');
            setTimeout(() => location.reload(), 1500);
        } catch(e) {
            showAlert('alertCancelar', e.message);
        } finally {
            spin('spinnerCancelar', false); this.disabled = false;
        }
    });
    </script>
    @endpush
</x-app-layout>
