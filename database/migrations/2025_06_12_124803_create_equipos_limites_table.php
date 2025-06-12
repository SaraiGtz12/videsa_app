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
        Schema::create('equipos_limites', function (Blueprint $table) {
            $table->id('id_equipo_limite');
            $table->integer('capacidad_termica_nominal');
            $table->foreignId('id_tipo_combustible')->references('id_tipo_combustible')->on('tipos_combustibles');
            $table->integer('Humo')->nullable();
            $table->integer('Particulas_zvm')->nullable();
            $table->integer('Particulas_zc')->nullable();
            $table->integer('Particulas_rp')->nullable();
            $table->integer('Bioxido_zvm')->nullable();
            $table->integer('Bioxido_zc')->nullable();
            $table->integer('Bioxido_rp')->nullable();
            $table->integer('Oxido_zvm')->nullable();
            $table->integer('Oxido_zc')->nullable();
            $table->integer('Oxido_rp')->nullable();
            $table->integer('Monoxido_zvm')->nullable();
            $table->integer('Monoxido_zc')->nullable();
            $table->integer('Monoxido_rp')->nullable();
            $table->boolean('nuevo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos_limites');
    }
};
