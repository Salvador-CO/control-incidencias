<x-app-layout>
    <x-slot name="header">Catálogo de Puestos</x-slot>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center rounded-top-4">
            <h5 class="mb-0 fw-bold"><i class="bi bi-briefcase me-2 text-success"></i> Puestos</h5>
            <button class="btn text-white shadow-sm" style="background:var(--cb-green);" data-bs-toggle="modal" data-bs-target="#modalCrear">
                <i class="bi bi-plus-lg me-1"></i> Nuevo Puesto
            </button>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table id="tablaPuestos" class="table table-hover table-striped align-middle">
                    <thead class="table-light">
                        <tr><th>ID</th><th>Nombre</th><th>Estatus</th><th class="text-center">Acciones</th></tr>
                    </thead>
                    <tbody>
                        @foreach($puestos as $p)
                        <tr id="row-p-{{ $p->id }}">
                            <td class="text-muted">{{ $p->id }}</td>
                            <td class="fw-semibold">{{ $p->nombre }}</td>
                            <td><span class="badge {{ $p->activo ? 'bg-success' : 'bg-secondary' }} rounded-pill px-3">{{ $p->activo ? 'Activo' : 'Inactivo' }}</span></td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-primary" onclick="abrirEditar({{ $p->id }}, '{{ addslashes($p->nombre) }}', {{ $p->activo ? 1 : 0 }})"><i class="bi bi-pencil"></i></button>
                                    <button class="btn btn-outline-danger" onclick="eliminar({{ $p->id }})"><i class="bi bi-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Crear -->
    <div class="modal fade" id="modalCrear" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-0 pb-0"><h5 class="modal-title fw-bold"><i class="bi bi-briefcase me-2 text-success"></i> Nuevo Puesto</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body pt-3">
                    <label class="form-label fw-bold">Nombre del Puesto <span class="text-danger">*</span></label>
                    <input type="text" id="nombreCrear" class="form-control form-control-lg" placeholder="Ej. Técnico Administrativo">
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn text-white px-4" style="background:var(--cb-green);" onclick="guardarNuevo()"><i class="bi bi-save me-1"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar -->
    <div class="modal fade" id="modalEditar" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-0 pb-0"><h5 class="modal-title fw-bold"><i class="bi bi-pencil-square me-2 text-primary"></i> Editar Puesto</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body pt-3">
                    <input type="hidden" id="editId">
                    <div class="mb-3"><label class="form-label fw-bold">Nombre <span class="text-danger">*</span></label><input type="text" id="editNombre" class="form-control"></div>
                    <div class="form-check form-switch"><input class="form-check-input" type="checkbox" id="editActivo" style="width:2.5rem;height:1.3rem;"><label class="form-check-label fw-semibold ms-2">Activo</label></div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary px-4" onclick="guardarEdicion()"><i class="bi bi-check-lg me-1"></i> Actualizar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="position-fixed bottom-0 end-0 p-3" style="z-index:9999"><div id="toastMsg" class="toast align-items-center text-white border-0 shadow"><div class="d-flex"><div class="toast-body fw-semibold" id="toastText"></div><button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button></div></div></div>

    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
        const CSRF = document.querySelector('meta[name=csrf-token]').content;
        $(document).ready(function(){ $('#tablaPuestos').DataTable({ language: { url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-MX.json' } }); });
        function showToast(msg, type='success'){ const t=document.getElementById('toastMsg'); t.style.background={success:'#006039',danger:'#dc3545',warning:'#ffc107'}[type]||'#006039'; document.getElementById('toastText').textContent=msg; bootstrap.Toast.getOrCreateInstance(t,{delay:3500}).show(); }
        function abrirEditar(id,nombre,activo){ document.getElementById('editId').value=id; document.getElementById('editNombre').value=nombre; document.getElementById('editActivo').checked=activo==1; new bootstrap.Modal(document.getElementById('modalEditar')).show(); }
        async function guardarNuevo(){
            const nombre=document.getElementById('nombreCrear').value.trim(); if(!nombre) return showToast('Nombre es requerido.','warning');
            const r=await fetch('{{ route("catalogos.puestos.store") }}',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF},body:JSON.stringify({nombre})});
            const d=await r.json(); if(r.ok){showToast(d.message);setTimeout(()=>location.reload(),1200);}else showToast(d.message||Object.values(d.errors||{})[0]?.[0],'danger');
        }
        async function guardarEdicion(){
            const id=document.getElementById('editId').value; const nombre=document.getElementById('editNombre').value.trim(); const activo=document.getElementById('editActivo').checked?1:0;
            if(!nombre) return showToast('Nombre es requerido.','warning');
            const r=await fetch(`/catalogos/puestos/${id}`,{method:'PUT',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF},body:JSON.stringify({nombre,activo})});
            const d=await r.json(); if(r.ok){showToast(d.message);setTimeout(()=>location.reload(),1200);}else showToast(d.message,'danger');
        }
        async function eliminar(id){
            if(!confirm('¿Eliminar este puesto?')) return;
            const r=await fetch(`/catalogos/puestos/${id}`,{method:'DELETE',headers:{'X-CSRF-TOKEN':CSRF}});
            const d=await r.json(); if(r.ok){showToast(d.message);document.getElementById(`row-p-${id}`)?.remove();}else showToast(d.message,'danger');
        }
    </script>
</x-app-layout>
