<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('incidencias', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->foreignId('empleado_id')->constrained('empleados');
            $table->foreignId('departamento_id')->nullable()->constrained('departamentos');
            $table->foreignId('direccion_id')->nullable()->constrained('direcciones');
            $table->foreignId('tipo_incidencia_id')->constrained('tipo_incidencias');
            $table->string('motivo')->nullable();
            $table->text('observaciones')->nullable();
            $table->string('recibido_por')->nullable();
            $table->foreignId('capturado_por')->constrained('users');
            $table->string('estatus')->default('Pendiente'); // Pendiente, Aprobado, Rechazado
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidencias');
    }
};
