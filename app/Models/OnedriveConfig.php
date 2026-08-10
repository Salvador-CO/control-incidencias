<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnedriveConfig extends Model
{
    use HasFactory;

    protected $table = 'onedrive_configs';

    protected $fillable = [
        'departamento_id',
        'onedrive_url',
        'descripcion',
    ];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }
}
