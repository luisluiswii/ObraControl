<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('obras', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('direccion');
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->enum('estado', ['en curso', 'finalizada', 'pausada'])->default('en curso');
            $table->timestamps();
            $table->softDeletes(); // ← BORRADO LÓGICO
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('obras');
    }
};

