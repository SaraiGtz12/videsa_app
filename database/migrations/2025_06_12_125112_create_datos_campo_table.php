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
        Schema::create('datos_campo', function (Blueprint $table) {
            $table->id('id_dato_campo');
            $table->integer('id_medicion');
            $table->float('nox')->nullable();
            $table->float('co_ppmv');
            $table->float('o2');
            $table->float('co2');
            $table->float('temp');
            $table->foreignId('id_informe')->nullable()->references('id_informe')->on('informes')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datos_campo');
    }
};
