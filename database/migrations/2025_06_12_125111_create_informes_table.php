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
        Schema::create('informes', function (Blueprint $table) {
            $table->id('id_informe');
            $table->string('numero_informe', 10);
            $table->foreignId('id_norma')->nullable()->references('id_norma')->on('normas')->onDelete('set null');
            $table->foreignId('id_orden_servicio')->nullable()->references('id_orden_servicio')->on('ordenes_servicios')->onDelete('set null');
            $table->integer('combustible_utilizado');
            $table->integer('anio');
            $table->string('equipo_evaluado', 50);
            $table->string('marca_modelo', 100);
            $table->integer('cpacidad_termica_nominal');
            $table->integer('altura_nivel_mar');
            $table->decimal('precion_estatica');
            $table->string('geometria_conducto');
            $table->decimal('diametro_int');
            $table->decimal('diametro_eq')->nullable();
            $table->decimal('largo_transversal')->nullable();
            $table->decimal('ancho_transversal')->nullable();
            $table->integer('numero_puertos');
            $table->decimal('distancia_a')->nullable();
            $table->decimal('distancia_b')->nullable();
            $table->decimal('distancia_c')->nullable();
            $table->decimal('extencion_puerto')->nullable();
            $table->decimal('num_diametros_a')->nullable();
            $table->decimal('num_diametros_b')->nullable();
            $table->decimal('num_diametros_c')->nullable();
            $table->decimal('presion_barometrica_1')->nullable();
            $table->decimal('presion_barometrica_2')->nullable();
            $table->decimal('marcado_sonda_1');
            $table->decimal('marcado_sonda_2');
            $table->decimal('marcado_sonda_3');
            $table->decimal('concentracion_1');
            $table->decimal('concentracion_2');
            $table->decimal('concentracion_3');
            $table->decimal('estratificacion_1');
            $table->decimal('estratificacion_2');
            $table->decimal('estratificacion_3');
            $table->decimal('ppm_1');
            $table->decimal('ppm_2');
            $table->decimal('ppm_3');
            $table->decimal('promedio_concentracion');
            $table->decimal('max_estratificacion');
            $table->decimal('max_ppm');
            $table->foreignId('id_zona_geografica')->references('id_zona_geografica')->on('zonas_geograficas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informes');
    }
};
