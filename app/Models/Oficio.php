<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oficio extends Model
{
    use HasFactory;

    protected $table = 'oficios';

    protected $fillable = [
        'numero_oficio',
        'consecutivo',
        'anio',
        'departamento_id',
        'registrado_por_user_id',
        'fecha_registro',
        'jefe_referencia',
        'registrado_por_nombre',
        'asunto',
        'dirigido_a',
        'estatus',
        'cancelado_por',
        'motivo_cancelacion',
        'acuse_url',
        'acuse_nombre',
        'fecha_acuse',
    ];

    protected $casts = [
        'fecha_registro' => 'date',
        'fecha_acuse'    => 'date',
    ];

    // ─── Relaciones ──────────────────────────────────────────────────────────

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function registradoPor()
    {
        return $this->belongsTo(User::class, 'registrado_por_user_id');
    }

    // ─── Helpers ─────────────────────────────────────────────────────────────

    /**
     * Genera el siguiente número de oficio para el departamento y año dados.
     * Devuelve ['numero_oficio' => 'DASE/5/2026', 'consecutivo' => 5]
     */
    public static function siguienteNumero(int $departamentoId, int $anio): array
    {
        $departamento = Departamento::findOrFail($departamentoId);
        $clave = strtoupper($departamento->clave ?? 'OFIC');

        $ultimo = self::where('departamento_id', $departamentoId)
            ->where('anio', $anio)
            ->max('consecutivo') ?? 0;

        $consecutivo  = $ultimo + 1;
        $numeroOficio = "{$clave}/{$consecutivo}/{$anio}";

        return compact('consecutivo', 'numeroOficio');
    }

    /**
     * Scope para filtrar por departamento.
     */
    public function scopeDelDepartamento($query, int $departamentoId)
    {
        return $query->where('departamento_id', $departamentoId);
    }

    /**
     * Badge de color Bootstrap según el estatus.
     */
    public function badgeClass(): string
    {
        return match($this->estatus) {
            'Entregado'  => 'success',
            'Cancelado'  => 'danger',
            default      => 'warning',
        };
    }
}
