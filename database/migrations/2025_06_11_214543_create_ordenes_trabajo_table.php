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
        Schema::create('ordenes_trabajo', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 15);
            $table->integer('usuario_asignado');
            $table->integer('usuario_creador');
            $table->foreignId('id_norma')->nullable()->constrained('normas')->onDelete('set null');
            $table->foreignId('id_cliente')->nullable()->constrained('clientes')->onDelete('set null');
            $table->foreignId('id_sucursal')->nullable()->constrained('sucursales')->onDelete('set null');
            $table->date('fecha_evaluacion');
            $table->date('fecha_reconocimiento');
            $table->integer('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordenes_trabajo');
    }
};
