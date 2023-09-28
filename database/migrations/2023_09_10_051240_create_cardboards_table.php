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
        Schema::create('cardboards', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment = 'Nombre del cartón';
            $table->string('price')->comment = 'Precio del cartón';
            $table->string('document_number')->nullable()->comment = 'Número de documento del cartón';
            $table->bigInteger('state_id')->unsigned()->default(3)->comment = 'Estado del cartón';
            $table->bigInteger('group_id')->unsigned()->nullable()->comment = 'Grupo del cartón';
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cardboards');
    }
};
