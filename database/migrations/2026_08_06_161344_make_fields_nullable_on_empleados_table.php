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
        Schema::table('empleados', function (Blueprint $table) {
            $table->string('apellido_paterno')->nullable()->change();
            $table->date('fecha_ingreso')->nullable()->change();
            $table->unsignedBigInteger('puesto_id')->nullable()->change();
            $table->unsignedBigInteger('departamento_id')->nullable()->change();
            $table->unsignedBigInteger('direccion_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('empleados', function (Blueprint $table) {
            $table->string('apellido_paterno')->nullable(false)->change();
            $table->date('fecha_ingreso')->nullable(false)->change();
            $table->unsignedBigInteger('puesto_id')->nullable(false)->change();
            $table->unsignedBigInteger('departamento_id')->nullable(false)->change();
            $table->unsignedBigInteger('direccion_id')->nullable(false)->change();
        });
    }
};
