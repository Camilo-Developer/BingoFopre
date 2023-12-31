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
        Schema::table('users', function (Blueprint $table){
            $table->string('password')->nullable()->change()->comment = 'Contraseña del usuario';
            $table->string('avatar')->nullable()->comment = 'Avatar del usuario';
            $table->string('external_id')->nullable()->comment = 'Token de azure';
            $table->string('external_auth')->nullable()->comment = 'Por donde se autentifica';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
