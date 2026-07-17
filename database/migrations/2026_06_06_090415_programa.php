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

        Schema::create('Programa', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->date('Fecha_transmision');
            $table->bigInteger('Duracion');
            $table->time('Hora_emision');
            $table->foreignId('ID_Canal')->constrained('canales')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
