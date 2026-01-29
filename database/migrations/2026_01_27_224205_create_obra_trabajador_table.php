<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObraTrabajadorTable extends Migration
{
    public function up()
    {
        Schema::create('obra_trabajador', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('obra_id');
            $table->unsignedBigInteger('trabajador_id');

            $table->date('fecha_asignacion')->nullable();
            $table->date('fecha_fin')->nullable();

            $table->timestamps();

            $table->foreign('obra_id')->references('id')->on('obras')->onDelete('cascade');
	    $table->foreign('trabajador_id')->references('id')->on('trabajadores')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('obra_trabajador');
    }
}
