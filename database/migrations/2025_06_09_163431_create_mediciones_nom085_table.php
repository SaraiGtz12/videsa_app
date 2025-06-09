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
        Schema::create('mediciones_nom085', function (Blueprint $table) {
            $table->id();
            $table->integer('id_medicion');
            $table->float('nox')->nullable();
            $table->float('co_ppmv');
            $table->float('o2');
            $table->float('co2');
            $table->float('temp');
            $table->foreignId('detalles_medicion_nom085_id')->nullable()->constrained('detalles_mediciones_nom085')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mediciones_nom085');
    }
};
