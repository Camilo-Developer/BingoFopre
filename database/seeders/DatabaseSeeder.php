<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\CardBoard\CardboardsSeeder;
use Database\Seeders\CardMains\CardmainsSeeder;
use Database\Seeders\Instructions\InstructionsSeeder;
use Database\Seeders\State\StateSeeder;
use Database\Seeders\TemplateConfigs\TemplateConfigsSeeder;
use Database\Seeders\User\UsersSeeder;
use Illuminate\Database\Seeder;

use App\Models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //StateSeeder
        $this->call(StateSeeder::class);
        //Roles
        $this->call(RoleSeeder::class);
        //UsersSeeder
        $this->call(UsersSeeder::class);
        // Crear 25 registros con el rol "Estudiante"
        User::factory(25)->create()->each(function ($user) {
            $user->assignRole('Estudiante');
        });

        // Crear 25 registros con el rol "Vendedor"
        User::factory(25)->create()->each(function ($user) {
            $user->assignRole('Vendedor');
        });

        //TemplateConfigs
        $this->call(TemplateConfigsSeeder::class);
        //CardmainsSeeder
        $this->call(CardmainsSeeder::class);
        //InstructionsSeeder
        $this->call(InstructionsSeeder::class);
        //CardboardsSeeder
        //$this->call(CardboardsSeeder::class);


    }
}
