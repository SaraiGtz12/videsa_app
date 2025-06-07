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
        Schema::create('service_orders', function (Blueprint $table) {
            $table->id('idServiceOrder');
            $table->string('serviceOrder');
            $table->string('responsible');
            $table->string('phoneNumber');
            $table->unsignedBigInteger('assignedTo');
            $table->unsignedBigInteger('userId');
            $table->unsignedBigInteger('addressId');
            $table->timestamps();

            $table->foreign('userId')->references('idUser')->on('users');
            $table->foreign('addressId')->references('idAddress')->on('addresses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_orders');
    }
};
