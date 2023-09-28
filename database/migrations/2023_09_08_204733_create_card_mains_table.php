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
        Schema::create('card_mains', function (Blueprint $table) {
            $table->id();
            $table->string('imagen')->nullable()->comment = 'Imagen de las noticias generales';
            $table->longText('title')->nullable()->comment = 'Titulo de las noticias generales';
            $table->longText('description')->nullable()->comment = 'Descripción de las noticias generales';
            $table->longText('mas_info')->nullable()->comment = 'Más información de las noticias generales';

            $table->bigInteger('state_id')->unsigned()->default(1)->comment = 'Estado de las noticias generales';
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_mains');
    }
};
