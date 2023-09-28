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
            $table->string('logo')->nullable()->comment = 'Logo de la configuración del sitio';
            $table->string('img_main')->nullable()->comment = 'Imagen principal de la configuración del sitio';
            $table->string('color_main_one')->nullable()->comment = 'Color 1 de la configuración del sitio';
            $table->string('color_main_two')->nullable()->comment = 'Color 2 la configuración del sitio';

            $table->string('img_carton')->nullable()->comment = 'Imagen del cantón de la configuración del sitio';
            $table->longText('url_carton')->nullable()->comment = 'Url del cartón de la configuración del sitio';
            $table->longText('description_carton')->nullable()->comment = 'Descripción del cartón de la configuración del sitio';
            $table->string('price_carton')->nullable()->comment = 'Precio del cartón de la configuración del sitio';

            $table->string('img_live')->nullable()->comment = 'Imagen de la tramición de la configuración del sitio';
            $table->longText('url_live')->nullable()->comment = 'Url de la tramición de la configuración del sitio';
            $table->longText('description_live')->nullable()->comment = 'Descripción de la tramición de la configuración del sitio';

            $table->string('area')->nullable()->comment = 'Area de la universidad de la configuración del sitio';
            $table->string('email')->nullable()->comment = 'Email de la universidad de la configuración del sitio';
            $table->string('phone')->nullable()->comment = 'Telefono de la universidad de la configuración del sitio';

            $table->string('color_text_one')->nullable()->comment = 'Color del texto 1 de la configuración del sitio';
            $table->string('color_text_two')->nullable()->comment = 'Color del texto 2 de la configuración del sitio';
            $table->string('color_text_three')->nullable()->comment = 'Color del texto 3 de la configuración del sitio';
            $table->string('color_text_four')->nullable()->comment = 'Color del texto 4 de la configuración del sitio';

            $table->string('img_login')->nullable()->comment = 'Imagen del login de la configuración del sitio';
            $table->string('color_login_one')->nullable()->comment = 'Color 1 del login de la configuración del sitio';
            $table->string('color_login_two')->nullable()->comment = 'Color 2 del login de la configuración del sitio';
            $table->string('color_login_hover_three')->nullable()->comment = 'Color hover 3 del login de la configuración del sitio';
            $table->string('color_login_hover_four')->nullable()->comment = 'Color hover 4 del login de la configuración del sitio';

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
