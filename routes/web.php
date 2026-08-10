<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// ── Portal Público de Oficios (sin auth) ─────────────────────────────────
Route::get('/oficios', [\App\Http\Controllers\OficioPublicoController::class, 'portal'])->name('oficios.portal');
Route::post('/oficios/buscar', [\App\Http\Controllers\OficioPublicoController::class, 'buscar'])->name('oficios.buscar');
Route::post('/oficios/registrar', [\App\Http\Controllers\OficioPublicoController::class, 'storePublico'])->name('oficios.store-publico');

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ── Empleados ─────────────────────────────────
    Route::get('empleados', [\App\Http\Controllers\EmpleadoController::class, 'index'])->name('empleados.index');
    Route::post('empleados', [\App\Http\Controllers\EmpleadoController::class, 'store'])->name('empleados.store');
    Route::put('empleados/{empleado}', [\App\Http\Controllers\EmpleadoController::class, 'update'])->name('empleados.update');
    Route::post('empleados/{empleado}/toggle', [\App\Http\Controllers\EmpleadoController::class, 'toggle'])->name('empleados.toggle');
    Route::delete('empleados/{empleado}', [\App\Http\Controllers\EmpleadoController::class, 'destroy'])->name('empleados.destroy');

    // ── Incidencias ───────────────────────────────
    Route::post('incidencias/entregar-departamento', [\App\Http\Controllers\IncidenciaController::class, 'entregarDepartamento'])->name('incidencias.entregar-departamento');
    Route::post('incidencias/{incidencia}/entregar', [\App\Http\Controllers\IncidenciaController::class, 'entregar'])->name('incidencias.entregar');
    Route::resource('incidencias', \App\Http\Controllers\IncidenciaController::class);

    // ── Reportes ──────────────────────────────────
    Route::get('reportes', [\App\Http\Controllers\ReporteController::class, 'index'])->name('reportes.index');
    Route::get('reportes/datos', [\App\Http\Controllers\ReporteController::class, 'datos'])->name('reportes.datos');
    Route::post('reportes/export/pdf', [\App\Http\Controllers\ReporteController::class, 'exportPdf'])->name('reportes.pdf');
    Route::post('reportes/export/excel', [\App\Http\Controllers\ReporteController::class, 'exportExcel'])->name('reportes.excel');

    // ── Oficios (Asistente y Admin) ───────────────
    Route::get('mis-oficios', [\App\Http\Controllers\OficioController::class, 'index'])
        ->middleware('permission:ver-oficios')->name('oficios.index');
    Route::post('mis-oficios', [\App\Http\Controllers\OficioController::class, 'store'])
        ->middleware('permission:crear-oficios')->name('oficios.store');
    Route::get('mis-oficios/{oficio}', [\App\Http\Controllers\OficioController::class, 'show'])
        ->name('oficios.show');
    Route::patch('mis-oficios/{oficio}/cancelar', [\App\Http\Controllers\OficioController::class, 'cancelar'])
        ->middleware('permission:cancelar-oficios')->name('oficios.cancelar');
    Route::patch('mis-oficios/{oficio}/acuse', [\App\Http\Controllers\OficioController::class, 'subirAcuse'])
        ->name('oficios.acuse');

    // ── Catálogos (solo Administrador) ────────────
    Route::middleware('role:Administrador')->group(function () {
        // Direcciones
        Route::get('catalogos/direcciones', [\App\Http\Controllers\CatalogoController::class, 'direccionesIndex'])->name('catalogos.direcciones.index');
        Route::post('catalogos/direcciones', [\App\Http\Controllers\CatalogoController::class, 'direccionesStore'])->name('catalogos.direcciones.store');
        Route::put('catalogos/direcciones/{direccion}', [\App\Http\Controllers\CatalogoController::class, 'direccionesUpdate'])->name('catalogos.direcciones.update');
        Route::delete('catalogos/direcciones/{direccion}', [\App\Http\Controllers\CatalogoController::class, 'direccionesDestroy'])->name('catalogos.direcciones.destroy');

        // Departamentos
        Route::get('catalogos/departamentos', [\App\Http\Controllers\CatalogoController::class, 'departamentosIndex'])->name('catalogos.departamentos.index');
        Route::post('catalogos/departamentos', [\App\Http\Controllers\CatalogoController::class, 'departamentosStore'])->name('catalogos.departamentos.store');
        Route::put('catalogos/departamentos/{departamento}', [\App\Http\Controllers\CatalogoController::class, 'departamentosUpdate'])->name('catalogos.departamentos.update');
        Route::delete('catalogos/departamentos/{departamento}', [\App\Http\Controllers\CatalogoController::class, 'departamentosDestroy'])->name('catalogos.departamentos.destroy');

        // Puestos
        Route::get('catalogos/puestos', [\App\Http\Controllers\CatalogoController::class, 'puestosIndex'])->name('catalogos.puestos.index');
        Route::post('catalogos/puestos', [\App\Http\Controllers\CatalogoController::class, 'puestosStore'])->name('catalogos.puestos.store');
        Route::put('catalogos/puestos/{puesto}', [\App\Http\Controllers\CatalogoController::class, 'puestosUpdate'])->name('catalogos.puestos.update');
        Route::delete('catalogos/puestos/{puesto}', [\App\Http\Controllers\CatalogoController::class, 'puestosDestroy'])->name('catalogos.puestos.destroy');

        // Tipos de Incidencias
        Route::get('catalogos/tipos', [\App\Http\Controllers\CatalogoController::class, 'tiposIndex'])->name('catalogos.tipos.index');
        Route::post('catalogos/tipos', [\App\Http\Controllers\CatalogoController::class, 'tiposStore'])->name('catalogos.tipos.store');
        Route::put('catalogos/tipos/{tipo}', [\App\Http\Controllers\CatalogoController::class, 'tiposUpdate'])->name('catalogos.tipos.update');
        Route::delete('catalogos/tipos/{tipo}', [\App\Http\Controllers\CatalogoController::class, 'tiposDestroy'])->name('catalogos.tipos.destroy');

        // Usuarios
        Route::get('usuarios', [\App\Http\Controllers\UsuarioController::class, 'index'])->name('usuarios.index');
        Route::get('usuarios/buscar-empleado', [\App\Http\Controllers\UsuarioController::class, 'buscarEmpleado'])->name('usuarios.buscar-empleado');
        Route::post('usuarios', [\App\Http\Controllers\UsuarioController::class, 'store'])->name('usuarios.store');
        Route::put('usuarios/{usuario}', [\App\Http\Controllers\UsuarioController::class, 'update'])->name('usuarios.update');
        Route::post('usuarios/{usuario}/toggle', [\App\Http\Controllers\UsuarioController::class, 'toggleActivo'])->name('usuarios.toggle');
        Route::delete('usuarios/{usuario}', [\App\Http\Controllers\UsuarioController::class, 'destroy'])->name('usuarios.destroy');

        // Roles y Permisos
        Route::get('roles', [\App\Http\Controllers\RolController::class, 'index'])->name('roles.index');
        Route::post('roles', [\App\Http\Controllers\RolController::class, 'store'])->name('roles.store');
        Route::put('roles/{rol}', [\App\Http\Controllers\RolController::class, 'update'])->name('roles.update');
        Route::delete('roles/{rol}', [\App\Http\Controllers\RolController::class, 'destroy'])->name('roles.destroy');

        // Oficios Admin (vista global + configuración OneDrive)
        Route::get('admin/oficios', [\App\Http\Controllers\OficioAdminController::class, 'globalIndex'])->name('admin.oficios.index');
        Route::get('admin/oficios/config', [\App\Http\Controllers\OficioAdminController::class, 'configIndex'])->name('admin.oficios.config');
        Route::post('admin/oficios/config', [\App\Http\Controllers\OficioAdminController::class, 'configStore'])->name('admin.oficios.config.store');
        Route::put('admin/oficios/config/{config}', [\App\Http\Controllers\OficioAdminController::class, 'configUpdate'])->name('admin.oficios.config.update');
        Route::delete('admin/oficios/config/{config}', [\App\Http\Controllers\OficioAdminController::class, 'configDestroy'])->name('admin.oficios.config.destroy');
    });
});

require __DIR__.'/auth.php';
