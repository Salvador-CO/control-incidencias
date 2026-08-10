<x-app-layout>
    <x-slot name="header">Gestión de Usuarios</x-slot>

    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <style>
        /* Select2 inside Bootstrap modal */
        #modalCrear .select2-container { width: 100% !important; }
        #modalCrear .select2-container .select2-selection--single {
            height: 42px;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            display: flex;
            align-items: center;
        }
        #modalCrear .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: normal;
            padding: 0 12px;
            color: #495057;
        }
        #modalCrear .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px;
        }
        #modalCrear .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #adb5bd;
        }
        .select2-dropdown { border: 1px solid #dee2e6; border-radius: 8px; box-shadow: 0 8px 25px rgba(0,0,0,0.12); }
        .select2-results__option--highlighted { background-color: var(--cb-green) !important; }
        .badge-rol { font-size: 0.8rem; }
        .emp-badge { background: rgba(0,96,57,.1); color: #006039; font-size:0.75rem; border-radius: 20px; padding: 2px 8px; }
    </style>

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center rounded-top-4">
            <h5 class="mb-0 fw-bold"><i class="bi bi-person-gear me-2 text-success"></i> Usuarios del Sistema</h5>
            <div class="d-flex gap-2">
                <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-shield-lock me-1"></i> Gestionar Roles
                </a>
                <button class="btn text-white shadow-sm" style="background:var(--cb-green);" data-bs-toggle="modal" data-bs-target="#modalCrear">
                    <i class="bi bi-plus-lg me-1"></i> Nuevo Usuario
                </button>
            </div>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table id="tablaUsuarios" class="table table-hover table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Usuario</th>
                            <th>Correo</th>
                            <th>Empleado Vinculado</th>
                            <th>Rol</th>
                            <th>Estatus</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $u)
                        <tr id="row-u-{{ $u->id }}">
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold me-2"
                                        style="width:36px;height:36px;min-width:36px;background:var(--cb-green);font-size:0.85rem;">
                                        {{ strtoupper(substr($u->name, 0, 1)) }}
                                    </div>
                                    <span class="fw-semibold">{{ $u->name }}</span>
                                </div>
                            </td>
                            <td class="text-muted small">{{ $u->email }}</td>
                            <td>
                                @if($u->empleado)
                                    <span class="emp-badge"><i class="bi bi-person-badge me-1"></i>{{ $u->empleado->numero_empleado }} – {{ $u->empleado->nombre }} {{ $u->empleado->apellido_paterno }}</span>
                                @else
                                    <span class="text-muted small">Externo</span>
                                @endif
                            </td>
                            <td>
                                @foreach($u->roles as $rol)
                                    <span class="badge rounded-pill px-3" style="background:var(--cb-green)">{{ $rol->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <span class="badge {{ $u->activo ? 'bg-success' : 'bg-secondary' }} rounded-pill px-3">
                                    {{ $u->activo ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-primary" title="Editar"
                                        onclick="abrirEditar({{ $u->id }}, '{{ addslashes($u->name) }}', '{{ $u->email }}', '{{ $u->roles->first()?->name }}')">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn {{ $u->activo ? 'btn-outline-warning' : 'btn-outline-success' }}" title="{{ $u->activo ? 'Desactivar' : 'Activar' }}"
                                        onclick="toggleActivo({{ $u->id }})">
                                        <i class="bi {{ $u->activo ? 'bi-person-x' : 'bi-person-check' }}"></i>
                                    </button>
                                    <button class="btn btn-outline-danger" title="Eliminar" onclick="eliminar({{ $u->id }})">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ─── Modal Crear ─────────────────────────────── -->
    <div class="modal fade" id="modalCrear" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold"><i class="bi bi-person-plus me-2 text-success"></i> Nuevo Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body pt-2">
                    <!-- Paso 1: ¿empleado o externo? -->
                    <div class="alert alert-light border rounded-3 mb-3 py-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipoUsuario" id="tipoEmpleado" value="empleado" checked>
                            <label class="form-check-label fw-semibold" for="tipoEmpleado"><i class="bi bi-person-badge me-1 text-success"></i> Vincular a empleado</label>
                        </div>
                        <div class="form-check form-check-inline ms-3">
                            <input class="form-check-input" type="radio" name="tipoUsuario" id="tipoExterno" value="externo">
                            <label class="form-check-label fw-semibold" for="tipoExterno"><i class="bi bi-person-plus me-1 text-primary"></i> Usuario externo</label>
                        </div>
                    </div>

                    <!-- Búsqueda de empleado -->
                    <div id="bloqueEmpleado">
                        <label class="form-label fw-bold">Buscar empleado <span class="text-danger">*</span></label>
                        <select id="selectEmpleado" class="form-control w-100 mb-3" style="width:100%">
                            <option value="">Escriba matrícula o nombre...</option>
                        </select>
                    </div>

                    <!-- Datos del usuario (se llenan automáticamente) -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nombre completo <span class="text-danger">*</span></label>
                            <input type="text" id="crearNombre" class="form-control" placeholder="Nombre del usuario">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Correo electrónico <span class="text-danger">*</span></label>
                            <input type="email" id="crearEmail" class="form-control" placeholder="correo@ejemplo.com">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Contraseña <span class="text-danger">*</span></label>
                            <input type="password" id="crearPassword" class="form-control" placeholder="Mínimo 8 caracteres">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Rol <span class="text-danger">*</span></label>
                            <select id="crearRol" class="form-select">
                                <option value="">Seleccione un rol...</option>
                                @foreach($roles as $rol)
                                <option value="{{ $rol->name }}">{{ $rol->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Info de permisos del rol seleccionado -->
                    <div id="infoPermisos" class="mt-3 p-3 bg-light rounded-3 small" style="display:none;">
                        <i class="bi bi-shield-check me-1 text-success"></i>
                        <span id="textoPermisos"></span>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn text-white px-4" style="background:var(--cb-green);" onclick="guardarNuevo()">
                        <i class="bi bi-save me-1"></i> Crear Usuario
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ─── Modal Editar ─────────────────────────────── -->
    <div class="modal fade" id="modalEditar" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold"><i class="bi bi-pencil-square me-2 text-primary"></i> Editar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body pt-3">
                    <input type="hidden" id="editId">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-bold">Nombre</label>
                            <input type="text" id="editNombre" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Correo</label>
                            <input type="email" id="editEmail" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nueva Contraseña <small class="text-muted">(opcional)</small></label>
                            <input type="password" id="editPassword" class="form-control" placeholder="Dejar vacío para no cambiar">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Rol</label>
                            <select id="editRol" class="form-select">
                                @foreach($roles as $rol)
                                <option value="{{ $rol->name }}">{{ $rol->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary px-4" onclick="guardarEdicion()"><i class="bi bi-check-lg me-1"></i> Actualizar</button>
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
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        const CSRF = document.querySelector('meta[name=csrf-token]').content;
        let empleadoSelId = null;

        $(document).ready(function () {
            $('#tablaUsuarios').DataTable({ language: { url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-MX.json' } });

            // Select2 con búsqueda AJAX de empleados — dentro de modal Bootstrap
            $('#selectEmpleado').select2({
                dropdownParent: $('#modalCrear'),   // ← FIX: render dentro del modal
                placeholder: 'Escriba matrícula o nombre...',
                allowClear: true,
                minimumInputLength: 1,
                width: '100%',
                language: {
                    inputTooShort: () => 'Escribe al menos 1 caracter...',
                    searching: () => 'Buscando...',
                    noResults: () => 'No se encontraron empleados.'
                },
                ajax: {
                    url: '{{ route("usuarios.buscar-empleado") }}',
                    dataType: 'json',
                    delay: 300,
                    data: params => ({ q: params.term }),
                    processResults: data => ({ results: data }),
                    cache: true
                }
            }).on('select2:select', function (e) {
                const d = e.params.data;
                empleadoSelId = d.id;
                document.getElementById('crearNombre').value = d.nombre;
                document.getElementById('crearNombre').readOnly = true;
                if (d.correo) {
                    document.getElementById('crearEmail').value = d.correo;
                    document.getElementById('crearEmail').readOnly = true;
                } else {
                    document.getElementById('crearEmail').value = '';
                    document.getElementById('crearEmail').readOnly = false;
                    setTimeout(() => document.getElementById('crearEmail').focus(), 100);
                }
            }).on('select2:clear', function () {
                empleadoSelId = null;
                document.getElementById('crearNombre').value = '';
                document.getElementById('crearNombre').readOnly = false;
                document.getElementById('crearEmail').value = '';
                document.getElementById('crearEmail').readOnly = false;
            });

            // Mostrar/ocultar bloque empleado
            $('input[name="tipoUsuario"]').on('change', function () {
                if (this.value === 'empleado') {
                    document.getElementById('bloqueEmpleado').style.display = 'block';
                } else {
                    document.getElementById('bloqueEmpleado').style.display = 'none';
                    empleadoSelId = null;
                    document.getElementById('crearNombre').readOnly = false;
                    document.getElementById('crearEmail').readOnly = false;
                    $('#selectEmpleado').val(null).trigger('change');
                }
            });

            // Mostrar permisos del rol seleccionado al crearlo
            document.getElementById('crearRol').addEventListener('change', function () {
                const rolNombre = this.value;
                if (!rolNombre) { document.getElementById('infoPermisos').style.display = 'none'; return; }
                const roles = @json($roles->load('permissions'));
                const rol = roles.find(r => r.name === rolNombre);
                if (rol && rol.permissions.length > 0) {
                    document.getElementById('textoPermisos').textContent = 'Permisos: ' + rol.permissions.map(p => p.name).join(', ');
                    document.getElementById('infoPermisos').style.display = 'block';
                } else {
                    document.getElementById('infoPermisos').style.display = 'none';
                }
            });
        });

        function showToast(msg, type='success') {
            const t = document.getElementById('toastMsg');
            t.style.background = {success:'#006039', danger:'#dc3545', warning:'#ffc107'}[type] || '#006039';
            document.getElementById('toastText').textContent = msg;
            bootstrap.Toast.getOrCreateInstance(t, {delay:4000}).show();
        }

        function abrirEditar(id, nombre, email, rol) {
            document.getElementById('editId').value = id;
            document.getElementById('editNombre').value = nombre;
            document.getElementById('editEmail').value = email;
            document.getElementById('editRol').value = rol || '';
            document.getElementById('editPassword').value = '';
            new bootstrap.Modal(document.getElementById('modalEditar')).show();
        }

        async function guardarNuevo() {
            const nombre = document.getElementById('crearNombre').value.trim();
            const email = document.getElementById('crearEmail').value.trim();
            const pass = document.getElementById('crearPassword').value;
            const rol = document.getElementById('crearRol').value;

            if (!nombre || !email || !pass || !rol) return showToast('Todos los campos son requeridos.', 'warning');

            const r = await fetch('{{ route("usuarios.store") }}', {
                method: 'POST',
                headers: {'Content-Type':'application/json','X-CSRF-TOKEN':CSRF},
                body: JSON.stringify({ name: nombre, email, password: pass, role: rol, empleado_id: empleadoSelId })
            });
            const d = await r.json();
            if (r.ok) { showToast(d.message); setTimeout(() => location.reload(), 1300); }
            else showToast(d.message || Object.values(d.errors||{})[0]?.[0], 'danger');
        }

        async function guardarEdicion() {
            const id = document.getElementById('editId').value;
            const nombre = document.getElementById('editNombre').value.trim();
            const email = document.getElementById('editEmail').value.trim();
            const pass = document.getElementById('editPassword').value;
            const rol = document.getElementById('editRol').value;
            if (!nombre || !email || !rol) return showToast('Nombre, correo y rol son requeridos.', 'warning');
            const body = { name: nombre, email, role: rol };
            if (pass) body.password = pass;
            const r = await fetch(`/usuarios/${id}`, {
                method: 'PUT', headers: {'Content-Type':'application/json','X-CSRF-TOKEN':CSRF},
                body: JSON.stringify(body)
            });
            const d = await r.json();
            if (r.ok) { showToast(d.message); setTimeout(() => location.reload(), 1300); }
            else showToast(d.message || Object.values(d.errors||{})[0]?.[0], 'danger');
        }

        async function toggleActivo(id) {
            const r = await fetch(`/usuarios/${id}/toggle`, { method:'POST', headers:{'X-CSRF-TOKEN':CSRF} });
            const d = await r.json();
            if (r.ok) { showToast(d.message); setTimeout(() => location.reload(), 1200); }
            else showToast(d.message, 'danger');
        }

        async function eliminar(id) {
            if (!confirm('¿Eliminar permanentemente este usuario?')) return;
            const r = await fetch(`/usuarios/${id}`, { method:'DELETE', headers:{'X-CSRF-TOKEN':CSRF} });
            const d = await r.json();
            if (r.ok) { showToast(d.message); document.getElementById(`row-u-${id}`)?.remove(); }
            else showToast(d.message, 'danger');
        }
    </script>
</x-app-layout>
