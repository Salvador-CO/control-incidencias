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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('numero_empleado')->unique();
            $table->string('nombre');
            $table->string('apellido_paterno');
            $table->string('apellido_materno')->nullable();
            $table->string('curp')->nullable();
            $table->string('rfc')->nullable();
            $table->string('correo')->nullable();
            $table->string('telefono')->nullable();
            $table->date('fecha_ingreso');
            $table->foreignId('puesto_id')->constrained('puestos');
            $table->foreignId('departamento_id')->constrained('departamentos');
            $table->foreignId('direccion_id')->constrained('direcciones');
            $table->boolean('activo')->default(true);
            $table->string('fotografia')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
