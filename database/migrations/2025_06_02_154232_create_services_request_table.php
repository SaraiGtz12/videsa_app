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
        Schema::create('services_request', function (Blueprint $table) {
            $table->id('idServiceRequest');
            $table->unsignedTinyInteger('amount');
            $table->string('description');
            $table->unsignedBigInteger('equipmentId')->nullable;
            $table->unsignedBigInteger('nomId');
            $table->unsignedBigInteger('serviceOrderId');
            $table->timestamps();

            $table->foreign('serviceOrderId')->references('idServiceOrder')->on('service_orders');
            $table->foreign('nomId')->references('idNom')->on('noms');
            $table->foreign('equipmentId')->references('idEquipment')->on('equipments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services_request');
    }
};
