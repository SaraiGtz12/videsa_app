<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('estatus', function (Blueprint $table) {
            $table->id('id_estatus');
            $table->string('estatus');
            $table->timestamps();
        });

        DB::table('estatus')->insert([
            ['estatus' => 'Activo'],
            ['estatus' => 'Inactivo'],
            ['estatus' => 'En proceso'],
            ['estatus' => 'Revisión'],
            ['estatus' => 'Completado'] 

        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estatus');
    }
};
