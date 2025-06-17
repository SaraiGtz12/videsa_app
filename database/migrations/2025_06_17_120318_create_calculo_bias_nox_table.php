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
        Schema::create('calculo_bias_nox', function (Blueprint $table) {
            $table->id('id_calculo_nox');
            $table->decimal('baja_media');
            $table->decimal('respuesta_sistema');
            $table->integer('tr_s');
            $table->decimal('flujo_lm');
            $table->decimal('respuesta_sistema_2');
            $table->foreignId('id_informe')->nullable()->references('id_informe')->on('informes')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calculo_bias_nox');
    }
};
