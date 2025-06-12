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
        Schema::create('ordenes_servicios', function (Blueprint $table) {
            $table->id('id_orden_servicio');
            $table->foreignId('id_cliente')->nullable()->references('id_cliente')->on('clientes')->onDelete('set null');
            $table->foreignId('id_sucursal')->nullable()->references('id_sucursal')->on('sucursales')->onDelete('set null');
            $table->date('fecha_muestreo');
            $table->foreignId('muestreador_asignado')->references('id_usuario')->on('usuarios');
            $table->foreignId('id_datos_servicio')->nullable()->references('id_datos_servicio')->on('datos_servicios')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordenes_servicios');
    }
};
