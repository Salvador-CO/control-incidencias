<x-app-layout>
    <x-slot name="header">
        Registrar Empleado
    </x-slot>

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center rounded-top-4">
            <h5 class="mb-0 fw-bold" style="color: var(--cb-black);"><i class="bi bi-person-plus me-2"></i> Nuevo Empleado</h5>
            <a href="{{ route('empleados.index') }}" class="btn btn-outline-secondary btn-sm shadow-sm">
                <i class="bi bi-arrow-left me-1"></i> Regresar
            </a>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('empleados.store') }}" method="POST">
                @csrf
                
                <h6 class="text-uppercase fw-bold text-muted mb-3" style="font-size: 0.8rem;">Información Básica (Obligatoria)</h6>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="numero_empleado" class="form-label fw-bold">Matrícula (No. Empleado) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('numero_empleado') is-invalid @enderror" id="numero_empleado" name="numero_empleado" value="{{ old('numero_empleado') }}" required>
                        @error('numero_empleado') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="nombre" class="form-label fw-bold">Nombre(s) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                        @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <hr class="text-secondary opacity-25">
                <h6 class="text-uppercase fw-bold text-muted mb-3 mt-4" style="font-size: 0.8rem;">Información Adicional (Opcional)</h6>
                
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
                        <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" value="{{ old('apellido_paterno') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="apellido_materno" class="form-label">Apellido Materno</label>
                        <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" value="{{ old('apellido_materno') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="correo" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="correo" name="correo" value="{{ old('correo') }}">
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label for="direccion_id" class="form-label">Dirección / Área</label>
                        <select class="form-select" id="direccion_id" name="direccion_id">
                            <option value="">Seleccione una Dirección...</option>
                            @foreach($direcciones as $dir)
                                <option value="{{ $dir->id }}">{{ $dir->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="departamento_id" class="form-label">Departamento</label>
                        <select class="form-select" id="departamento_id" name="departamento_id">
                            <option value="">Seleccione un Departamento...</option>
                            @foreach($departamentos as $depto)
                                <option value="{{ $depto->id }}">{{ $depto->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="puesto_id" class="form-label">Puesto</label>
                        <select class="form-select" id="puesto_id" name="puesto_id">
                            <option value="">Seleccione un Puesto...</option>
                            @foreach($puestos as $puesto)
                                <option value="{{ $puesto->id }}">{{ $puesto->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary shadow-sm" style="background-color: var(--cb-green); border-color: var(--cb-green);">
                        <i class="bi bi-save me-1"></i> Guardar Empleado
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
