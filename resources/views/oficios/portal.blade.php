<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Portal de Oficios — CIPRO</title>
    <meta name="description" content="Portal de consulta y registro de oficios institucionales CIPRO">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --green: #006039;
            --green-mid: #007a47;
            --green-lt: #00a86b;
            --warm-50: #f7f6f3;
            --warm-100: #eeecea;
            --warm-200: #dedad6;
            --warm-400: #a09890;
            --warm-600: #6b6460;
            --warm-800: #2e2926;
            --card-bg: rgba(255, 255, 255, 0.72);
            --card-border: rgba(0, 96, 57, 0.12);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            /* Fondo cálido grisáceo con muy sutil textura */
            background-color: #ece9e4;
            background-image:
                radial-gradient(ellipse at 0% 0%, rgba(0, 96, 57, 0.07) 0%, transparent 55%),
                radial-gradient(ellipse at 100% 100%, rgba(0, 96, 57, 0.05) 0%, transparent 55%),
                url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23006039' fill-opacity='0.025'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .portal-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* ── Header ── */
        .portal-header {
            padding: 2rem 1.5rem 1.25rem;
            text-align: center;
        }

        .portal-logo {
            display: inline-flex;
            align-items: center;
            gap: .85rem;
            margin-bottom: .5rem;
        }

        .portal-logo-icon {
            width: 54px;
            height: 54px;
            background: var(--green);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 18px rgba(0, 96, 57, .3);
        }

        .portal-logo-icon i {
            font-size: 1.6rem;
            color: #fff;
        }

        .portal-title {
            color: var(--warm-800);
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: -.5px;
        }

        .portal-subtitle {
            color: var(--warm-400);
            font-size: .75rem;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .portal-nav-link {
            color: var(--warm-400);
            font-size: .82rem;
            text-decoration: none;
            font-weight: 500;
            transition: color .2s;
        }

        .portal-nav-link:hover {
            color: var(--green);
        }

        /* ── Main ── */
        .portal-main {
            flex: 1;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: .5rem 1rem 3rem;
        }

        /* ── Card ── */
        .portal-card {
            background: var(--card-bg);
            backdrop-filter: blur(16px) saturate(1.2);
            -webkit-backdrop-filter: blur(16px) saturate(1.2);
            border: 1px solid var(--card-border);
            border-radius: 24px;
            padding: 2.25rem 2rem;
            width: 100%;
            max-width: 720px;
            box-shadow:
                0 2px 4px rgba(0, 0, 0, .04),
                0 8px 32px rgba(0, 96, 57, .08),
                0 32px 64px rgba(0, 0, 0, .06);
        }

        .portal-headline {
            text-align: center;
            margin-bottom: 1.75rem;
        }

        .portal-headline h1 {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--warm-800);
            margin-bottom: .35rem;
        }

        .portal-headline p {
            color: var(--warm-400);
            font-size: .875rem;
        }

        /* ── Tabs ── */
        .portal-tabs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: .75rem;
            margin-bottom: 1.75rem;
        }

        @media (max-width: 460px) {
            .portal-tabs {
                grid-template-columns: 1fr;
            }
        }

        .portal-tab {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: .5rem;
            padding: 1.25rem 1rem;
            border-radius: 16px;
            border: 2px solid var(--warm-200);
            cursor: pointer;
            background: var(--warm-50);
            transition: all .25s;
            user-select: none;
        }

        .portal-tab:hover {
            border-color: rgba(0, 96, 57, .3);
            background: rgba(0, 96, 57, .04);
        }

        .portal-tab.active {
            border-color: var(--green);
            background: rgba(0, 96, 57, .07);
        }

        .tab-icon {
            width: 48px;
            height: 48px;
            border-radius: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            background: var(--warm-100);
            color: var(--warm-600);
            transition: all .25s;
        }

        .portal-tab.active .tab-icon {
            background: var(--green);
            color: #fff;
        }

        .tab-label {
            font-weight: 700;
            font-size: .88rem;
            color: var(--warm-800);
        }

        .tab-desc {
            font-size: .72rem;
            color: var(--warm-400);
            text-align: center;
            line-height: 1.4;
        }

        /* ── Panel ── */
        .tab-panel {
            display: none;
        }

        .tab-panel.active {
            display: block;
            animation: fadeSlide .3s ease;
        }

        @keyframes fadeSlide {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .panel-divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .panel-divider::before,
        .panel-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--warm-200);
        }

        .panel-divider span {
            color: var(--warm-400);
            font-size: .72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            white-space: nowrap;
        }

        /* ── Form inputs ── */
        .form-floating label {
            color: var(--warm-400);
            font-size: .84rem;
        }

        .form-floating .form-control,
        .form-floating .form-select {
            background: #fff;
            border: 1.5px solid var(--warm-200);
            color: var(--warm-800);
            border-radius: 12px;
            transition: border-color .2s, box-shadow .2s;
        }

        .form-floating .form-control:focus,
        .form-floating .form-select:focus {
            border-color: var(--green);
            box-shadow: 0 0 0 3px rgba(0, 96, 57, .1);
            outline: none;
        }

        .form-floating .form-select option {
            color: var(--warm-800);
        }

        .form-floating textarea.form-control {
            min-height: 82px;
        }

        .btn-portal {
            background: var(--green);
            border: none;
            border-radius: 12px;
            color: #fff;
            font-weight: 700;
            padding: .85rem 2rem;
            width: 100%;
            font-size: .95rem;
            letter-spacing: .2px;
            transition: all .25s;
            box-shadow: 0 4px 18px rgba(0, 96, 57, .25);
            cursor: pointer;
        }

        .btn-portal:hover {
            background: var(--green-mid);
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(0, 96, 57, .35);
        }

        .btn-portal:active {
            transform: translateY(0);
        }

        /* ── Alerts ── */
        .portal-alert {
            border-radius: 12px;
            padding: .9rem 1.1rem;
            margin-bottom: 1.25rem;
            font-size: .875rem;
            display: flex;
            align-items: flex-start;
            gap: .6rem;
        }

        .alert-err {
            background: #fdf3f3;
            border: 1px solid #f5c6c6;
            color: #842029;
        }

        .alert-ok {
            background: #f0f8f4;
            border: 1px solid #c3e6cb;
            color: #155724;
        }

        /* ── Éxito: pantalla de folio ── */
        .success-screen {
            text-align: center;
            animation: fadeSlide .4s ease;
        }

        .success-icon {
            width: 72px;
            height: 72px;
            background: #f0f8f4;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: var(--green);
            margin: 0 auto 1.25rem;
            border: 2px solid #c3e6cb;
        }

        .success-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--warm-600);
            margin-bottom: .75rem;
        }

        /* Folio grande */
        .folio-card {
            background: linear-gradient(135deg, var(--green) 0%, var(--green-mid) 100%);
            border-radius: 20px;
            padding: 2rem 1.5rem;
            margin: 0 auto 1.5rem;
            max-width: 420px;
            box-shadow: 0 8px 32px rgba(0, 96, 57, .3);
            position: relative;
            overflow: hidden;
        }

        .folio-card::before {
            content: '';
            position: absolute;
            top: -30px;
            right: -30px;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .08);
        }

        .folio-card::after {
            content: '';
            position: absolute;
            bottom: -20px;
            left: -20px;
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .06);
        }

        .folio-label-text {
            font-size: .72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: rgba(255, 255, 255, .65);
            margin-bottom: .5rem;
        }

        .folio-number {
            font-size: 2.8rem;
            font-weight: 800;
            color: #fff;
            letter-spacing: 1px;
            font-family: 'Courier New', 'Courier', monospace;
            line-height: 1;
            margin-bottom: .75rem;
        }

        .folio-depto {
            font-size: .82rem;
            color: rgba(255, 255, 255, .7);
            font-weight: 500;
        }

        .folio-nota {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            background: rgba(255, 255, 255, .15);
            border-radius: 50px;
            padding: .35rem .85rem;
            font-size: .75rem;
            color: rgba(255, 255, 255, .9);
            font-weight: 600;
            margin-top: .75rem;
        }

        /* Detalles del oficio registrado */
        .oficio-details {
            background: var(--warm-50);
            border: 1px solid var(--warm-200);
            border-radius: 16px;
            padding: 1.25rem 1.5rem;
            text-align: left;
            margin-bottom: 1.5rem;
        }

        .oficio-details .detail-row {
            display: flex;
            flex-direction: column;
            gap: .1rem;
            padding: .55rem 0;
            border-bottom: 1px solid var(--warm-100);
        }

        .oficio-details .detail-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .oficio-details .detail-row:first-child {
            padding-top: 0;
        }

        .detail-label {
            font-size: .68rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--warm-400);
            font-weight: 700;
        }

        .detail-value {
            font-size: .875rem;
            color: var(--warm-800);
            font-weight: 500;
        }

        .btn-nuevo {
            background: var(--warm-100);
            border: 1.5px solid var(--warm-200);
            border-radius: 12px;
            color: var(--warm-600);
            font-weight: 600;
            padding: .75rem 2rem;
            width: 100%;
            font-size: .9rem;
            transition: all .2s;
            cursor: pointer;
        }

        .btn-nuevo:hover {
            background: var(--warm-200);
            color: var(--warm-800);
        }

        /* ── Resultado búsqueda ── */
        .result-card {
            background: var(--warm-50);
            border: 1px solid var(--warm-200);
            border-radius: 16px;
            padding: 1.5rem;
            margin-top: 1.25rem;
        }

        .result-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.25rem;
            flex-wrap: wrap;
            gap: .5rem;
        }

        .result-folio {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--green);
            font-family: 'Courier New', monospace;
        }

        .status-badge {
            padding: .35rem .9rem;
            border-radius: 50px;
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .5px;
            display: inline-flex;
            align-items: center;
            gap: .3rem;
        }

        .badge-pendiente {
            background: #fff9e6;
            color: #856404;
            border: 1px solid #ffc10750;
        }

        .badge-entregado {
            background: #f0f8f4;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .badge-cancelado {
            background: #fdf3f3;
            color: #842029;
            border: 1px solid #f5c6c6;
        }

        .result-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: .65rem 1.5rem;
        }

        @media (max-width: 460px) {
            .result-grid {
                grid-template-columns: 1fr;
            }
        }

        .result-item label {
            font-size: .68rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--warm-400);
            font-weight: 700;
            display: block;
            margin-bottom: .15rem;
        }

        .result-item span {
            font-size: .875rem;
            color: var(--warm-800);
            font-weight: 500;
        }

        .result-item.full {
            grid-column: 1/-1;
        }

        .result-acuse-link {
            color: var(--green);
            font-weight: 600;
            font-size: .875rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: .35rem;
        }

        .result-acuse-link:hover {
            color: var(--green-mid);
        }

        /* ── Footer ── */
        .portal-footer {
            text-align: center;
            padding: 1.5rem;
            color: var(--warm-400);
            font-size: .75rem;
        }
    </style>
