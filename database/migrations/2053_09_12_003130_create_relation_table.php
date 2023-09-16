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
        Schema::table('users', function ($table) {
            $table->foreign('state_id')->references('id')->on('states')->onUpdate('cascade');
        });
        Schema::table('card_mains', function ($table) {
            $table->foreign('state_id')->references('id')->on('states')->onUpdate('cascade');
        });
        Schema::table('sponsors', function ($table) {
            $table->foreign('state_id')->references('id')->on('states')->onUpdate('cascade');
        });
        Schema::table('dynamic_games', function ($table) {
            $table->foreign('state_id')->references('id')->on('states')->onUpdate('cascade');
        });
        Schema::table('prizes', function ($table) {
            $table->foreign('state_id')->references('id')->on('states')->onUpdate('cascade');
        });
        Schema::table('cardboards', function ($table) {
            $table->foreign('state_id')->references('id')->on('states')->onUpdate('cascade');
            $table->foreign('group_id')->references('id')->on('carton_groups')->onUpdate('cascade');
            //$table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
        });
        Schema::table('carton_groups', function ($table) {
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('state_id')->references('id')->on('states')->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relation');
    }
};
