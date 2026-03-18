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
        Schema::create('tarifas', function (Blueprint $table) {
            $table->id();
            $table->enum('nome', ['regular','noturna', 'final_de_semana','feriados']);
            $table->enum('tipo', ['por_hora','por_dia']);
            $table->decimal('custo', 10,2);
            $table->integer('quantidade');
            $table->integer('minutos_de_graca');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarifas');
    }
};
