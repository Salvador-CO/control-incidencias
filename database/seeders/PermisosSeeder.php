<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermisosSeeder extends Seeder
{
    public function run(): void
    {
        // Limpiar caché de permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Definir todos los permisos del sistema
        $permisos = [
            // Dashboard
            ['nombre' => 'ver-dashboard',          'modulo' => 'Dashboard'],

            // Incidencias
            ['nombre' => 'ver-incidencias',         'modulo' => 'Incidencias'],
            ['nombre' => 'crear-incidencias',       'modulo' => 'Incidencias'],
            ['nombre' => 'editar-incidencias',      'modulo' => 'Incidencias'],
            ['nombre' => 'eliminar-incidencias',    'modulo' => 'Incidencias'],

            // Empleados
            ['nombre' => 'ver-empleados',           'modulo' => 'Empleados'],
            ['nombre' => 'crear-empleados',         'modulo' => 'Empleados'],
            ['nombre' => 'editar-empleados',        'modulo' => 'Empleados'],
            ['nombre' => 'dar-baja-empleados',      'modulo' => 'Empleados'],

            // Reportes
            ['nombre' => 'ver-reportes',            'modulo' => 'Reportes'],
            ['nombre' => 'exportar-reportes',       'modulo' => 'Reportes'],

            // Catálogos
            ['nombre' => 'ver-catalogos',           'modulo' => 'Catálogos'],
            ['nombre' => 'gestionar-catalogos',     'modulo' => 'Catálogos'],

            // Usuarios y Roles (solo admins)
            ['nombre' => 'gestionar-usuarios',      'modulo' => 'Administración'],
            ['nombre' => 'gestionar-roles',         'modulo' => 'Administración'],
        ];

        foreach ($permisos as $p) {
            Permission::firstOrCreate(
                ['name' => $p['nombre'], 'guard_name' => 'web'],
                ['name' => $p['nombre'], 'guard_name' => 'web']
            );
        }

        // --- Rol Administrador: todos los permisos ---
        $admin = Role::firstOrCreate(['name' => 'Administrador', 'guard_name' => 'web']);
        $admin->syncPermissions(Permission::all());

        // --- Rol Jefe: ver todo, sin gestión de usuarios/roles/catálogos ---
        $jefe = Role::firstOrCreate(['name' => 'Jefe', 'guard_name' => 'web']);
        $jefe->syncPermissions([
            'ver-dashboard',
            'ver-incidencias', 'crear-incidencias', 'editar-incidencias',
            'ver-empleados',
            'ver-reportes', 'exportar-reportes',
        ]);

        // --- Rol Capturista: solo captura de incidencias ---
        $capturista = Role::firstOrCreate(['name' => 'Capturista', 'guard_name' => 'web']);
        $capturista->syncPermissions([
            'ver-dashboard',
            'ver-incidencias', 'crear-incidencias',
            'ver-reportes',
        ]);
    }
}
