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
            $table->string('name');
            $table->string('price');
            $table->string('document_number')->nullable();
            $table->bigInteger('state_id')->unsigned()->default(3);
            $table->bigInteger('group_id')->unsigned()->nullable();
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
