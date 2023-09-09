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
            $table->string('imagen')->nullable();
            $table->longText('title')->nullable();
            $table->longText('description')->nullable();
            $table->longText('mas_info')->nullable();
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
