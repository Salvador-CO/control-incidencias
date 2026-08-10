<x-app-layout>
    <x-slot name="header">Gestión de Roles y Permisos</x-slot>

    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
        .permiso-chip { display:inline-block; background:rgba(0,96,57,.08); color:#006039; border:1px solid rgba(0,96,57,.2); border-radius:20px; padding:2px 10px; font-size:0.75rem; margin:2px; }
        .modulo-label { font-size:0.72rem; text-transform:uppercase; letter-spacing:1px; color:#6c757d; font-weight:700; }
        .check-all-btn { cursor:pointer; }
    </style>

    <div class="row g-4">
        <!-- Lista de Roles -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center rounded-top-4">
                    <h6 class="mb-0 fw-bold"><i class="bi bi-shield-lock me-2 text-success"></i> Roles</h6>
                    <button class="btn btn-sm text-white" style="background:var(--cb-green);" data-bs-toggle="modal" data-bs-target="#modalNuevoRol">
                        <i class="bi bi-plus-lg"></i> Nuevo
                    </button>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush" id="listaRoles">
                        @foreach($roles as $rol)
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3 px-3 rol-item"
                            data-id="{{ $rol->id }}"
                            data-nombre="{{ $rol->name }}"
                            data-permisos="{{ $rol->permissions->pluck('name')->toJson() }}"
                            style="cursor:pointer;">
                            <div>
                                <div class="fw-semibold">{{ $rol->name }}</div>
                                <div class="small text-muted">{{ $rol->permissions->count() }} permiso(s)</div>
                            </div>
                            <div class="d-flex gap-1">
                                <button class="btn btn-outline-primary btn-xs btn-sm py-0 px-2" onclick="editarRol({{ $rol->id }}, '{{ addslashes($rol->name) }}', event)" title="Renombrar"><i class="bi bi-pencil"></i></button>
                                @if($rol->name !== 'Administrador')
                                <button class="btn btn-outline-danger btn-xs btn-sm py-0 px-2" onclick="eliminarRol({{ $rol->id }}, event)" title="Eliminar"><i class="bi bi-trash"></i></button>
                                @endif
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Permisos del rol seleccionado -->
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-bottom py-3 rounded-top-4">
                    <h6 class="mb-0 fw-bold" id="titPermisos"><i class="bi bi-sliders me-2 text-primary"></i> Seleccione un rol para editar sus permisos</h6>
                </div>
                <div class="card-body p-4" id="panelPermisos">
                    <div class="text-center text-muted py-5">
                        <i class="bi bi-arrow-left-circle fs-1 opacity-25"></i>
                        <p class="mt-2">Haz clic en un rol para gestionar sus permisos</p>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 px-4 pb-4" id="footerPermisos" style="display:none;">
                    <button class="btn text-white px-4" style="background:var(--cb-green);" onclick="guardarPermisos()">
                        <i class="bi bi-save me-1"></i> Guardar Permisos
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Nuevo Rol -->
    <div class="modal fade" id="modalNuevoRol" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold"><i class="bi bi-shield-plus me-2 text-success"></i> Nuevo Rol</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body pt-3">
                    <label class="form-label fw-bold">Nombre del Rol <span class="text-danger">*</span></label>
                    <input type="text" id="nuevoRolNombre" class="form-control form-control-lg" placeholder="Ej. Auditor, Subdirector...">
                    <div class="form-text">El nombre debe ser único y descriptivo del acceso que tendrá este grupo.</div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn text-white px-4" style="background:var(--cb-green);" onclick="crearRol()">
                        <i class="bi bi-save me-1"></i> Crear Rol
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Renombrar Rol -->
    <div class="modal fade" id="modalEditarRol" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold"><i class="bi bi-pencil-square me-2 text-primary"></i> Renombrar Rol</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body pt-3">
                    <input type="hidden" id="editRolId">
                    <label class="form-label fw-bold">Nuevo Nombre</label>
                    <input type="text" id="editRolNombre" class="form-control form-control-lg">
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary px-4" onclick="guardarRenombrar()"><i class="bi bi-check-lg me-1"></i> Actualizar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index:9999">
        <div id="toastMsg" class="toast align-items-center text-white border-0 shadow">
            <div class="d-flex"><div class="toast-body fw-semibold" id="toastText"></div><button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        const CSRF = document.querySelector('meta[name=csrf-token]').content;
        let rolActualId = null;

        // Todos los permisos agrupados por módulo
        const todosPermisos = @json($permisos);

        function showToast(msg, type='success') {
            const t = document.getElementById('toastMsg');
            t.style.background = {success:'#006039', danger:'#dc3545', warning:'#ffc107'}[type] || '#006039';
            document.getElementById('toastText').textContent = msg;
            bootstrap.Toast.getOrCreateInstance(t, {delay:4000}).show();
        }

        // Render panel de permisos
        function renderPermisos(rolId, rolNombre, permisosActivos) {
            rolActualId = rolId;
            document.getElementById('titPermisos').innerHTML = `<i class="bi bi-sliders me-2 text-primary"></i> Permisos de: <strong>${rolNombre}</strong>`;
            document.getElementById('footerPermisos').style.display = 'block';

            let html = '';
            for (const [modulo, perms] of Object.entries(todosPermisos)) {
                html += `<div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="modulo-label">${modulo}</span>
                        <button class="btn btn-link btn-sm text-muted p-0 check-all-btn" onclick="toggleModulo('${modulo}', this)">Seleccionar todo</button>
                    </div>
                    <div class="d-flex flex-wrap gap-2">`;
                for (const p of perms) {
                    const checked = permisosActivos.includes(p.name) ? 'checked' : '';
                    const etiqueta = p.name.replace(/-/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
                    html += `<div class="form-check form-check-inline">
                        <input class="form-check-input perm-check" type="checkbox" id="perm_${p.id}" value="${p.name}" ${checked} data-modulo="${modulo}">
                        <label class="form-check-label small" for="perm_${p.id}">${etiqueta}</label>
                    </div>`;
                }
                html += `</div></div>`;
            }
            document.getElementById('panelPermisos').innerHTML = html;
        }

        // Click en un rol
        document.querySelectorAll('.rol-item').forEach(item => {
            item.addEventListener('click', function () {
                document.querySelectorAll('.rol-item').forEach(i => i.classList.remove('active', 'bg-light'));
                this.classList.add('bg-light');
                const permisos = JSON.parse(this.dataset.permisos);
                renderPermisos(this.dataset.id, this.dataset.nombre, permisos);
            });
        });

        function toggleModulo(modulo, btn) {
            const checks = document.querySelectorAll(`.perm-check[data-modulo="${modulo}"]`);
            const allChecked = Array.from(checks).every(c => c.checked);
            checks.forEach(c => c.checked = !allChecked);
            btn.textContent = allChecked ? 'Seleccionar todo' : 'Deseleccionar todo';
        }

        async function guardarPermisos() {
            if (!rolActualId) return;
            const permisos = Array.from(document.querySelectorAll('.perm-check:checked')).map(c => c.value);
            const nombre = document.querySelector(`.rol-item[data-id="${rolActualId}"]`)?.dataset.nombre;
            const r = await fetch(`/roles/${rolActualId}`, {
                method: 'PUT', headers: {'Content-Type':'application/json','X-CSRF-TOKEN':CSRF},
                body: JSON.stringify({ nombre, permisos })
            });
            const d = await r.json();
            if (r.ok) { showToast(d.message); setTimeout(() => location.reload(), 1200); }
            else showToast(d.message, 'danger');
        }

        async function crearRol() {
            const nombre = document.getElementById('nuevoRolNombre').value.trim();
            if (!nombre) return showToast('El nombre es requerido.', 'warning');
            const r = await fetch('{{ route("roles.store") }}', {
                method: 'POST', headers: {'Content-Type':'application/json','X-CSRF-TOKEN':CSRF},
                body: JSON.stringify({ nombre })
            });
            const d = await r.json();
            if (r.ok) { showToast(d.message); setTimeout(() => location.reload(), 1200); }
            else showToast(d.message || Object.values(d.errors||{})[0]?.[0], 'danger');
        }

        function editarRol(id, nombre, event) {
            event.stopPropagation();
            document.getElementById('editRolId').value = id;
            document.getElementById('editRolNombre').value = nombre;
            new bootstrap.Modal(document.getElementById('modalEditarRol')).show();
        }

        async function guardarRenombrar() {
            const id = document.getElementById('editRolId').value;
            const nombre = document.getElementById('editRolNombre').value.trim();
            if (!nombre) return showToast('El nombre es requerido.', 'warning');
            // Obtenemos permisos actuales del rol
            const permisosActivos = Array.from(document.querySelectorAll('.perm-check:checked')).map(c => c.value);
            const r = await fetch(`/roles/${id}`, {
                method: 'PUT', headers: {'Content-Type':'application/json','X-CSRF-TOKEN':CSRF},
                body: JSON.stringify({ nombre, permisos: permisosActivos })
            });
            const d = await r.json();
            if (r.ok) { showToast(d.message); setTimeout(() => location.reload(), 1200); }
            else showToast(d.message, 'danger');
        }

        async function eliminarRol(id, event) {
            event.stopPropagation();
            if (!confirm('¿Eliminar este rol? Los usuarios con este rol quedarán sin rol.')) return;
            const r = await fetch(`/roles/${id}`, { method:'DELETE', headers:{'X-CSRF-TOKEN':CSRF} });
            const d = await r.json();
            if (r.ok) { showToast(d.message); document.querySelector(`.rol-item[data-id="${id}"]`)?.remove(); }
            else showToast(d.message, 'danger');
        }
    </script>
</x-app-layout>
