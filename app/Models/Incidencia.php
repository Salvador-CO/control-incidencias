<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    use HasFactory;

    protected $table = 'incidencias';

    protected $fillable = [
        'fecha',
        'empleado_id',
        'departamento_id',
        'direccion_id',
        'tipo_incidencia_id',
        'motivo',
        'observaciones',
        'recibido_por',
        'capturado_por',
        'estatus'
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function direccion()
    {
        return $this->belongsTo(Direccion::class);
    }

    public function tipoIncidencia()
    {
        return $this->belongsTo(TipoIncidencia::class, 'tipo_incidencia_id');
    }

    public function capturista()
    {
        return $this->belongsTo(User::class, 'capturado_por');
    }
}
