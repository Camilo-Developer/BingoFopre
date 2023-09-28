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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->comment = 'Nombre del usuario';
            $table->string('lastname')->nullable()->comment = 'Apellido del usuario';
            $table->string('email')->unique()->comment = 'Correo del usuario';
            $table->string('password')->comment = 'Contraseña del usuario';
            $table->bigInteger('state_id')->unsigned()->nullable()->default(1)->comment = 'Estado del usuario';
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
