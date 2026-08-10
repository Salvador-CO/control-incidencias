<x-app-layout>
    @push('styles')
    <style>
        :root {
            --of-green: #006039; --of-green-lt: #e8f5ee;
            --of-red: #842029; --of-red-lt: #fdf3f3;
        }
        .stat-card { border-radius:16px; padding:1.25rem 1.5rem; display:flex; align-items:center; gap:1rem; border:none; transition:transform .2s,box-shadow .2s; }
        .stat-card:hover { transform:translateY(-2px); box-shadow:0 8px 24px rgba(0,0,0,0.08); }
        .stat-icon { width:48px; height:48px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.3rem; flex-shrink:0; }
        .stat-val { font-size:1.6rem; font-weight:800; line-height:1; }
        .stat-lbl { font-size:0.75rem; font-weight:600; text-transform:uppercase; letter-spacing:.8px; opacity:.7; }

        .oficios-table th { font-size:.72rem; text-transform:uppercase; letter-spacing:1px; font-weight:700; color:#6c757d; border-bottom:2px solid #e9ecef; padding:.75rem 1rem; white-space:nowrap; }
        .oficios-table td { padding:.85rem 1rem; vertical-align:middle; font-size:.875rem; border-color:#f0f0f0; }
        .oficios-table tbody tr:hover { background:#f8fffe; }
        .folio-badge { font-weight:700; font-size:.9rem; color:var(--of-green); font-family:'Courier New',monospace; background:var(--of-green-lt); padding:.25rem .6rem; border-radius:6px; display:inline-block; }
        .status-badge { padding:.35rem .85rem; border-radius:50px; font-size:.72rem; font-weight:700; letter-spacing:.5px; display:inline-flex; align-items:center; gap:.3rem; }
        .status-pendiente { background:#fff9e6; color:#856404; border:1px solid #ffc10740; }
        .status-entregado { background:var(--of-green-lt); color:#155724; border:1px solid #00603930; }
        .status-cancelado { background:var(--of-red-lt); color:var(--of-red); border:1px solid #84202930; }

        .filters-bar { background:#fff; border-radius:12px; padding:1rem 1.25rem; box-shadow:0 2px 12px rgba(0,0,0,0.04); border:1px solid #e9ecef; }
        .filters-bar .form-select, .filters-bar .form-control { border-radius:8px; font-size:.85rem; border-color:#dee2e6; }
        .filters-bar .form-select:focus, .filters-bar .form-control:focus { border-color:var(--of-green); box-shadow:0 0 0 3px rgba(0,96,57,.12); }
        .btn-green { background:var(--of-green); color:white; border:none; border-radius:10px; font-weight:600; transition:all .2s; }
        .btn-green:hover { background:#004a2c; color:white; }

        /* Tabla departamentos resumen */
        .depto-summary { background:#fff; border-radius:12px; box-shadow:0 2px 12px rgba(0,0,0,.04); border:1px solid #e9ecef; overflow:hidden; }
        .depto-summary th { font-size:.72rem; text-transform:uppercase; letter-spacing:1px; color:#6c757d; background:#f8f9fa; border-bottom:2px solid #e9ecef; }
        .depto-summary td { font-size:.85rem; border-color:#f0f0f0; }

        .modal-content { border-radius:16px; border:none; box-shadow:0 25px 60px rgba(0,0,0,.15); }
        .modal-header-green { background:linear-gradient(135deg,var(--of-green),#004a2c); color:white; border-radius:16px 16px 0 0; }
        .detail-lbl { font-size:.7rem; text-transform:uppercase; letter-spacing:1px; color:#adb5bd; font-weight:700; }
        .detail-val { font-size:.9rem; color:#212529; font-weight:500; }
        .empty-state { text-align:center; padding:4rem 2rem; color:#adb5bd; }
        .empty-state i { font-size:3rem; display:block; margin-bottom:1rem; }
    </style>
    @endpush

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold mb-0">
                <i class="bi bi-envelope-paper me-2" style="color:var(--cb-green);"></i>
                Todos los Oficios
            </h1>
            <p class="text-muted small mb-0 mt-1">Vista global de todos los departamentos — Año {{ $anioFiltro }}</p>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <a href="{{ route('admin.oficios.config') }}" class="btn btn-sm btn-outline-secondary rounded-3">
                <i class="bi bi-cloud me-1"></i>Config OneDrive
            </a>
            <a href="{{ route('oficios.portal') }}" class="btn btn-sm btn-outline-success rounded-3" target="_blank">
                <i class="bi bi-box-arrow-up-right me-1"></i>Portal público
            </a>
        </div>
    </div>

    {{-- Stats globales --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="stat-card bg-white shadow-sm">
                <div class="stat-icon" style="background:#e8f5ee;color:var(--of-green);"><i class="bi bi-envelope-paper"></i></div>
                <div><div class="stat-val" style="color:var(--of-green);">{{ $statsGlobal['total'] }}</div><div class="stat-lbl">Total</div></div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card bg-white shadow-sm">
                <div class="stat-icon" style="background:#fff9e6;color:#856404;"><i class="bi bi-clock"></i></div>
                <div><div class="stat-val" style="color:#856404;">{{ $statsGlobal['pendiente'] }}</div><div class="stat-lbl">Pendientes</div></div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card bg-white shadow-sm">
                <div class="stat-icon" style="background:#e8f5ee;color:#155724;"><i class="bi bi-check-circle"></i></div>
                <div><div class="stat-val" style="color:#155724;">{{ $statsGlobal['entregado'] }}</div><div class="stat-lbl">Entregados</div></div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card bg-white shadow-sm">
                <div class="stat-icon" style="background:#fdf3f3;color:var(--of-red);"><i class="bi bi-x-circle"></i></div>
                <div><div class="stat-val" style="color:var(--of-red);">{{ $statsGlobal['cancelado'] }}</div><div class="stat-lbl">Cancelados</div></div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- Tabla principal --}}
        <div class="col-12">
            {{-- Filtros --}}
            <div class="filters-bar mb-4">
                <form method="GET" action="{{ route('admin.oficios.index') }}" class="row g-2 align-items-end">
                    <div class="col-6 col-md-2">
                        <label class="form-label small fw-semibold mb-1">Año</label>
                        <select name="anio" class="form-select form-select-sm" onchange="this.form.submit()">
                            @foreach($aniosDisponibles as $a)
                            <option value="{{ $a }}" {{ $anioFiltro == $a ? 'selected' : '' }}>{{ $a }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <label class="form-label small fw-semibold mb-1">Departamento</label>
                        <select name="departamento_id" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="">Todos</option>
                            @foreach($departamentos as $d)
                            <option value="{{ $d->id }}" {{ $deptoFiltro == $d->id ? 'selected' : '' }}>
                                {{ $d->clave ? '[' . $d->clave . '] ' : '' }}{{ $d->nombre }}
                            </option>
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
                    <div class="col-12 col-md-4">
                        <label class="form-label small fw-semibold mb-1">Buscar</label>
                        <input type="text" name="q" class="form-control form-control-sm" placeholder="Folio, asunto, dirigido a..." value="{{ $busqueda }}">
                    </div>
                    <div class="col-6 col-md-1">
                        <button type="submit" class="btn btn-sm btn-green w-100"><i class="bi bi-funnel"></i></button>
                    </div>
                    @if($busqueda || $estatusFiltro || $deptoFiltro)
                    <div class="col-6 col-md-1">
                        <a href="{{ route('admin.oficios.index', ['anio' => $anioFiltro]) }}" class="btn btn-sm btn-outline-secondary w-100" title="Limpiar">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    </div>
                    @endif
                </form>
            </div>

            <div class="card border-0 shadow-sm" style="border-radius:16px;overflow:hidden;">
                <div class="card-body p-0">
                    @if($oficios->isEmpty())
                    <div class="empty-state">
                        <i class="bi bi-envelope-open"></i>
                        <h5>No hay oficios que mostrar</h5>
                        <p class="small">Prueba cambiando los filtros.</p>
                    </div>
                    @else
                    <div class="table-responsive">
                        <table class="table oficios-table mb-0">
                            <thead>
                                <tr>
                                    <th>Folio</th>
                                    <th>Departamento</th>
                                    <th>Fecha</th>
                                    <th>Jefe / Referencia</th>
                                    <th>Asunto</th>
                                    <th>Dirigido a</th>
                                    <th>Registrado por</th>
                                    <th>Estatus</th>
                                    <th>Acuse</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($oficios as $oficio)
                                <tr style="cursor:pointer;" onclick="verDetalle({{ $oficio->id }})">
                                    <td><span class="folio-badge">{{ $oficio->numero_oficio }}</span></td>
                                    <td>
                                        @if($oficio->departamento?->clave)
                                        <span class="badge bg-secondary me-1" style="font-size:.65rem;">{{ $oficio->departamento->clave }}</span>
                                        @endif
                                        <span class="small">{{ optional($oficio->departamento)->nombre }}</span>
                                    </td>
                                    <td class="text-nowrap small">{{ $oficio->fecha_registro?->format('d/m/Y') }}</td>
                                    <td class="small">{{ $oficio->jefe_referencia }}</td>
                                    <td class="small" style="max-width:180px;" title="{{ $oficio->asunto }}">
                                        <span class="text-truncate d-inline-block" style="max-width:180px;">{{ $oficio->asunto }}</span>
                                    </td>
                                    <td class="small" style="max-width:150px;" title="{{ $oficio->dirigido_a }}">
                                        <span class="text-truncate d-inline-block" style="max-width:150px;">{{ $oficio->dirigido_a }}</span>
                                    </td>
                                    <td class="small">{{ $oficio->registrado_por_nombre }}</td>
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
                                        @if($oficio->acuse_url)
                                        <a href="{{ $oficio->acuse_url }}" target="_blank" rel="noopener"
                                           class="text-success fw-semibold small" onclick="event.stopPropagation();">
                                            <i class="bi bi-file-earmark-check-fill me-1"></i>Ver
                                        </a>
                                        @else
                                        <span class="text-muted small">—</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Resumen por departamento --}}
        @if($porDepto->isNotEmpty())
        <div class="col-12">
            <h6 class="fw-bold text-muted mb-3 text-uppercase" style="font-size:.75rem;letter-spacing:1px;">
                <i class="bi bi-bar-chart me-1"></i>Resumen por Departamento ({{ $anioFiltro }})
            </h6>
            <div class="depto-summary">
                <table class="table table-sm mb-0">
                    <thead>
                        <tr>
                            <th class="py-2 px-3">Departamento</th>
                            <th class="py-2 text-center">Total</th>
                            <th class="py-2 text-center">Pendiente</th>
                            <th class="py-2 text-center">Entregado</th>
                            <th class="py-2 text-center">Cancelado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($porDepto as $depId => $rows)
                        @php
                            $depto = $rows->first()->departamento;
                            $totals = $rows->keyBy('estatus');
                        @endphp
                        <tr>
                            <td class="px-3 fw-semibold">
                                @if($depto?->clave)
                                <span class="badge me-1" style="background:#e8f5ee;color:var(--of-green);font-size:.7rem;">{{ $depto->clave }}</span>
                                @endif
                                {{ $depto?->nombre ?? '—' }}
                            </td>
                            <td class="text-center fw-bold">{{ $rows->sum('total') }}</td>
                            <td class="text-center"><span style="color:#856404;">{{ $totals['Pendiente']->total ?? 0 }}</span></td>
                            <td class="text-center"><span style="color:#155724;">{{ $totals['Entregado']->total ?? 0 }}</span></td>
                            <td class="text-center"><span style="color:var(--of-red);">{{ $totals['Cancelado']->total ?? 0 }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>

    {{-- Modal Detalle --}}
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

    @push('scripts')
    <script>
    async function verDetalle(id) {
        const modal = new bootstrap.Modal(document.getElementById('modalDetalle'));
        document.getElementById('detalleBody').innerHTML = '<div class="text-center py-4"><div class="spinner-border text-success"></div></div>';
        modal.show();
        try {
            const res = await fetch(`/mis-oficios/${id}`, { headers: { 'Accept': 'application/json' } });
            const json = await res.json();
            if (!json.success) throw new Error('Error');
            const o = json.oficio;
            const badgeColor = { Entregado:'success', Cancelado:'danger', Pendiente:'warning' };
            const badgeIcon  = { Entregado:'check-circle-fill', Cancelado:'x-circle-fill', Pendiente:'clock-fill' };
            document.getElementById('detalleBody').innerHTML = `
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                    <h5 class="mb-0 fw-bold" style="font-family:monospace;color:var(--of-green);">${o.numero_oficio}</h5>
                    <span class="badge bg-${badgeColor[o.estatus]} rounded-pill px-3"><i class="bi bi-${badgeIcon[o.estatus]} me-1"></i>${o.estatus}</span>
                </div>
                <div class="row g-3">
                    <div class="col-md-4"><div class="detail-lbl">Departamento</div><div class="detail-val">${o.departamento}</div></div>
                    <div class="col-md-4"><div class="detail-lbl">Fecha registro</div><div class="detail-val">${o.fecha_registro}</div></div>
                    <div class="col-md-4"><div class="detail-lbl">Capturado</div><div class="detail-val">${o.created_at}</div></div>
                    <div class="col-md-6"><div class="detail-lbl">Jefe / Referencia</div><div class="detail-val">${o.jefe_referencia}</div></div>
                    <div class="col-md-6"><div class="detail-lbl">Registrado por</div><div class="detail-val">${o.registrado_por_nombre}</div></div>
                    <div class="col-12"><div class="detail-lbl">Asunto</div><div class="detail-val">${o.asunto}</div></div>
                    <div class="col-12"><div class="detail-lbl">Dirigido a</div><div class="detail-val">${o.dirigido_a}</div></div>
                    ${o.acuse_url ? `<div class="col-12"><div class="detail-lbl">Acuse</div><div class="detail-val"><a href="${o.acuse_url}" target="_blank" class="text-success fw-semibold"><i class="bi bi-file-earmark-check-fill me-1"></i>${o.acuse_nombre || 'Ver acuse'}</a></div></div>` : ''}
                    ${o.estatus === 'Cancelado' ? `<div class="col-12"><div class="detail-lbl">Cancelado por / Motivo</div><div class="detail-val text-danger">${o.cancelado_por || ''} — ${o.motivo_cancelacion || '—'}</div></div>` : ''}
                </div>`;
        } catch(e) {
            document.getElementById('detalleBody').innerHTML = '<div class="alert alert-danger">No se pudo cargar el detalle.</div>';
        }
    }
    </script>
    @endpush
</x-app-layout>
