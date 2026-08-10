<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Direccion;
use App\Models\Departamento;
use App\Models\Puesto;
use App\Models\TipoIncidencia;

class CatalogoController extends Controller
{
    // ===================== DIRECCIONES =====================
    public function direccionesIndex()
    {
        $direcciones = Direccion::all();
        return view('catalogos.direcciones', compact('direcciones'));
    }

    public function direccionesStore(Request $request)
    {
        $request->validate(['nombre' => 'required|string|max:255|unique:direcciones,nombre']);
        Direccion::create(['nombre' => $request->nombre, 'activo' => true]);
        return response()->json(['message' => 'Dirección creada correctamente.']);
    }

    public function direccionesUpdate(Request $request, Direccion $direccion)
    {
        $request->validate(['nombre' => 'required|string|max:255|unique:direcciones,nombre,' . $direccion->id]);
        $direccion->update($request->only('nombre', 'activo'));
        return response()->json(['message' => 'Dirección actualizada correctamente.']);
    }

    public function direccionesDestroy(Direccion $direccion)
    {
        if ($direccion->departamentos()->count() > 0) {
            return response()->json(['message' => 'No se puede eliminar: tiene departamentos asociados.'], 422);
        }
        $direccion->delete();
        return response()->json(['message' => 'Dirección eliminada correctamente.']);
    }

    // ===================== DEPARTAMENTOS =====================
    public function departamentosIndex()
    {
        $departamentos = Departamento::with('direccion')->get();
        $direcciones = Direccion::where('activo', true)->get();
        return view('catalogos.departamentos', compact('departamentos', 'direcciones'));
    }

    public function departamentosStore(Request $request)
    {
        $request->validate([
            'nombre'       => 'required|string|max:255',
            'clave'        => 'nullable|string|max:20|unique:departamentos,clave',
            'direccion_id' => 'required|exists:direcciones,id'
        ]);
        Departamento::create([
            'nombre'       => $request->nombre,
            'clave'        => $request->clave ? strtoupper(trim($request->clave)) : null,
            'direccion_id' => $request->direccion_id,
            'activo'       => true,
        ]);
        return response()->json(['message' => 'Departamento creado correctamente.']);
    }

    public function departamentosUpdate(Request $request, Departamento $departamento)
    {
        $request->validate([
            'nombre'       => 'required|string|max:255',
            'clave'        => 'nullable|string|max:20|unique:departamentos,clave,' . $departamento->id,
            'direccion_id' => 'required|exists:direcciones,id'
        ]);
        $departamento->update(array_merge(
            $request->only('nombre', 'direccion_id', 'activo'),
            ['clave' => $request->clave ? strtoupper(trim($request->clave)) : null]
        ));
        return response()->json(['message' => 'Departamento actualizado correctamente.']);
    }

    public function departamentosDestroy(Departamento $departamento)
    {
        $departamento->delete();
        return response()->json(['message' => 'Departamento eliminado correctamente.']);
    }

    // ===================== PUESTOS =====================
    public function puestosIndex()
    {
        $puestos = Puesto::all();
        return view('catalogos.puestos', compact('puestos'));
    }

    public function puestosStore(Request $request)
    {
        $request->validate(['nombre' => 'required|string|max:255|unique:puestos,nombre']);
        Puesto::create(['nombre' => $request->nombre, 'activo' => true]);
        return response()->json(['message' => 'Puesto creado correctamente.']);
    }

    public function puestosUpdate(Request $request, Puesto $puesto)
    {
        $request->validate(['nombre' => 'required|string|max:255|unique:puestos,nombre,' . $puesto->id]);
        $puesto->update($request->only('nombre', 'activo'));
        return response()->json(['message' => 'Puesto actualizado correctamente.']);
    }

    public function puestosDestroy(Puesto $puesto)
    {
        $puesto->delete();
        return response()->json(['message' => 'Puesto eliminado correctamente.']);
    }

    // ===================== TIPOS DE INCIDENCIAS =====================
    public function tiposIndex()
    {
        $tipos = TipoIncidencia::all();
        return view('catalogos.tipos', compact('tipos'));
    }

    public function tiposStore(Request $request)
    {
        $request->validate(['nombre' => 'required|string|max:255|unique:tipo_incidencias,nombre']);
        TipoIncidencia::create(['nombre' => $request->nombre, 'activo' => true]);
        return response()->json(['message' => 'Tipo de incidencia creado correctamente.']);
    }

    public function tiposUpdate(Request $request, TipoIncidencia $tipo)
    {
        $request->validate(['nombre' => 'required|string|max:255|unique:tipo_incidencias,nombre,' . $tipo->id]);
        $tipo->update($request->only('nombre', 'activo'));
        return response()->json(['message' => 'Tipo de incidencia actualizado correctamente.']);
    }

    public function tiposDestroy(TipoIncidencia $tipo)
    {
        $tipo->delete();
        return response()->json(['message' => 'Tipo de incidencia eliminado correctamente.']);
    }
}
