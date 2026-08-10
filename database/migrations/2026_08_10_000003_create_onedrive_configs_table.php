<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('onedrive_configs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('departamento_id')->unique()->constrained('departamentos')
                ->onDelete('cascade');
            $table->string('onedrive_url', 500)
                ->comment('Enlace base de la carpeta compartida en OneDrive del departamento');
            $table->string('descripcion')->nullable()
                ->comment('Descripción o nombre de la carpeta');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('onedrive_configs');
    }
};
