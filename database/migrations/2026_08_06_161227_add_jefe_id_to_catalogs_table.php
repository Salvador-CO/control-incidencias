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
        Schema::table('direcciones', function (Blueprint $table) {
            $table->foreignId('jefe_id')->nullable()->constrained('empleados')->nullOnDelete();
        });

        Schema::table('departamentos', function (Blueprint $table) {
            $table->foreignId('jefe_id')->nullable()->constrained('empleados')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('departamentos', function (Blueprint $table) {
            $table->dropForeign(['jefe_id']);
            $table->dropColumn('jefe_id');
        });

        Schema::table('direcciones', function (Blueprint $table) {
            $table->dropForeign(['jefe_id']);
            $table->dropColumn('jefe_id');
        });
    }
};
