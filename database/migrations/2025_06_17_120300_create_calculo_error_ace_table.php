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
        Schema::create('calculo_error_ace', function (Blueprint $table) {
            $table->id('id_calculo_error');
            $table->decimal('o2');
            $table->decimal('co');
            $table->decimal('nox')->nullable();
            $table->foreignId('id_informe')->nullable()->references('id_informe')->on('informes')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calculo_error_ace');
    }
};
