<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trabajadores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('dni')->unique();
            $table->string('telefono')->nullable();
            $table->string('email')->unique();
            $table->string('puesto');
            $table->decimal('salario_hora', 8, 2);
            $table->boolean('activo')->default(true);
            $table->timestamps();
            $table->softDeletes(); // ← BORRADO LÓGICO
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trabajadores');
    }
};
