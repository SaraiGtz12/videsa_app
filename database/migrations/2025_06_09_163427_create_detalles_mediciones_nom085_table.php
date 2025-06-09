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
        Schema::create('detalles_mediciones_nom085', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orden_trabajo_id')->nullable();
            $table->unsignedBigInteger('equipo_id')->nullable();
            $table->string(combustible_utilizado);
            $table->integer('capacidad_termica');
            $table->integer('altura_msnm');
            $table->float('precision_estatica');
            $table->integer('anyo');
            $table->float('precion_barometrica');
            $table->string('geometria_conducto');
            $table->float('diametro_conducto');
            $table->float('diametro_equivalente');
            $table->float('largo_transversal')->nullable();
            $table->float('ancho_transversal')->nullable();
            $table->integer('numero_puertos');
            $table->float('distancia_a')->nullable();
            $table->float('distancia_b')->nullable();
            $table->float('distancia_c')->nullable();
            $table->float('extencion_puerto');
            $table->float('numero_diametro_a')->nullable();
            $table->float('numero_diametro_b')->nullable();
            $table->float('numero_diametro_c')->nullable();
            $table->integer('puntos_seleccionados_medicion');
            $table->float('marcado_sonda_1');
            $table->float('marcado_sonda_2');
            $table->float('marcado_sonda_3');
            $table->float('concentracion_1');
            $table->float('concentracion_2');
            $table->float('concentracion_3');
            $table->float('estratificacion_1');
            $table->float('estratificacion_2');
            $table->float('estratificacion_3');
            $table->float('ppm_1');
            $table->float('ppm_2');
            $table->float('ppm_3');
            $table->float('promedio_concentracion');
            $table->float('max_estratificacion');
            $table->float('max_ppm');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalles_mediciones_nom085');
    }
};
