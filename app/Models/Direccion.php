<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

    protected $table = 'direcciones';
    
    protected $fillable = [
        'nombre',
        'activo',
        'jefe_id',
    ];

    public function departamentos()
    {
        return $this->hasMany(Departamento::class);
    }

    public function jefe()
    {
        return $this->belongsTo(Empleado::class, 'jefe_id');
    }
}
