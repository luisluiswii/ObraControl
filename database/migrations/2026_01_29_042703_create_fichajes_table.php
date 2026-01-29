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
        Schema::create('fichajes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('trabajador_id');
            $table->unsignedBigInteger('obra_id');

            $table->date('fecha');
            $table->time('hora_entrada');
            $table->time('hora_salida')->nullable();
            $table->decimal('horas_trabajadas', 5, 2)->nullable();

            $table->timestamps();

            $table->foreign('trabajador_id')
                ->references('id')
                ->on('trabajadores')
                ->onDelete('cascade');

            $table->foreign('obra_id')
                ->references('id')
                ->on('obras')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fichajes');
    }
};
