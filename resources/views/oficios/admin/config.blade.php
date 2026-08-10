<x-app-layout>
    @push('styles')
    <style>
        :root { --of-green:#006039; --of-green-lt:#e8f5ee; }
        .config-card { border-radius:16px; border:none; box-shadow:0 2px 12px rgba(0,0,0,.06); }
        .config-table th { font-size:.72rem; text-transform:uppercase; letter-spacing:1px; font-weight:700; color:#6c757d; border-bottom:2px solid #e9ecef; padding:.75rem 1rem; }
        .config-table td { padding:.9rem 1rem; vertical-align:middle; font-size:.875rem; border-color:#f0f0f0; }
        .config-table tbody tr:hover { background:#f8fffe; }
        .depto-badge { display:inline-block; font-weight:700; font-size:.8rem; padding:.3rem .7rem; border-radius:8px; background:var(--of-green-lt); color:var(--of-green); font-family:'Courier New',monospace; }
        .url-cell { max-width:300px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
        .btn-green { background:var(--of-green); color:white; border:none; border-radius:10px; font-weight:600; transition:all .2s; }
        .btn-green:hover { background:#004a2c; color:white; transform:translateY(-1px); box-shadow:0 4px 14px rgba(0,96,57,.3); }
        .modal-content { border-radius:16px; border:none; box-shadow:0 25px 60px rgba(0,0,0,.15); }
        .modal-header-green { background:linear-gradient(135deg,var(--of-green),#004a2c); color:white; border-radius:16px 16px 0 0; }
        .modal-body .form-label { font-size:.82rem; font-weight:600; color:#495057; text-transform:uppercase; letter-spacing:.5px; }
        .modal-body .form-control, .modal-body .form-select { border-radius:10px; border-color:#dee2e6; font-size:.9rem; }
        .modal-body .form-control:focus, .modal-body .form-select:focus { border-color:var(--of-green); box-shadow:0 0 0 3px rgba(0,96,57,.12); }
        .info-box { background:#f0f8f4; border:1px solid #c3e6cb; border-radius:12px; padding:1rem 1.25rem; font-size:.85rem; color:#155724; }
        .info-box i { font-size:1.1rem; }
        .empty-row td { text-align:center; padding:3rem; color:#adb5bd; }
    </style>
    @endpush

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold mb-0">
                <i class="bi bi-cloud-arrow-up me-2" style="color:var(--cb-green);"></i>
                Configuración OneDrive
            </h1>
            <p class="text-muted small mb-0 mt-1">Asigna un enlace de carpeta OneDrive compartida a cada departamento</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.oficios.index') }}" class="btn btn-sm btn-outline-secondary rounded-3">
                <i class="bi bi-arrow-left me-1"></i>Todos los Oficios
            </a>
            <button class="btn btn-sm btn-green px-3" data-bs-toggle="modal" data-bs-target="#modalConfig">
                <i class="bi bi-plus-lg me-1"></i>Agregar Config.
            </button>
        </div>
    </div>

    {{-- Info box --}}
    <div class="info-box mb-4">
        <div class="d-flex gap-3 align-items-start">
            <i class="bi bi-info-circle-fill flex-shrink-0 mt-1"></i>
            <div>
                <strong>¿Cómo funciona?</strong><br>
                Cada asistente sube el acuse de su oficio a su <strong>carpeta de OneDrive</strong> y copia el enlace compartido. Al registrar el acuse en el sistema, pega ese enlace. El servidor solo guarda la URL — <strong>no ocupa espacio en el servidor</strong>.<br><br>
                Configura aquí el enlace base de la carpeta compartida de cada departamento para que la asistente sepa dónde subir sus archivos.
            </div>
        </div>
    </div>

    {{-- Tabla de configuraciones --}}
    <div class="card config-card">
        <div class="card-header bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center">
            <h6 class="mb-0 fw-bold">Configuraciones por departamento</h6>
            <span class="badge bg-light text-muted">{{ $configs->count() }} de {{ $departamentos->count() }} departamentos configurados</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table config-table mb-0">
                    <thead>
                        <tr>
                            <th>Departamento</th>
                            <th>Clave</th>
                            <th>Enlace OneDrive</th>
                            <th>Descripción</th>
                            <th>Actualizado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($departamentos as $depto)
                        @php $cfg = $configs[$depto->id] ?? null; @endphp
                        <tr>
                            <td class="fw-semibold">{{ $depto->nombre }}</td>
                            <td>
                                @if($depto->clave)
                                <span class="depto-badge">{{ $depto->clave }}</span>
                                @else
                                <span class="text-warning small"><i class="bi bi-exclamation-triangle me-1"></i>Sin clave</span>
                                @endif
                            </td>
                            <td class="url-cell">
                                @if($cfg)
                                <a href="{{ $cfg->onedrive_url }}" target="_blank" rel="noopener" class="text-success fw-semibold small"
                                   title="{{ $cfg->onedrive_url }}">
                                    <i class="bi bi-cloud-check-fill me-1"></i>
                                    {{ $cfg->onedrive_url }}
                                </a>
                                @else
                                <span class="text-muted small fst-italic">Sin configurar</span>
                                @endif
                            </td>
                            <td class="small text-muted">{{ $cfg?->descripcion ?? '—' }}</td>
                            <td class="small text-muted text-nowrap">
                                {{ $cfg ? $cfg->updated_at->format('d/m/Y H:i') : '—' }}
                            </td>
                            <td>
                                @if($cfg)
                                <div class="d-flex gap-1">
                                    <button class="btn btn-sm btn-outline-secondary rounded-2 py-1 px-2"
                                        title="Editar"
                                        onclick="editarConfig({{ $cfg->id }}, {{ $depto->id }}, '{{ $depto->nombre }}', '{{ addslashes($cfg->onedrive_url) }}', '{{ addslashes($cfg->descripcion ?? '') }}')">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger rounded-2 py-1 px-2"
                                        title="Eliminar"
                                        onclick="eliminarConfig({{ $cfg->id }}, '{{ $depto->nombre }}')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                                @else
                                <button class="btn btn-sm btn-green py-1 px-2"
                                    onclick="agregarConfig({{ $depto->id }}, '{{ $depto->nombre }}')">
                                    <i class="bi bi-plus-lg me-1"></i>Configurar
                                </button>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="empty-row">No hay departamentos registrados.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ═══ MODALES ═══ --}}

    {{-- Modal Agregar/Editar --}}
    <div class="modal fade" id="modalConfig" tabindex="-1" aria-labelledby="labelConfig" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-header-green border-0 py-3">
                    <h5 class="modal-title fw-bold" id="labelConfig">
                        <i class="bi bi-cloud-upload me-2"></i><span id="modalConfigTitle">Agregar Configuración</span>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div id="alertConfig"></div>
                    <form id="formConfig" novalidate>
                        <div class="mb-3">
                            <label class="form-label">Departamento <span class="text-danger">*</span></label>
                            <select class="form-select" name="departamento_id" id="fConfigDepto" required>
                                <option value="">Seleccionar departamento...</option>
                                @foreach($departamentos as $d)
                                <option value="{{ $d->id }}">{{ $d->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Enlace OneDrive (carpeta compartida) <span class="text-danger">*</span></label>
                            <input type="url" class="form-control" name="onedrive_url" id="fConfigUrl"
                                placeholder="https://1drv.ms/f/... o https://drive.microsoft.com/..."
                                required>
                            <div class="form-text">
                                En OneDrive → abre la carpeta → Compartir → Copiar enlace. Pega ese enlace aquí.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripción de la carpeta</label>
                            <input type="text" class="form-control" name="descripcion" id="fConfigDesc"
                                placeholder="Ej: Acuses de Oficios DASE 2026">
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-green px-4" id="btnGuardarConfig">
                        <span class="spinner-border spinner-border-sm me-2 d-none" id="spinnerConfig"></span>
                        <i class="bi bi-floppy me-1"></i>Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    const CSRF = document.querySelector('meta[name="csrf-token"]').content;
    let editConfigId = null;

    function showAlert(id, msg, type='danger') {
        document.getElementById(id).innerHTML =
            `<div class="alert alert-${type} alert-dismissible fade show small py-2"><i class="bi bi-${type==='success'?'check-circle':'exclamation-triangle'} me-2"></i>${msg}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>`;
    }
    function clearAlert(id) { document.getElementById(id).innerHTML=''; }
    function spin(id,s) { document.getElementById(id).classList.toggle('d-none',!s); }

    function agregarConfig(deptoId, deptoNombre) {
        editConfigId = null;
        document.getElementById('modalConfigTitle').textContent = 'Agregar Configuración';
        document.getElementById('fConfigDepto').value = deptoId;
        document.getElementById('fConfigDepto').disabled = true;
        document.getElementById('fConfigUrl').value = '';
        document.getElementById('fConfigDesc').value = '';
        clearAlert('alertConfig');
        new bootstrap.Modal(document.getElementById('modalConfig')).show();
    }

    function editarConfig(cfgId, deptoId, deptoNombre, url, desc) {
        editConfigId = cfgId;
        document.getElementById('modalConfigTitle').textContent = 'Editar Configuración — ' + deptoNombre;
        document.getElementById('fConfigDepto').value = deptoId;
        document.getElementById('fConfigDepto').disabled = true;
        document.getElementById('fConfigUrl').value = url;
        document.getElementById('fConfigDesc').value = desc;
        clearAlert('alertConfig');
        new bootstrap.Modal(document.getElementById('modalConfig')).show();
    }

    // Re-enable select when modal closes
    document.getElementById('modalConfig').addEventListener('hidden.bs.modal', () => {
        document.getElementById('fConfigDepto').disabled = false;
        editConfigId = null;
    });

    document.getElementById('btnGuardarConfig').addEventListener('click', async function() {
        clearAlert('alertConfig');
        const form = document.getElementById('formConfig');
        const data = new FormData(form);
        // Re-add departamento_id if disabled
        if (!data.get('departamento_id')) {
            data.set('departamento_id', document.getElementById('fConfigDepto').value);
        }
        spin('spinnerConfig', true); this.disabled = true;

        try {
            let url, method;
            if (editConfigId) {
                url = `/admin/oficios/config/${editConfigId}`;
                data.append('_method', 'PUT');
                method = 'POST';
            } else {
                url = '/admin/oficios/config';
                method = 'POST';
            }

            const res = await fetch(url, {
                method,
                headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
                body: data,
            });
            const json = await res.json();
            if (!res.ok || !json.success) throw new Error(json.message || 'Error al guardar.');
            showAlert('alertConfig', json.message, 'success');
            setTimeout(() => location.reload(), 1500);
        } catch(e) {
            showAlert('alertConfig', e.message);
        } finally {
            spin('spinnerConfig', false); this.disabled = false;
        }
    });

    async function eliminarConfig(cfgId, deptoNombre) {
        if (!confirm(`¿Eliminar la configuración de OneDrive del departamento "${deptoNombre}"?`)) return;
        try {
            const res = await fetch(`/admin/oficios/config/${cfgId}`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
                body: new URLSearchParams({ _method: 'DELETE' }),
            });
            const json = await res.json();
            if (!json.success) throw new Error(json.message);
            location.reload();
        } catch(e) {
            alert('Error: ' + e.message);
        }
    }
    </script>
    @endpush
</x-app-layout>
