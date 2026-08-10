<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Direccion;
use App\Models\Departamento;
use App\Models\Empleado;

class ColegioBachilleresSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear el Director (Jefe de Dirección)
        $director = Empleado::create([
            'numero_empleado' => 'DIR001',
            'nombre' => 'Eduardo',
            'apellido_paterno' => 'Carrillo',
            'apellido_materno' => 'Santillán',
        ]);

        // 2. Crear la Dirección
        $direccion = Direccion::create([
            'nombre' => 'Dirección de Administración y Servicios Escolares (DASE)',
            'jefe_id' => $director->id,
            'activo' => true
        ]);

        // Asignarle la dirección al director
        $director->update(['direccion_id' => $direccion->id]);

        // 3. Departamentos
        $departamentos = [
            'Bibliotecas',
            'Laboratorios',
            'Subdirección de Administración Escolar (SAE)',
            'Sistema de Enseñanza Abierto (SEA)',
            'EXACER'
        ];

        foreach ($departamentos as $nombreDepto) {
            Departamento::create([
                'direccion_id' => $direccion->id,
                'nombre' => $nombreDepto,
                'activo' => true
            ]);
        }
    }
}
