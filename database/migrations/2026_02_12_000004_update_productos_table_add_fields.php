<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            if (!Schema::hasColumn('productos', 'nombre')) {
                $table->string('nombre')->after('id');
            }
            if (!Schema::hasColumn('productos', 'descripcion')) {
                $table->text('descripcion')->nullable()->after('nombre');
            }
            if (!Schema::hasColumn('productos', 'archivo_pdf')) {
                $table->string('archivo_pdf')->nullable()->after('descripcion');
            }
        });
    }

    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            if (Schema::hasColumn('productos', 'archivo_pdf')) {
                $table->dropColumn('archivo_pdf');
            }
            if (Schema::hasColumn('productos', 'descripcion')) {
                $table->dropColumn('descripcion');
            }
            if (Schema::hasColumn('productos', 'nombre')) {
                $table->dropColumn('nombre');
            }
        });
    }
};
