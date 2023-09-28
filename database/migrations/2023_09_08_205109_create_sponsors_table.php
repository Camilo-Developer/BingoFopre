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
        Schema::create('sponsors', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable()->comment = 'Logo del patrocinado';
            $table->string('name')->nullable()->comment = 'Nombre del patrocinado';

            $table->bigInteger('state_id')->unsigned()->default(1)->comment = 'Estado del patrocinado';
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sponsors');
    }
};
