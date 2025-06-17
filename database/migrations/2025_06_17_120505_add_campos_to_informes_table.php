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
        Schema::table('informes', function (Blueprint $table) {
            $table->string('imagen_ducto', 300)->nullable();
            $table->string('observaciones_ducto')->nullable();
            $table->decimal('flujo_bomba')->nullable();
            $table->integer('tiempo_medido')->nullable();
            $table->integer('signatario')->nullable();
            $table->integer('revison')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('informes', function (Blueprint $table) {
            //
        });
    }
};
