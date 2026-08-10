<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::with(['departamento', 'puesto', 'direccion'])->get();
        $direcciones = \App\Models\Direccion::where('activo', true)->get();
        $departamentos = \App\Models\Departamento::where('activo', true)->get();
        $puestos = \App\Models\Puesto::where('activo', true)->get();
        return view('empleados.index', compact('empleados', 'direcciones', 'departamentos', 'puestos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero_empleado' => 'required|string|unique:empleados,numero_empleado',
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'nullable|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'correo' => 'nullable|email',
            'telefono' => 'nullable|string',
            'puesto_id' => 'nullable|exists:puestos,id',
            'departamento_id' => 'nullable|exists:departamentos,id',
            'direccion_id' => 'nullable|exists:direcciones,id',
        ]);

        Empleado::create($request->all());
        return response()->json(['message' => 'Empleado registrado exitosamente.']);
    }

    public function update(Request $request, Empleado $empleado)
    {
        $request->validate([
            'numero_empleado' => 'required|string|unique:empleados,numero_empleado,' . $empleado->id,
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'nullable|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'correo' => 'nullable|email',
            'telefono' => 'nullable|string',
            'puesto_id' => 'nullable|exists:puestos,id',
            'departamento_id' => 'nullable|exists:departamentos,id',
            'direccion_id' => 'nullable|exists:direcciones,id',
        ]);

        $empleado->update($request->all());
        return response()->json(['message' => 'Empleado actualizado correctamente.']);
    }

    public function toggle(Empleado $empleado)
    {
        $empleado->update(['activo' => !$empleado->activo]);
        $estado = $empleado->activo ? 'activado' : 'dado de baja';
        return response()->json(['message' => "Empleado {$estado} correctamente."]);
    }

    public function destroy(Empleado $empleado)
    {
        $empleado->delete();
        return response()->json(['message' => 'Empleado eliminado correctamente.']);
    }
}
