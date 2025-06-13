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
        Schema::table('ordenes_servicios', function (Blueprint $table) {
            $table->string('responsable', 100)->nullable();
            $table->string('cargo', 50)->nullable();
            $table->string('telefono', 15)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ordenes_servicios', function (Blueprint $table) {
            $table->dropColumn(['responsable', 'cargo', 'telefono']);
        });
    }
};