</head>

<body>
    <div class="portal-wrapper">

        {{-- Header --}}
        <div class="portal-header">
            <div class="portal-logo">
                <div class="portal-logo-icon">
                    <i class="bi bi-envelope-paper"></i>
                </div>
                <div style="text-align:left;">
                    <div class="portal-title">CIPRO</div>
                    <div class="portal-subtitle">Control de Oficios</div>
                </div>
            </div>
            <div class="mt-2">
                @auth
                <a href="{{ route('oficios.index') }}" class="portal-nav-link">
                    <i class="bi bi-arrow-left-short"></i> Ir al sistema
                </a>
                @else
                <a href="{{ route('login') }}" class="portal-nav-link">
                    <i class="bi bi-box-arrow-in-right"></i> Iniciar sesión
                </a>
                @endauth
            </div>
        </div>

        {{-- Main --}}
        <div class="portal-main">
            <div class="portal-card">

                <div class="portal-headline">
                    <h1>Portal de Oficios</h1>
                    <p>Registra un oficio o consulta el estado de uno existente</p>
                </div>

                {{-- Tabs --}}
                <div class="portal-tabs">
                    <div class="portal-tab active" id="tab-registrar" onclick="switchTab('registrar')">
                        <div class="tab-icon"><i class="bi bi-plus-circle"></i></div>
                        <div class="tab-label">Registrar Oficio</div>
                        <div class="tab-desc">Captura un oficio sin iniciar sesión</div>
                    </div>
                    <div class="portal-tab" id="tab-buscar" onclick="switchTab('buscar')">
                        <div class="tab-icon"><i class="bi bi-search"></i></div>
                        <div class="tab-label">Buscar Oficio</div>
                        <div class="tab-desc">Consulta el estatus de tu oficio</div>
                    </div>
                </div>

                {{-- ═══ Panel: Registrar ═══ --}}
                <div class="tab-panel active" id="panel-registrar">
                    <div class="panel-divider"><span>Nuevo oficio</span></div>

                    {{-- Alerta de error --}}
                    <div id="alertRegistrar"></div>

                    {{-- Formulario --}}
                    <div id="wrapForm">
                        <form id="formRegistrar" novalidate>
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" id="fDepto" name="departamento_id" required>
                                            <option value="">Seleccionar...</option>
                                            @foreach($departamentos as $d)
                                            <option value="{{ $d->id }}">{{ $d->nombre }} ({{ $d->clave }})</option>
                                            @endforeach
                                        </select>
                                        <label for="fDepto"><i class="bi bi-diagram-3 me-1"></i> Departamento</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="fFecha" name="fecha_registro"
                                            value="{{ now()->toDateString() }}" required>
                                        <label for="fFecha">Fecha de registro</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="fJefeRef" name="jefe_referencia"
                                            placeholder="Jefe referencia" required>
                                        <label for="fJefeRef"><i class="bi bi-person-badge me-1"></i> Jefe / Subdirector que necesita la referencia</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="fRegistrador" name="registrado_por_nombre"
                                            placeholder="Tu nombre" required>
                                        <label for="fRegistrador"><i class="bi bi-person me-1"></i> Nombre de quien registra</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" id="fAsunto" name="asunto"
                                            placeholder="Asunto" required style="height:90px;"></textarea>
                                        <label for="fAsunto"><i class="bi bi-file-text me-1"></i> Asunto (como aparece en el oficio)</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="fDirigidoA" name="dirigido_a"
                                            placeholder="Dirigido a" required>
                                        <label for="fDirigidoA"><i class="bi bi-person-lines-fill me-1"></i> Dirigido a (nombre + institución si es externo)</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="button" class="btn-portal" id="btnRegistrar">
                                        <span class="spinner-border spinner-border-sm me-2 d-none" id="spinnerRegistrar"></span>
                                        <i class="bi bi-send me-2" id="iconRegistrar"></i>Registrar Oficio
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- Pantalla de éxito (oculta hasta que se registra) --}}
                    <div id="wrapSuccess" style="display:none;">
                        <div class="success-screen">
                            <div class="success-icon">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            <div class="success-title">¡Oficio registrado correctamente!</div>

                            {{-- Folio destacado --}}
                            <div class="folio-card" id="folioCard">
                                <div class="folio-label-text">Número de Oficio</div>
                                <div class="folio-number" id="folioNumero">—</div>
                                <div class="folio-depto" id="folioDepto">—</div>
                                <div class="folio-nota">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    Anota este número — lo necesitarás para consultar tu oficio
                                </div>
                            </div>

                            {{-- Detalles confirmados --}}
                            <div class="oficio-details" id="oficioDetalles"></div>

                            {{-- Botón para registrar otro --}}
                            <button type="button" class="btn-nuevo" onclick="nuevoRegistro()">
                                <i class="bi bi-plus-lg me-1"></i>Registrar otro oficio
                            </button>
                        </div>
                    </div>
                </div>

                {{-- ═══ Panel: Buscar ═══ --}}
                <div class="tab-panel" id="panel-buscar">
                    <div class="panel-divider"><span>Consultar estatus</span></div>

                    @if(session('busqueda_error'))
                    <div class="portal-alert alert-err">
                        <i class="bi bi-exclamation-circle-fill flex-shrink-0 mt-1"></i>
                        <div>{{ session('busqueda_error') }}</div>
                    </div>
                    @endif

                    <form action="{{ route('oficios.buscar') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control"
                                        id="numero_oficio" name="numero_oficio"
                                        placeholder="DASE/283/2026"
                                        value="{{ old('numero_oficio') }}"
                                        autocomplete="off" style="text-transform:uppercase;">
                                    <label for="numero_oficio"><i class="bi bi-hash me-1"></i> Número de Oficio (ej. DASE/283/2026)</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control"
                                        id="registrado_por_nombre" name="registrado_por_nombre"
                                        placeholder="Nombre"
                                        value="{{ old('registrado_por_nombre') }}"
                                        autocomplete="off">
                                    <label for="registrado_por_nombre"><i class="bi bi-person me-1"></i> Nombre de quien registró</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn-portal">
                                    <i class="bi bi-search me-2"></i>Buscar Oficio
                                </button>
                            </div>
                        </div>
                    </form>

                    {{-- Resultado de búsqueda --}}
                    @if(session('oficio_encontrado'))
                    @php $o = session('oficio_encontrado'); @endphp
                    <div class="result-card">
                        <div class="result-header">
                            <div class="result-folio">{{ $o->numero_oficio }}</div>
                            @php
                            $cls = match($o->estatus) { 'Entregado'=>'badge-entregado', 'Cancelado'=>'badge-cancelado', default=>'badge-pendiente' };
                            $icon = match($o->estatus) { 'Entregado'=>'check-circle-fill', 'Cancelado'=>'x-circle-fill', default=>'clock-fill' };
                            @endphp
                            <span class="status-badge {{ $cls }}">
                                <i class="bi bi-{{ $icon }}"></i>{{ $o->estatus }}
                            </span>
                        </div>
                        <div class="result-grid">
                            <div class="result-item">
                                <label>Departamento</label>
                                <span>{{ optional($o->departamento)->nombre ?? '—' }}</span>
                            </div>
                            <div class="result-item">
                                <label>Fecha de Registro</label>
                                <span>{{ $o->fecha_registro?->format('d/m/Y') ?? '—' }}</span>
                            </div>
                            <div class="result-item">
                                <label>Registrado por</label>
                                <span>{{ $o->registrado_por_nombre }}</span>
                            </div>
                            <div class="result-item">
                                <label>Jefe / Referencia</label>
                                <span>{{ $o->jefe_referencia }}</span>
                            </div>
                            <div class="result-item full">
                                <label>Asunto</label>
                                <span>{{ $o->asunto }}</span>
                            </div>
                            <div class="result-item full">
                                <label>Dirigido a</label>
                                <span>{{ $o->dirigido_a }}</span>
                            </div>
                            @if($o->acuse_url)
                            <div class="result-item full">
                                <label>Acuse</label>
                                <a href="{{ $o->acuse_url }}" target="_blank" rel="noopener" class="result-acuse-link">
                                    <i class="bi bi-file-earmark-check-fill"></i>
                                    {{ $o->acuse_nombre ?? 'Ver acuse' }}
                                    <i class="bi bi-box-arrow-up-right" style="font-size:.65rem;"></i>
                                </a>
                            </div>
                            @endif
                            @if($o->estatus === 'Cancelado' && $o->motivo_cancelacion)
                            <div class="result-item full">
                                <label>Motivo de cancelación</label>
                                <span>{{ $o->motivo_cancelacion }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>

            </div>{{-- /portal-card --}}
        </div>{{-- /portal-main --}}

        <div class="portal-footer">
            &copy; {{ date('Y') }} CIPRO &mdash; Control de Incidencias del Personal y Registro de Oficios
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const CSRF = document.querySelector('meta[name="csrf-token"]').content;

        // Si hay resultado de búsqueda, abrir tab buscar
        @if(session('oficio_encontrado') || session('busqueda_error') || $errors - > any())
        switchTab('buscar');
        @endif

        function switchTab(tab) {
            document.querySelectorAll('.portal-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
            document.getElementById('tab-' + tab).classList.add('active');
            document.getElementById('panel-' + tab).classList.add('active');
        }

        function showAlert(id, msg, type = 'err') {
            document.getElementById(id).innerHTML =
                `<div class="portal-alert alert-${type}">
            <i class="bi bi-${type === 'ok' ? 'check-circle-fill' : 'exclamation-circle-fill'} flex-shrink-0 mt-1"></i>
            <div>${msg}</div>
        </div>`;
        }

        // Registro
        document.getElementById('btnRegistrar').addEventListener('click', async function() {
            document.getElementById('alertRegistrar').innerHTML = '';

            const depto = document.getElementById('fDepto').value;
            const fecha = document.getElementById('fFecha').value;
            const jefeRef = document.getElementById('fJefeRef').value.trim();
            const regPor = document.getElementById('fRegistrador').value.trim();
            const asunto = document.getElementById('fAsunto').value.trim();
            const dirigido = document.getElementById('fDirigidoA').value.trim();

            if (!depto || !fecha || !jefeRef || !regPor || !asunto || !dirigido) {
                showAlert('alertRegistrar', 'Por favor completa todos los campos requeridos.');
                return;
            }

            const spinner = document.getElementById('spinnerRegistrar');
            const icon = document.getElementById('iconRegistrar');
            spinner.classList.remove('d-none');
            icon.classList.add('d-none');
            this.disabled = true;

            const data = new FormData(document.getElementById('formRegistrar'));

            try {
                const res = await fetch('{{ route("oficios.store-publico") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': CSRF,
                        'Accept': 'application/json'
                    },
                    body: data,
                });
                const json = await res.json();

                if (!res.ok || !json.success) throw new Error(json.message || 'Error al registrar.');

                const o = json.oficio;

                // Llenar pantalla de éxito
                document.getElementById('folioNumero').textContent = o.numero_oficio;
                document.getElementById('folioDepto').textContent = o.departamento + ' — ' + o.fecha_registro;

                document.getElementById('oficioDetalles').innerHTML = `
            <div class="detail-row"><div class="detail-label">Jefe / Referencia</div><div class="detail-value">${o.jefe_referencia}</div></div>
            <div class="detail-row"><div class="detail-label">Registrado por</div><div class="detail-value">${o.registrado_por_nombre}</div></div>
            <div class="detail-row"><div class="detail-label">Asunto</div><div class="detail-value">${o.asunto}</div></div>
            <div class="detail-row"><div class="detail-label">Dirigido a</div><div class="detail-value">${o.dirigido_a}</div></div>
        `;

                // Ocultar form, mostrar éxito con transición suave
                const wrapForm = document.getElementById('wrapForm');
                wrapForm.style.transition = 'opacity .3s';
                wrapForm.style.opacity = '0';
                setTimeout(() => {
                    wrapForm.style.display = 'none';
                    const wrapSuccess = document.getElementById('wrapSuccess');
                    wrapSuccess.style.display = 'block';
                    // Scroll al número de oficio
                    document.getElementById('folioCard').scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }, 300);

            } catch (e) {
                showAlert('alertRegistrar', e.message);
                spinner.classList.add('d-none');
                icon.classList.remove('d-none');
                this.disabled = false;
            }
        });

        function nuevoRegistro() {
            // Limpiar y volver al formulario
            document.getElementById('formRegistrar').reset();
            document.getElementById('fFecha').value = '{{ now()->toDateString() }}';
            document.getElementById('alertRegistrar').innerHTML = '';
            document.getElementById('wrapSuccess').style.display = 'none';
            const wrapForm = document.getElementById('wrapForm');
            wrapForm.style.display = 'block';
            wrapForm.style.opacity = '0';
            wrapForm.style.transition = 'opacity .35s';
            requestAnimationFrame(() => {
                wrapForm.style.opacity = '1';
            });
            document.getElementById('spinnerRegistrar').classList.add('d-none');
            document.getElementById('iconRegistrar').classList.remove('d-none');
            document.getElementById('btnRegistrar').disabled = false;
            document.getElementById('panel-registrar').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    </script>
</body>

</html>