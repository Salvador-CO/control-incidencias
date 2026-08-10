<x-app-layout>
    <x-slot name="header">
        Capturar Incidencia
    </x-slot>

    <!-- Select2 CSS for better employee search -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        .select2-container .select2-selection--single {
            height: 45px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 8px 15px;
            background-color: #f8f9fa;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 43px;
            right: 10px;
        }
    </style>

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center rounded-top-4">
            <h5 class="mb-0 fw-bold" style="color: var(--cb-black);"><i class="bi bi-file-earmark-plus me-2"></i> Nueva Incidencia</h5>
            <a href="{{ route('incidencias.index') }}" class="btn btn-outline-secondary btn-sm shadow-sm">
                <i class="bi bi-arrow-left me-1"></i> Regresar
            </a>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('incidencias.store') }}" method="POST">
                @csrf
                
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label for="empleado_id" class="form-label fw-bold">Empleado <span class="text-danger">*</span></label>
                        <select class="form-select @error('empleado_id') is-invalid @enderror" id="empleado_id" name="empleado_id" required>
                            <option value="">Buscar por Matrícula o Nombre...</option>
                            @foreach($empleados as $empleado)
                                <option value="{{ $empleado->id }}" {{ old('empleado_id') == $empleado->id ? 'selected' : '' }}>
                                    [{{ $empleado->numero_empleado }}] {{ $empleado->nombre }} {{ $empleado->apellido_paterno }}
                                </option>
                            @endforeach
                        </select>
                        @error('empleado_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="fecha" class="form-label fw-bold">Fecha de Incidencia <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('fecha') is-invalid @enderror" id="fecha" name="fecha" value="{{ old('fecha', date('Y-m-d')) }}" required>
                        @error('fecha') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label for="tipo_incidencia_id" class="form-label fw-bold">Tipo de Incidencia <span class="text-danger">*</span></label>
                        <select class="form-select @error('tipo_incidencia_id') is-invalid @enderror" id="tipo_incidencia_id" name="tipo_incidencia_id" required>
                            <option value="">Seleccione el tipo...</option>
                            @foreach($tipos as $tipo)
                                <option value="{{ $tipo->id }}" {{ old('tipo_incidencia_id') == $tipo->id ? 'selected' : '' }}>
                                    {{ $tipo->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('tipo_incidencia_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="motivo" class="form-label fw-bold">Motivo (Opcional)</label>
                        <input type="text" class="form-control" id="motivo" name="motivo" value="{{ old('motivo') }}" placeholder="Ej. Retardo por tráfico, Consulta médica...">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="observaciones" class="form-label fw-bold">Observaciones Adicionales</label>
                    <textarea class="form-control" id="observaciones" name="observaciones" rows="3" placeholder="Detalles extra si son necesarios...">{{ old('observaciones') }}</textarea>
                </div>

                <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-primary shadow-sm px-4" style="background-color: var(--cb-green); border-color: var(--cb-green);">
                        <i class="bi bi-save me-1"></i> Registrar Incidencia
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#empleado_id').select2({
                placeholder: "Buscar empleado...",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
</x-app-layout>
