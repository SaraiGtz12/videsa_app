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
        Schema::create('distribucion_puntos', function (Blueprint $table) {
            $table->id('id_distribucion_punto');
            $table->integer('puerto');
            $table->integer('punto');
            $table->decimal('factor_kl');
            $table->decimal('distancias');
            $table->decimal('ap');
            $table->foreignId('id_informe')->nullable()->references('id_informe')->on('informes')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distribucion_puntos');
    }
};
