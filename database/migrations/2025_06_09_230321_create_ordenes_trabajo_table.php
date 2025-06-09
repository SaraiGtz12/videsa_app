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
            $table->string('codigo', 50)->unique();
            $table->foreignId('usuario_asignado')->nullable()->constrained('usuarios');
            $table->foreignId('usuario_creador')->nullable()->constrained('usuarios');
            $table->foreignId('id_norma')->nullable()->constrained('normas');
            $table->foreignId('id_cliente')->nullable()->constrained('clientes');
            $table->foreignId('id_sucursal')->nullable()->constrained('sucursales');
            $table->date('fecha_evaluacion')->nullable();
            $table->date('fecha_reconocimiento')->nullable();
            $table->enum('estado', ['pendiente', 'en_progreso', 'completado', 'cancelado'])->default('pendiente');
            $table->timestamp('creado_en')->useCurrent();
            $table->timestamp('actualizado_en')->useCurrent()->useCurrentOnUpdate();
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
