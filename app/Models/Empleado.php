<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados';

    protected $fillable = [
        'numero_empleado', 'nombre', 'apellido_paterno', 'apellido_materno',
        'curp', 'rfc', 'correo', 'telefono', 'fecha_ingreso',
        'puesto_id', 'departamento_id', 'direccion_id', 'activo', 'fotografia'
    ];

    public function puesto()
    {
        return $this->belongsTo(Puesto::class);
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function direccion()
    {
        return $this->belongsTo(Direccion::class);
    }

    public function usuario()
    {
        return $this->hasOne(\App\Models\User::class, 'empleado_id');
    }
}
