<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('obra_trabajador', function (Blueprint $table) {
            $table->foreignId('obra_id')->constrained('obras')->cascadeOnDelete();
            $table->foreignId('trabajador_id')->constrained('trabajadores')->cascadeOnDelete();
            $table->date('fecha_asignacion')->nullable();
            $table->date('fecha_fin')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('obra_trabajador', function (Blueprint $table) {
            $table->dropForeign(['obra_id']);
            $table->dropForeign(['trabajador_id']);
            $table->dropColumn(['obra_id', 'trabajador_id', 'fecha_asignacion', 'fecha_fin']);
        });
    }
};
