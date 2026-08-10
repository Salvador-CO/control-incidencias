<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        // Agrupar permisos por módulo para la UI
        $permisos = Permission::all()->groupBy(function ($p) {
            $modulos = [
                'dashboard'    => 'Dashboard',
                'incidencias'  => 'Incidencias',
                'empleados'    => 'Empleados',
                'reportes'     => 'Reportes',
                'catalogos'    => 'Catálogos',
                'usuarios'     => 'Administración',
                'roles'        => 'Administración',
            ];
            foreach ($modulos as $key => $modulo) {
                if (str_contains($p->name, $key)) return $modulo;
            }
            return 'Otros';
        });

        return view('roles.index', compact('roles', 'permisos'));
    }

    public function store(Request $request)
    {
        $request->validate(['nombre' => 'required|string|unique:roles,name']);
        $rol = Role::create(['name' => $request->nombre, 'guard_name' => 'web']);
        if ($request->filled('permisos')) {
            $rol->syncPermissions($request->permisos);
        }
        return response()->json(['message' => "Rol '{$rol->name}' creado correctamente.", 'id' => $rol->id]);
    }

    public function update(Request $request, Role $rol)
    {
        $request->validate(['nombre' => 'required|string|unique:roles,name,' . $rol->id]);
        $rol->update(['name' => $request->nombre]);
        $rol->syncPermissions($request->permisos ?? []);
        return response()->json(['message' => "Rol '{$rol->name}' actualizado correctamente."]);
    }

    public function destroy(Role $rol)
    {
        if (in_array($rol->name, ['Administrador'])) {
            return response()->json(['message' => 'El rol Administrador no puede eliminarse.'], 422);
        }
        $rol->delete();
        return response()->json(['message' => 'Rol eliminado correctamente.']);
    }
}
