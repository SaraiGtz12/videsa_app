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
        Schema::create('field_data_nom085', function (Blueprint $table) {
            $table->id('idFieldD');
            $table->decimal('nox');
            $table->decimal('co');
            $table->decimal('o2');
            $table->decimal('co2');
            $table->decimal('temp');
            $table->unsignedBigInteger('serviceRequestId');
            $table->timestamps();

            $table->foreign('serviceRequestId')->references('idServiceRequest')->on('services_request');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('field_data_nom085');
    }
};
