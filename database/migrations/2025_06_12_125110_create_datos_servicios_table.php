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
        Schema::create('datos_servicios', function (Blueprint $table) {
            $table->id('id_datos_servicio');
            $table->string('descripcion');
            $table->foreignId('id_norma')->nullable()->references('id_norma')->on('normas')->onDelete('set null');
            $table->foreignId('id_orden_servicio')->nullable()->references('id_orden_servicio')->on('ordenes_servicios')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datos_servicios');
    }
};
