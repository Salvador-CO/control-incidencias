<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CIPRO') }} - Iniciar Sesión</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --cb-green: #006039;
            --cb-gray: #54595F;
            --cb-black: #1a1a1a;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e9f2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 420px;
        }

        .brand-section {
            text-align: center;
            margin-bottom: 2rem;
        }

        .brand-icon {
            font-size: 3.5rem;
            color: var(--cb-green);
            margin-bottom: 10px;
            text-shadow: 0 4px 10px rgba(0, 96, 57, 0.2);
        }

        .brand-title {
            font-weight: 800;
            color: var(--cb-black);
            letter-spacing: -0.5px;
            font-size: 2.2rem;
            margin: 0;
        }

        .brand-subtitle {
            color: var(--cb-gray);
            font-size: 1rem;
            font-weight: 500;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
            padding: 2.5rem;
        }

        .btn-primary {
            background-color: var(--cb-green);
            border-color: var(--cb-green);
            font-weight: 600;
            padding: 12px;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: #004a2c;
            border-color: #004a2c;
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(0, 96, 57, 0.25);
        }

        .form-control {
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            background-color: #f8f9fa;
        }

        .input-group-text {
            border-radius: 8px 0 0 8px;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(0, 96, 57, 0.25);
            border-color: var(--cb-green);
            background-color: #fff;
        }

        .form-control.border-start-0 {
            border-radius: 0 8px 8px 0;
        }

        .form-label {
            font-weight: 600;
            color: var(--cb-gray);
            font-size: 0.9rem;
        }

        .form-check-input:checked {
            background-color: var(--cb-green);
            border-color: var(--cb-green);
        }
    </style>
</head>

<body>
    <div class="login-wrapper">
        <div class="brand-section">
            <i class="bi bi-shield-check brand-icon"></i>
            <h1 class="brand-title">CIPRO</h1>
            <p class="brand-subtitle mt-1">Colegio de Bachilleres</p>
        </div>

        <div class="login-card">
            {{ $slot }}
        </div>

        <div class="text-center mt-4">
            <small class="text-muted" style="font-weight: 500; font-size: 0.775em;">&copy; {{ date('Y') }} Control de Incidencias del Personal y Registro de Oficios</small>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>