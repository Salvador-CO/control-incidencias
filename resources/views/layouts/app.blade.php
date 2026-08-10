<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'CIPRO') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --cb-green: #006039;
            --cb-green-dark: #004a2c;
            --cb-gray: #54595F;
            --cb-black: #1a1a1a;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f6f9;
            overflow-x: hidden;
        }

        /* Sidebar */
        .sidebar {
            min-height: 100vh;
            background-color: var(--cb-black);
            color: white;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1040;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem 1rem;
            background-color: rgba(0, 0, 0, 0.2);
        }

        .sidebar-brand-icon {
            color: var(--cb-green);
            font-size: 1.8rem;
            margin-right: 10px;
        }

        .sidebar .nav-link {
            color: #adb5bd;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            border-radius: 8px;
            margin: 2px 12px;
            font-weight: 500;
            transition: all 0.2s;
            font-size: 0.9rem;
        }

        .sidebar .nav-link:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.07);
            transform: translateX(4px);
        }

        .sidebar .nav-link.active {
            color: white;
            background-color: var(--cb-green);
            box-shadow: 0 4px 10px rgba(0, 96, 57, 0.3);
        }

        .sidebar .nav-link i {
            font-size: 1.1rem;
            margin-right: 10px;
            min-width: 20px;
        }

        .sidebar-heading {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #495057;
            font-weight: 700;
            padding: 1rem 1.5rem 0.4rem;
        }

        .sidebar-divider {
            border-color: rgba(255, 255, 255, 0.05);
            margin: 0.5rem 1rem;
        }

        /* Navbar */
        .top-navbar {
            height: 65px;
            background: white;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.04);
            z-index: 1030;
        }

        .content-area {
            width: 100%;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
            color: var(--cb-green);
        }

        @media (max-width: 767.98px) {
            .sidebar {
                position: fixed;
                left: -260px;
                width: 260px;
            }

            .sidebar.show {
                left: 0;
            }
        }
    </style>
    @stack('styles')
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar Desktop -->
        <div class="sidebar d-none d-md-flex flex-column flex-shrink-0" style="width:260px;" id="sidebar">
            <div class="sidebar-brand">
                <i class="bi bi-shield-check sidebar-brand-icon"></i>
                <h4 class="mb-0 fw-bold text-white">CIPRO</h4>
            </div>
            <div class="overflow-auto py-2 flex-grow-1">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>

                    {{-- Catálogos: permiso específico --}}
                    @can('ver-catalogos')
                    <hr class="sidebar-divider">
                    <li class="sidebar-heading">Catálogos</li>
                    <li class="nav-item">
                        <a href="{{ route('catalogos.direcciones.index') }}" class="nav-link {{ request()->routeIs('catalogos.direcciones.*') ? 'active' : '' }}">
                            <i class="bi bi-building"></i> Direcciones
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('catalogos.departamentos.index') }}" class="nav-link {{ request()->routeIs('catalogos.departamentos.*') ? 'active' : '' }}">
                            <i class="bi bi-diagram-3"></i> Departamentos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('catalogos.puestos.index') }}" class="nav-link {{ request()->routeIs('catalogos.puestos.*') ? 'active' : '' }}">
                            <i class="bi bi-briefcase"></i> Puestos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('catalogos.tipos.index') }}" class="nav-link {{ request()->routeIs('catalogos.tipos.*') ? 'active' : '' }}">
                            <i class="bi bi-tags"></i> Tipos de Incidencia
                        </a>
                    </li>
                    @endcan

                    {{-- Personal --}}
                    @can('ver-empleados')
                    <hr class="sidebar-divider">
                    <li class="sidebar-heading">Personal</li>
                    <li class="nav-item">
                        <a href="{{ route('empleados.index') }}" class="nav-link {{ request()->routeIs('empleados.*') ? 'active' : '' }}">
                            <i class="bi bi-people"></i> Empleados
                        </a>
                    </li>
                    @endcan

                    {{-- Gestión --}}
                    <hr class="sidebar-divider">
                    <li class="sidebar-heading">Gestión</li>
                    @can('ver-incidencias')
                    <li class="nav-item">
                        <a href="{{ route('incidencias.index') }}" class="nav-link {{ request()->routeIs('incidencias.*') ? 'active' : '' }}">
                            <i class="bi bi-card-checklist"></i> Incidencias
                        </a>
                    </li>
                    @endcan
                    @can('ver-reportes')
                    <li class="nav-item">
                        <a href="{{ route('reportes.index') }}" class="nav-link {{ request()->routeIs('reportes.*') ? 'active' : '' }}">
                            <i class="bi bi-bar-chart-line"></i> Reportes
                        </a>
                    </li>
                    @endcan

                    {{-- Oficios --}}
                    @can('ver-oficios')
                    <hr class="sidebar-divider">
                    <li class="sidebar-heading">Oficios</li>
                    <li class="nav-item">
                        <a href="{{ route('oficios.index') }}" class="nav-link {{ request()->routeIs('oficios.*') ? 'active' : '' }}">
                            <i class="bi bi-envelope-paper"></i> Mis Oficios
                        </a>
                    </li>
                    @endcan
                    @can('ver-oficios-todos')
                    <li class="nav-item">
                        <a href="{{ route('admin.oficios.index') }}" class="nav-link {{ request()->routeIs('admin.oficios.index') ? 'active' : '' }}">
                            <i class="bi bi-envelope-paper-fill"></i> Todos los Oficios
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.oficios.config') }}" class="nav-link {{ request()->routeIs('admin.oficios.config') ? 'active' : '' }}">
                            <i class="bi bi-cloud-arrow-up"></i> Config OneDrive
                        </a>
                    </li>
                    @endcan

                    {{-- Administración --}}
                    @can('gestionar-usuarios')
                    <hr class="sidebar-divider">
                    <li class="sidebar-heading">Administración</li>
                    <li class="nav-item">
                        <a href="{{ route('usuarios.index') }}" class="nav-link {{ request()->routeIs('usuarios.*') ? 'active' : '' }}">
                            <i class="bi bi-person-gear"></i> Usuarios
                        </a>
                    </li>
                    @endcan
                    @can('gestionar-roles')
                    <li class="nav-item">
                        <a href="{{ route('roles.index') }}" class="nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}">
                            <i class="bi bi-shield-lock"></i> Roles y Permisos
                        </a>
                    </li>
                    @endcan
                </ul>
            </div>
        </div>

        <!-- Sidebar Mobile -->
        <div class="offcanvas offcanvas-start sidebar d-md-none" tabindex="-1" id="mobileSidebar" style="width:260px;">
            <div class="offcanvas-header sidebar-brand border-bottom border-secondary">
                <div class="d-flex align-items-center"><i class="bi bi-shield-check sidebar-brand-icon"></i>
                    <h4 class="mb-0 fw-bold text-white">CIPRO</h4>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body p-0 py-2">
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
                    @role('Administrador')
                    <hr class="sidebar-divider">
                    <li class="sidebar-heading">Catálogos</li>
                    <li class="nav-item"><a href="{{ route('catalogos.direcciones.index') }}" class="nav-link {{ request()->routeIs('catalogos.direcciones.*') ? 'active' : '' }}"><i class="bi bi-building"></i> Direcciones</a></li>
                    <li class="nav-item"><a href="{{ route('catalogos.departamentos.index') }}" class="nav-link {{ request()->routeIs('catalogos.departamentos.*') ? 'active' : '' }}"><i class="bi bi-diagram-3"></i> Departamentos</a></li>
                    <li class="nav-item"><a href="{{ route('catalogos.puestos.index') }}" class="nav-link {{ request()->routeIs('catalogos.puestos.*') ? 'active' : '' }}"><i class="bi bi-briefcase"></i> Puestos</a></li>
                    <li class="nav-item"><a href="{{ route('catalogos.tipos.index') }}" class="nav-link {{ request()->routeIs('catalogos.tipos.*') ? 'active' : '' }}"><i class="bi bi-tags"></i> Tipos de Incidencia</a></li>
                    @endrole
                    @hasanyrole('Administrador|Jefe')
                    <hr class="sidebar-divider">
                    <li class="sidebar-heading">Personal</li>
                    <li class="nav-item"><a href="{{ route('empleados.index') }}" class="nav-link {{ request()->routeIs('empleados.*') ? 'active' : '' }}"><i class="bi bi-people"></i> Empleados</a></li>
                    @endhasanyrole
                    <hr class="sidebar-divider">
                    <li class="sidebar-heading">Gestión</li>
                    <li class="nav-item"><a href="{{ route('incidencias.index') }}" class="nav-link {{ request()->routeIs('incidencias.*') ? 'active' : '' }}"><i class="bi bi-card-checklist"></i> Incidencias</a></li>
                    <li class="nav-item"><a href="{{ route('reportes.index') }}" class="nav-link {{ request()->routeIs('reportes.*') ? 'active' : '' }}"><i class="bi bi-bar-chart-line"></i> Reportes</a></li>
                    @can('ver-oficios')
                    <hr class="sidebar-divider">
                    <li class="sidebar-heading">Oficios</li>
                    <li class="nav-item"><a href="{{ route('oficios.index') }}" class="nav-link {{ request()->routeIs('oficios.*') ? 'active' : '' }}"><i class="bi bi-envelope-paper"></i> Mis Oficios</a></li>
                    @endcan
                    @can('ver-oficios-todos')
                    <li class="nav-item"><a href="{{ route('admin.oficios.index') }}" class="nav-link {{ request()->routeIs('admin.oficios.index') ? 'active' : '' }}"><i class="bi bi-envelope-paper-fill"></i> Todos los Oficios</a></li>
                    <li class="nav-item"><a href="{{ route('admin.oficios.config') }}" class="nav-link {{ request()->routeIs('admin.oficios.config') ? 'active' : '' }}"><i class="bi bi-cloud-arrow-up"></i> Config OneDrive</a></li>
                    @endcan
                    @role('Administrador')
                    <hr class="sidebar-divider">
                    <li class="sidebar-heading">Administración</li>
                    <li class="nav-item"><a href="{{ route('usuarios.index') }}" class="nav-link {{ request()->routeIs('usuarios.*') ? 'active' : '' }}"><i class="bi bi-person-gear"></i> Usuarios</a></li>
                    @endrole
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="content-area">
            <nav class="navbar navbar-expand-lg top-navbar px-3 px-md-4">
                <div class="container-fluid">
                    <div class="d-flex align-items-center">
                        <button class="btn btn-light d-md-none me-3 border-0 shadow-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
                            <i class="bi bi-list fs-5"></i>
                        </button>
                        <h5 class="mb-0 fw-bold d-md-none" style="color:var(--cb-green);">CIPRO</h5>
                    </div>
                    <div class="ms-auto d-flex align-items-center">
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center fw-semibold text-dark" href="#" role="button" data-bs-toggle="dropdown">
                                <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold me-2" style="width:35px;height:35px;background:var(--cb-green);font-size:0.85rem;">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <span class="d-none d-sm-inline">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end mt-2 p-2">
                                <li>
                                    <div class="px-3 py-2">
                                        <div class="fw-bold">{{ Auth::user()->name }}</div>
                                        <div class="text-muted small">{{ Auth::user()->getRoleNames()->first() ?? 'Sin rol' }}</div>
                                        <div class="text-muted small">{{ Auth::user()->email }}</div>
                                    </div>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item rounded" href="{{ route('profile.edit') }}"><i class="bi bi-person-gear me-2 text-muted"></i> Mi Perfil</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item rounded text-danger mt-1"><i class="bi bi-box-arrow-right me-2"></i> Cerrar Sesión</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <main class="main-content p-3 p-md-4">
                @isset($header)
                <div class="d-flex justify-content-between align-items-center pb-3 mb-4 border-bottom border-2">
                    <h1 class="h3 fw-bold mb-0 text-dark">{{ $header }}</h1>
                </div>
                @endisset

                {{-- Flash messages --}}
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show shadow-sm rounded-3" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>