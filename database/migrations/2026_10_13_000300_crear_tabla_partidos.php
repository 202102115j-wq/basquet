<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partidos', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_hora');
            $table->string('lugar')->nullable();
            $table->foreignId('equipo_local_id')->constrained('equipos')->restrictOnDelete();
            $table->foreignId('equipo_visitante_id')->constrained('equipos')->restrictOnDelete();
            $table->unsignedSmallInteger('puntos_local')->nullable();
            $table->unsignedSmallInteger('puntos_visitante')->nullable();
            $table->enum('estado', ['programado', 'finalizado'])->default('programado');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partidos');
    }
};
