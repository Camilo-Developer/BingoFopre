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
            $table->string('logo')->nullable();
            $table->string('title')->nullable();
            $table->longText('letra')->nullable();
            $table->text('fila')->nullable();
            $table->text('colum')->nullable();
            $table->bigInteger('state_id')->unsigned();
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
