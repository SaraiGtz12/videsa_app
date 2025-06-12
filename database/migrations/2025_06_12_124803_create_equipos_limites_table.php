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
            $table->integer('humo')->nullable();
            $table->integer('particulas_zvm')->nullable();
            $table->integer('particulas_zc')->nullable();
            $table->integer('particulas_rp')->nullable();
            $table->integer('bioxido_zvm')->nullable();
            $table->integer('bioxido_zc')->nullable();
            $table->integer('bioxido_rp')->nullable();
            $table->integer('oxido_zvm')->nullable();
            $table->integer('oxido_zc')->nullable();
            $table->integer('oxido_rp')->nullable();
            $table->integer('monoxido_zvm')->nullable();
            $table->integer('monoxido_zc')->nullable();
            $table->integer('monoxido_rp')->nullable();
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
