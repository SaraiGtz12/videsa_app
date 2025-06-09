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
       Schema::create('equipos', function (Blueprint $table) {
    $table->id();
    $table->string('nombre', 100);
    $table->string('marca', 100)->nullable();
    $table->string('numero_serie', 100)->unique();
    $table->text('observaciones')->nullable();
    $table->string('ubicacion', 255)->nullable();
    $table->timestamp('creado_en')->useCurrent();
    $table->timestamp('actualizado_en')->useCurrent()->useCurrentOnUpdate();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};
