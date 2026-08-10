<x-app-layout>
    <x-slot name="header">
        Dashboard General
    </x-slot>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Indicadores -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100" style="background: linear-gradient(135deg, #006039 0%, #004a2c 100%); color: white;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase fw-bold opacity-75 mb-1" style="font-size: 0.8rem;">Total Empleados</h6>
                            <h2 class="mb-0 fw-bold">{{ $totalEmpleados }}</h2>
                        </div>
                        <div class="fs-1 opacity-50">
                            <i class="bi bi-people"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase fw-bold text-muted mb-1" style="font-size: 0.8rem;">Incidencias Hoy</h6>
                            <h2 class="mb-0 fw-bold text-dark">{{ $incidenciasHoy }}</h2>
                        </div>
                        <div class="fs-1 text-primary opacity-25">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase fw-bold text-muted mb-1" style="font-size: 0.8rem;">Personal en Riesgo</h6>
                            <h2 class="mb-0 fw-bold text-danger">{{ $personalRiesgo }}</h2>
                        </div>
                        <div class="fs-1 text-danger opacity-25">
                            <i class="bi bi-exclamation-triangle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase fw-bold text-muted mb-1" style="font-size: 0.8rem;">Departamentos</h6>
                            <h2 class="mb-0 fw-bold text-dark">{{ $departamentosCount }}</h2>
                        </div>
                        <div class="fs-1 text-success opacity-25">
                            <i class="bi bi-diagram-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficas -->
    <div class="row g-4 mb-4">
        <!-- Gráfica de Barras -->
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white p-2">
                <div class="card-header bg-white border-0 pt-3 pb-0">
                    <h6 class="fw-bold" style="color: var(--cb-black);">Incidencias por Departamento (Acumulado)</h6>
                </div>
                <div class="card-body">
                    @if(count($chartLabelsDepto) > 0)
                        <canvas id="deptoChart" height="100"></canvas>
                    @else
                        <div class="d-flex align-items-center justify-content-center h-100 text-muted">
                            <p class="mb-0"><i class="bi bi-info-circle me-2"></i> No hay datos suficientes para graficar.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Gráfica de Dona -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white p-2">
                <div class="card-header bg-white border-0 pt-3 pb-0">
                    <h6 class="fw-bold" style="color: var(--cb-black);">Distribución por Tipo</h6>
                </div>
                <div class="card-body d-flex justify-content-center align-items-center">
                    @if(count($chartLabelsTipos) > 0)
                        <canvas id="tipoChart"></canvas>
                    @else
                        <div class="text-muted text-center">
                            <p class="mb-0"><i class="bi bi-pie-chart me-2"></i> Sin datos.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Configuración Global Chart.js
            Chart.defaults.font.family = "'Inter', sans-serif";
            Chart.defaults.color = '#6c757d';

            // Datos inyectados desde Laravel
            const labelsDepto = {!! json_encode($chartLabelsDepto) !!};
            const dataDepto = {!! json_encode($chartDataDepto) !!};

            const labelsTipos = {!! json_encode($chartLabelsTipos) !!};
            const dataTipos = {!! json_encode($chartDataTipos) !!};

            // Colores Institucionales
            const cbGreen = '#006039';
            const cbGreenLight = 'rgba(0, 96, 57, 0.2)';
            const palette = ['#006039', '#54595F', '#1a1a1a', '#0d6efd', '#dc3545', '#ffc107', '#0dcaf0'];

            // 1. Gráfica por Departamento (Barra)
            if(document.getElementById('deptoChart')) {
                const ctxDepto = document.getElementById('deptoChart').getContext('2d');
                new Chart(ctxDepto, {
                    type: 'bar',
                    data: {
                        labels: labelsDepto,
                        datasets: [{
                            label: 'Total de Incidencias',
                            data: dataDepto,
                            backgroundColor: cbGreen,
                            borderRadius: 6,
                            maxBarThickness: 50
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: { beginAtZero: true, grid: { borderDash: [5, 5] } },
                            x: { grid: { display: false } }
                        }
                    }
                });
            }

            // 2. Gráfica por Tipo (Dona)
            if(document.getElementById('tipoChart')) {
                const ctxTipo = document.getElementById('tipoChart').getContext('2d');
                new Chart(ctxTipo, {
                    type: 'doughnut',
                    data: {
                        labels: labelsTipos,
                        datasets: [{
                            data: dataTipos,
                            backgroundColor: palette,
                            borderWidth: 0,
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 11 } } }
                        },
                        cutout: '70%'
                    }
                });
            }
        });
    </script>
</x-app-layout>
