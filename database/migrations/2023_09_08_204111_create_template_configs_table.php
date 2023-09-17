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
        Schema::create('template_configs', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('img_main')->nullable();
            $table->string('color_main_one')->nullable();
            $table->string('color_main_two')->nullable();


            $table->string('img_carton')->nullable();
            $table->longText('url_carton')->nullable();
            $table->longText('description_carton')->nullable();
            $table->string('price_carton')->nullable();

            $table->string('img_live')->nullable();
            $table->longText('url_live')->nullable();
            $table->longText('description_live')->nullable();


            $table->string('area')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();

            $table->string('color_text_one')->nullable();
            $table->string('color_text_two')->nullable();
            $table->string('color_text_three')->nullable();
            $table->string('color_text_four')->nullable();

            $table->string('img_login')->nullable();
            $table->string('color_login_one')->nullable();
            $table->string('color_login_two')->nullable();
            $table->string('color_login_hover_three')->nullable();
            $table->string('color_login_hover_four')->nullable();



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_configs');
    }
};
