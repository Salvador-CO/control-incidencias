<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('oficios', function (Blueprint $table) {
            // Permite registro público (sin usuario autenticado)
            $table->foreignId('registrado_por_user_id')
                ->nullable()
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('oficios', function (Blueprint $table) {
            $table->foreignId('registrado_por_user_id')
                ->nullable(false)
                ->change();
        });
    }
};
