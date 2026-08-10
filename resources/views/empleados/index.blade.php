<x-app-layout>
    <x-slot name="header">Gestión de Empleados</x-slot>

    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center rounded-top-4">
            <h5 class="mb-0 fw-bold"><i class="bi bi-people me-2"></i> Listado de Personal</h5>
            <button class="btn text-white shadow-sm" style="background:var(--cb-green);border-color:var(--cb-green);" data-bs-toggle="modal" data-bs-target="#modalCrear">
                <i class="bi bi-plus-lg me-1"></i> Registrar Empleado
            </button>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table id="empleadosTable" class="table table-hover table-striped align-middle" style="width:100%">
                    <thead class="table-light">
                        <tr>
                            <th>Matrícula</th>
                            <th>Nombre Completo</th>
                            <th>Departamento</th>
                            <th>Puesto</th>
                            <th>Estatus</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($empleados as $emp)
                        <tr id="row-emp-{{ $emp->id }}">
                            <td class="fw-bold text-success">{{ $emp->numero_empleado }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold me-2"
                                        style="width:36px;height:36px;min-width:36px;background:var(--cb-green);font-size:0.85rem;">
                                        {{ strtoupper(substr($emp->nombre, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-semibold">{{ $emp->nombre }} {{ $emp->apellido_paterno }} {{ $emp->apellido_materno }}</div>
                                        <div class="small text-muted">{{ $emp->correo ?? 'Sin correo' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $emp->departamento->nombre ?? '<span class="text-muted">—</span>' }}</td>
                            <td>{{ $emp->puesto->nombre ?? '<span class="text-muted">—</span>' }}</td>
                            <td>
                                <span class="badge {{ $emp->activo ? 'bg-success' : 'bg-danger' }} rounded-pill px-3">
                                    {{ $emp->activo ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-primary" title="Editar"
                                        onclick="abrirEditar({{ $emp->id }}, '{{ addslashes($emp->numero_empleado) }}', '{{ addslashes($emp->nombre) }}', '{{ addslashes($emp->apellido_paterno) }}', '{{ addslashes($emp->apellido_materno ?? '') }}', '{{ $emp->correo ?? '' }}', '{{ $emp->telefono ?? '' }}', {{ $emp->direccion_id ?? 'null' }}, {{ $emp->departamento_id ?? 'null' }}, {{ $emp->puesto_id ?? 'null' }}, {{ $emp->activo ? 1 : 0 }})">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-outline-danger" title="Dar de baja" onclick="darBaja({{ $emp->id }}, {{ $emp->activo ? 1 : 0 }})">
                                        <i class="bi {{ $emp->activo ? 'bi-person-x' : 'bi-person-check' }}"></i>
                                    </button>
                                    <button class="btn btn-outline-secondary" title="Ver incidencias" onclick="verIncidencias({{ $emp->id }})">
                                        <i class="bi bi-card-list"></i>
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

    <!-- Modal Crear Empleado -->
    <div class="modal fade" id="modalCrear" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold"><i class="bi bi-person-plus me-2 text-success"></i> Registrar Empleado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body pt-3">
                    <div class="alert alert-info py-2 small mb-3"><i class="bi bi-info-circle me-1"></i> Solo <strong>Matrícula</strong> y <strong>Nombre</strong> son obligatorios.</div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Matrícula <span class="text-danger">*</span></label>
                            <input type="text" id="crearMatricula" class="form-control" placeholder="Ej. EMP001">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label fw-bold">Nombre(s) <span class="text-danger">*</span></label>
                            <input type="text" id="crearNombre" class="form-control" placeholder="Nombre del empleado">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Apellido Paterno</label>
                            <input type="text" id="crearApPat" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Apellido Materno</label>
                            <input type="text" id="crearApMat" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Correo</label>
                            <input type="email" id="crearCorreo" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Teléfono</label>
                            <input type="text" id="crearTelefono" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Dirección</label>
                            <select id="crearDireccion" class="form-select">
                                <option value="">—</option>
                                @foreach($direcciones as $d)
                                <option value="{{ $d->id }}">{{ $d->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Departamento</label>
                            <select id="crearDepartamento" class="form-select">
                                <option value="">—</option>
                                @foreach($departamentos as $d)
                                <option value="{{ $d->id }}">{{ $d->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Puesto</label>
                            <select id="crearPuesto" class="form-select">
                                <option value="">—</option>
                                @foreach($puestos as $p)
                                <option value="{{ $p->id }}">{{ $p->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn text-white px-4" style="background:var(--cb-green);" onclick="guardarNuevo()">
                        <i class="bi bi-save me-1"></i> Registrar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar Empleado -->
    <div class="modal fade" id="modalEditar" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold"><i class="bi bi-pencil-square me-2 text-primary"></i> Editar Empleado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body pt-3">
                    <input type="hidden" id="editId">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Matrícula <span class="text-danger">*</span></label>
                            <input type="text" id="editMatricula" class="form-control">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label fw-bold">Nombre(s) <span class="text-danger">*</span></label>
                            <input type="text" id="editNombre" class="form-control">
                        </div>
                        <div class="col-md-6"><label class="form-label">Apellido Paterno</label><input type="text" id="editApPat" class="form-control"></div>
                        <div class="col-md-6"><label class="form-label">Apellido Materno</label><input type="text" id="editApMat" class="form-control"></div>
                        <div class="col-md-6"><label class="form-label">Correo</label><input type="email" id="editCorreo" class="form-control"></div>
                        <div class="col-md-6"><label class="form-label">Teléfono</label><input type="text" id="editTelefono" class="form-control"></div>
                        <div class="col-md-4">
                            <label class="form-label">Dirección</label>
                            <select id="editDireccion" class="form-select">
                                <option value="">—</option>
                                @foreach($direcciones as $d)
                                <option value="{{ $d->id }}">{{ $d->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Departamento</label>
                            <select id="editDepartamento" class="form-select">
                                <option value="">—</option>
                                @foreach($departamentos as $d)
                                <option value="{{ $d->id }}">{{ $d->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Puesto</label>
                            <select id="editPuesto" class="form-select">
                                <option value="">—</option>
                                @foreach($puestos as $p)
                                <option value="{{ $p->id }}">{{ $p->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="editActivo" style="width:2.5rem;height:1.3rem;">
                                <label class="form-check-label fw-semibold ms-2">Empleado Activo</label>
                            </div>
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

    <script>
        const CSRF = document.querySelector('meta[name=csrf-token]').content;
        $(document).ready(function(){ $('#empleadosTable').DataTable({ language: { url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-MX.json' }, order: [[1,'asc']] }); });
        function showToast(msg, type='success'){ const t=document.getElementById('toastMsg'); t.style.background={success:'#006039',danger:'#dc3545',warning:'#ffc107'}[type]||'#006039'; document.getElementById('toastText').textContent=msg; bootstrap.Toast.getOrCreateInstance(t,{delay:3500}).show(); }

        function abrirEditar(id, mat, nom, apPat, apMat, correo, tel, dirId, depId, puestoId, activo){
            document.getElementById('editId').value=id;
            document.getElementById('editMatricula').value=mat;
            document.getElementById('editNombre').value=nom;
            document.getElementById('editApPat').value=apPat;
            document.getElementById('editApMat').value=apMat;
            document.getElementById('editCorreo').value=correo;
            document.getElementById('editTelefono').value=tel;
            document.getElementById('editDireccion').value=dirId||'';
            document.getElementById('editDepartamento').value=depId||'';
            document.getElementById('editPuesto').value=puestoId||'';
            document.getElementById('editActivo').checked=activo==1;
            new bootstrap.Modal(document.getElementById('modalEditar')).show();
        }

        async function guardarNuevo(){
            const mat=document.getElementById('crearMatricula').value.trim(), nom=document.getElementById('crearNombre').value.trim();
            if(!mat||!nom) return showToast('Matrícula y Nombre son requeridos.','warning');
            const body={ numero_empleado:mat, nombre:nom, apellido_paterno:document.getElementById('crearApPat').value, apellido_materno:document.getElementById('crearApMat').value, correo:document.getElementById('crearCorreo').value, telefono:document.getElementById('crearTelefono').value, direccion_id:document.getElementById('crearDireccion').value||null, departamento_id:document.getElementById('crearDepartamento').value||null, puesto_id:document.getElementById('crearPuesto').value||null };
            const r=await fetch('{{ route("empleados.store") }}',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF},body:JSON.stringify(body)});
            const d=await r.json(); if(r.ok){showToast(d.message);setTimeout(()=>location.reload(),1200);}else showToast(d.message||Object.values(d.errors||{})[0]?.[0],'danger');
        }

        async function guardarEdicion(){
            const id=document.getElementById('editId').value, mat=document.getElementById('editMatricula').value.trim(), nom=document.getElementById('editNombre').value.trim();
            if(!mat||!nom) return showToast('Matrícula y Nombre son requeridos.','warning');
            const body={ numero_empleado:mat, nombre:nom, apellido_paterno:document.getElementById('editApPat').value, apellido_materno:document.getElementById('editApMat').value, correo:document.getElementById('editCorreo').value, telefono:document.getElementById('editTelefono').value, direccion_id:document.getElementById('editDireccion').value||null, departamento_id:document.getElementById('editDepartamento').value||null, puesto_id:document.getElementById('editPuesto').value||null, activo:document.getElementById('editActivo').checked?1:0 };
            const r=await fetch(`/empleados/${id}`,{method:'PUT',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF},body:JSON.stringify(body)});
            const d=await r.json(); if(r.ok){showToast(d.message);setTimeout(()=>location.reload(),1200);}else showToast(d.message||Object.values(d.errors||{})[0]?.[0],'danger');
        }

        async function darBaja(id, activo){
            const accion = activo ? 'dar de baja' : 'activar';
            if(!confirm(`¿Deseas ${accion} a este empleado?`)) return;
            const r=await fetch(`/empleados/${id}/toggle`,{method:'POST',headers:{'X-CSRF-TOKEN':CSRF}});
            const d=await r.json(); if(r.ok){showToast(d.message);setTimeout(()=>location.reload(),1200);}else showToast(d.message,'danger');
        }

        function verIncidencias(id){ window.location.href=`/incidencias?empleado=${id}`; }
    </script>
</x-app-layout>
