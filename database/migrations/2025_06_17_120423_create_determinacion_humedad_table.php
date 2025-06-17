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
        Schema::create('determinacion_humedad', function (Blueprint $table) {
            $table->id('id_determinacion_humedad');
            $table->decimal('peso_inicial');
            $table->decimal('peso_final');
            $table->decimal('ganancia');
            $table->foreignId('id_informe')->nullable()->references('id_informe')->on('informes')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('determinacion_humedad');
    }
};
