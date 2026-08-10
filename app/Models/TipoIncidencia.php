<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoIncidencia extends Model
{
    use HasFactory;

    protected $table = 'tipo_incidencias';

    protected $fillable = [
        'nombre',
        'requiere_motivo',
        'activo',
    ];
}
