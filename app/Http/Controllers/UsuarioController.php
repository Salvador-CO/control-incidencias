<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Empleado;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::with(['roles', 'empleado'])->get();
        $roles = Role::all();
        return view('usuarios.index', compact('usuarios', 'roles'));
    }

    // Busca empleados para el select2 al crear usuario
    public function buscarEmpleado(Request $request)
    {
        $q = $request->get('q', '');
        // Excluir empleados que ya tienen usuario
        $empleados = Empleado::where('activo', true)
            ->whereDoesntHave('usuario')
            ->where(function ($query) use ($q) {
                $query->where('nombre', 'like', "%{$q}%")
                    ->orWhere('apellido_paterno', 'like', "%{$q}%")
                    ->orWhere('numero_empleado', 'like', "%{$q}%");
            })
            ->limit(20)
            ->get(['id', 'numero_empleado', 'nombre', 'apellido_paterno', 'apellido_materno', 'correo']);

        return response()->json($empleados->map(fn($e) => [
            'id'       => $e->id,
            'text'     => "[{$e->numero_empleado}] {$e->nombre} {$e->apellido_paterno}",
            'nombre'   => trim("{$e->nombre} {$e->apellido_paterno} {$e->apellido_materno}"),
            'correo'   => $e->correo,
        ]));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role'     => 'required|exists:roles,name',
            'name'     => 'required|string|max:255',
        ]);

        $user = User::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            'empleado_id' => $request->empleado_id ?: null,
        ]);

        $user->assignRole($request->role);

        return response()->json(['message' => 'Usuario creado correctamente.']);
    }

    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $usuario->id,
            'role'  => 'required|exists:roles,name',
        ]);

        $usuario->update(['name' => $request->name, 'email' => $request->email]);

        if ($request->filled('password')) {
            $usuario->update(['password' => Hash::make($request->password)]);
        }

        $usuario->syncRoles([$request->role]);

        return response()->json(['message' => 'Usuario actualizado correctamente.']);
    }

    public function toggleActivo(User $usuario)
    {
        if ($usuario->id === auth()->id()) {
            return response()->json(['message' => 'No puedes desactivar tu propia cuenta.'], 422);
        }
        $usuario->update(['activo' => !$usuario->activo]);
        $estado = $usuario->activo ? 'activado' : 'desactivado';
        return response()->json(['message' => "Usuario {$estado} correctamente."]);
    }

    public function destroy(User $usuario)
    {
        if ($usuario->id === auth()->id()) {
            return response()->json(['message' => 'No puedes eliminar tu propia cuenta.'], 422);
        }
        $usuario->delete();
        return response()->json(['message' => 'Usuario eliminado correctamente.']);
    }
}
