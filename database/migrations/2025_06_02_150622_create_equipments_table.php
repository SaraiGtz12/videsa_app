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
        Schema::create('equipments', function (Blueprint $table) {
            $table->id('idEquipment');
            $table->string('idAssigning');
            $table->decimal('Presicion');
            $table->decimal('measureInterval');
            $table->string('serialNumber');
            $table->date('receptionDate');
            $table->date('issuedDate');
            $table->date('effectiveDate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipments');
    }
};
