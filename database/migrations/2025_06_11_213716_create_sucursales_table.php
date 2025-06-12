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
        Schema::create('sucursales', function (Blueprint $table) {
            $table->id('id_sucursal');
            $table->foreignId('id_cliente')->references('id_cliente')->on('clientes')->onDelete('cascade');
            $table->string('nombre');
            $table->string('codigo', 40);
            $table->string('telefono', 12);
            $table->string('calle', 300);
            $table->string('numero');
            $table->string('colonia');
            $table->string('ciudad');
            $table->string('estado');
            $table->string('codigo_postal', 8);
            $table->foreignId('id_estatus')->nullable()->references('id_estatus')->on('estatus')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sucursales');
    }
};
