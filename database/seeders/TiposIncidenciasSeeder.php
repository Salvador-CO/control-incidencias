<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoIncidencia;

class TiposIncidenciasSeeder extends Seeder
{
    public function run(): void
    {
        $tipos = [
            ['nombre' => 'Omisión de Entrada', 'requiere_motivo' => false],
            ['nombre' => 'Omisión de Salida', 'requiere_motivo' => false],
            ['nombre' => 'Inasistencia', 'requiere_motivo' => false],
            ['nombre' => 'Nota Buena', 'requiere_motivo' => false],
            ['nombre' => 'Permiso Económico', 'requiere_motivo' => true],
            ['nombre' => 'Quinquenio', 'requiere_motivo' => false],
            ['nombre' => 'Retardo', 'requiere_motivo' => false],
            ['nombre' => 'Vacaciones', 'requiere_motivo' => false],
            ['nombre' => 'Incapacidad', 'requiere_motivo' => true],
            ['nombre' => 'Cambio de Horario', 'requiere_motivo' => true],
            ['nombre' => 'Comisión', 'requiere_motivo' => true],
            ['nombre' => 'Justificante', 'requiere_motivo' => true],
            ['nombre' => 'Suspensión', 'requiere_motivo' => true]
        ];

        foreach ($tipos as $tipo) {
            TipoIncidencia::firstOrCreate(['nombre' => $tipo['nombre']], array_merge($tipo, ['activo' => true]));
        }
    }
}
