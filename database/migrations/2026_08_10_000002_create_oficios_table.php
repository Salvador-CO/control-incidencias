<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('oficios', function (Blueprint $table) {
            $table->id();

            // Identificación del folio
            $table->string('numero_oficio', 50)->unique()
                ->comment('Folio generado: CLAVE/NNN/AAAA, ej. DASE/283/2026');
            $table->unsignedInteger('consecutivo')
                ->comment('Número secuencial por departamento + año');
            $table->unsignedSmallInteger('anio')
                ->comment('Año del oficio');

            // Relaciones
            $table->foreignId('departamento_id')->constrained('departamentos');
            $table->foreignId('registrado_por_user_id')->constrained('users')
                ->comment('Usuario que registró el oficio');

            // Datos del oficio
            $table->date('fecha_registro')
                ->comment('Fecha en que se toma el registro');
            $table->string('jefe_referencia')
                ->comment('Nombre del jefe/subdirector que necesita la referencia');
            $table->string('registrado_por_nombre')
                ->comment('Nombre de la persona que registra (auto, editable)');
            $table->text('asunto')
                ->comment('Asunto del oficio');
            $table->string('dirigido_a')
                ->comment('Nombre completo + institución del destinatario');

            // Estatus y cancelación
            $table->enum('estatus', ['Pendiente', 'Entregado', 'Cancelado'])
                ->default('Pendiente');
            $table->string('cancelado_por')->nullable();
            $table->text('motivo_cancelacion')->nullable();

            // Acuse (enlace OneDrive)
            $table->string('acuse_url', 500)->nullable()
                ->comment('URL del archivo de acuse almacenado en OneDrive');
            $table->string('acuse_nombre')->nullable()
                ->comment('Nombre descriptivo del archivo de acuse');
            $table->date('fecha_acuse')->nullable();

            $table->timestamps();

            // Índice para unicidad del consecutivo por depto+año
            $table->unique(['departamento_id', 'anio', 'consecutivo'], 'unique_folio');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('oficios');
    }
};
