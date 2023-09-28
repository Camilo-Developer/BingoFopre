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
        Schema::create('dynamic_games', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable()->comment = 'Logo de las dinamicas de juego';
            $table->string('title')->nullable()->comment = 'Titulo de las dinamicas de juego';
            $table->longText('letra')->nullable()->comment = 'Letras de las dinamicas de juego';
            $table->text('fila')->nullable()->comment = 'Filas de las dinamicas de juego';
            $table->text('colum')->nullable()->comment = 'Columnas de las dinamicas de juego';
            $table->bigInteger('state_id')->unsigned()->default(1)->comment = 'Estado de las dinamicas de juego';
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dynamic_games');
    }
};
