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
        Schema::create('prizes', function (Blueprint $table) {
            $table->id();
            $table->string('color')->comment = 'Color del precio';
            $table->string('imagen')->comment = 'imagen del precio';
            $table->longText('description')->comment = 'Descripción del precio';
            $table->bigInteger('state_id')->unsigned()->default(1)->comment = 'Estado del precio';
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prizes');
    }
};
