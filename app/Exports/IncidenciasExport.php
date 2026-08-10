<?php

namespace App\Exports;

use App\Models\Incidencia;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class IncidenciasExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    protected $filtros;

    public function __construct(array $filtros)
    {
        $this->filtros = $filtros;
    }

    public function query()
    {
        $query = Incidencia::query()->with(['empleado', 'departamento', 'tipoIncidencia']);

        if (!empty($this->filtros['fecha_inicio'])) {
            $query->whereDate('fecha', '>=', $this->filtros['fecha_inicio']);
        }
        if (!empty($this->filtros['fecha_fin'])) {
            $query->whereDate('fecha', '<=', $this->filtros['fecha_fin']);
        }
        if (!empty($this->filtros['departamento_id'])) {
            $query->where('departamento_id', $this->filtros['departamento_id']);
        }
        if (!empty($this->filtros['empleado_id'])) {
            $query->where('empleado_id', $this->filtros['empleado_id']);
        }

        return $query->orderBy('fecha', 'desc');
    }

    public function headings(): array
    {
        return [
            'ID',
            'Fecha',
            'Matrícula',
            'Empleado',
            'Departamento',
            'Tipo de Incidencia',
            'Motivo',
            'Estatus'
        ];
    }

    public function map($incidencia): array
    {
        return [
            $incidencia->id,
            $incidencia->fecha,
            $incidencia->empleado->numero_empleado,
            $incidencia->empleado->nombre . ' ' . $incidencia->empleado->apellido_paterno,
            $incidencia->departamento->nombre ?? 'N/A',
            $incidencia->tipoIncidencia->nombre ?? 'N/A',
            $incidencia->motivo,
            $incidencia->estatus,
        ];
    }
}
