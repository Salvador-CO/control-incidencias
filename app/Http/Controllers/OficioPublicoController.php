<?php

namespace App\Http\Controllers;

use App\Models\Oficio;
use App\Models\Departamento;
use Illuminate\Http\Request;
use Carbon\Carbon;

/**
 * Controlador PÚBLICO — sin autenticación requerida.
 * Gestiona el portal de oficios, la búsqueda pública y el registro público.
 */
class OficioPublicoController extends Controller
{
    /** Muestra el portal público con los dos botones. */
    public function portal()
    {
        $departamentos = Departamento::where('activo', true)
            ->whereNotNull('clave')
            ->orderBy('nombre')
            ->get();

        return view('oficios.portal', compact('departamentos'));
    }

    /** Búsqueda pública: número de oficio + nombre del registrador. */
    public function buscar(Request $request)
    {
        $request->validate([
            'numero_oficio'         => 'required|string|max:50',
            'registrado_por_nombre' => 'required|string|max:255',
        ]);

        $oficio = Oficio::with('departamento')
            ->where('numero_oficio', strtoupper(trim($request->numero_oficio)))
            ->whereRaw("LOWER(registrado_por_nombre) LIKE ?", [
                '%' . strtolower(trim($request->registrado_por_nombre)) . '%'
            ])
            ->first();

        if (! $oficio) {
            return back()
                ->withInput()
                ->with('busqueda_error', 'No se encontró ningún oficio con esos datos. Verifica el número de oficio y el nombre del registrador.');
        }

        return back()->withInput()->with('oficio_encontrado', $oficio);
    }

    /**
     * Registro público de oficio — SIN necesidad de login.
     * Devuelve JSON con el folio generado.
     */
    public function storePublico(Request $request)
    {
        $data = $request->validate([
            'departamento_id'       => 'required|exists:departamentos,id',
            'fecha_registro'        => 'required|date',
            'jefe_referencia'       => 'required|string|max:255',
            'registrado_por_nombre' => 'required|string|max:255',
            'asunto'                => 'required|string|max:500',
            'dirigido_a'            => 'required|string|max:255',
        ]);

        // Verificar que el departamento tenga clave configurada
        $departamento = Departamento::findOrFail($data['departamento_id']);
        if (! $departamento->clave) {
            return response()->json([
                'success' => false,
                'message' => 'El departamento seleccionado no tiene clave configurada. Contacta al administrador.',
            ], 422);
        }

        $anio  = Carbon::parse($data['fecha_registro'])->year;
        $folio = Oficio::siguienteNumero($data['departamento_id'], $anio);

        $oficio = Oficio::create([
            'numero_oficio'          => $folio['numeroOficio'],
            'consecutivo'            => $folio['consecutivo'],
            'anio'                   => $anio,
            'departamento_id'        => $data['departamento_id'],
            'registrado_por_user_id' => null, // registro público sin sesión
            'fecha_registro'         => $data['fecha_registro'],
            'jefe_referencia'        => $data['jefe_referencia'],
            'registrado_por_nombre'  => $data['registrado_por_nombre'],
            'asunto'                 => $data['asunto'],
            'dirigido_a'             => $data['dirigido_a'],
            'estatus'                => 'Pendiente',
        ]);

        return response()->json([
            'success'       => true,
            'message'       => 'Oficio registrado correctamente.',
            'numero_oficio' => $oficio->numero_oficio,
            'oficio'        => [
                'numero_oficio'         => $oficio->numero_oficio,
                'departamento'          => $departamento->nombre,
                'fecha_registro'        => $oficio->fecha_registro->format('d/m/Y'),
                'jefe_referencia'       => $oficio->jefe_referencia,
                'registrado_por_nombre' => $oficio->registrado_por_nombre,
                'asunto'                => $oficio->asunto,
                'dirigido_a'            => $oficio->dirigido_a,
                'estatus'               => $oficio->estatus,
            ],
        ]);
    }
}
