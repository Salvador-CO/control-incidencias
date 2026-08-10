<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $table = 'departamentos';

    protected $fillable = [
        'direccion_id',
        'nombre',
        'clave',
        'activo',
        'jefe_id',
    ];

    public function direccion()
    {
        return $this->belongsTo(Direccion::class);
    }

    public function jefe()
    {
        return $this->belongsTo(Empleado::class, 'jefe_id');
    }

    public function oficios()
    {
        return $this->hasMany(Oficio::class);
    }

    public function onedriveConfig()
    {
        return $this->hasOne(OnedriveConfig::class);
    }
}
