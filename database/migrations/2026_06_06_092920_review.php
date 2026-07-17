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
        Schema::create('Reviews', function (Blueprint $table) {
            $table->id();
            $table->string('Contenido');
            $table->integer('Puntuacion_Reseña');
            // $table->foreignId('ID_Programa')->constrained('programa')->onDelete('cascade');
            // $table->foreignId('ID_Usuario')->constrained('usuarios')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('reviews');
    }
};
