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
        $this->call(StateSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UsersSeeder::class);
        //User::factory(5)->create()->each(function ($user) {
        //    $user->assignRole('Estudiante');
        //});
        //User::factory(5)->create()->each(function ($user) {
        //    $user->assignRole('Vendedor');
        //});
        $this->call(TemplateConfigsSeeder::class);
        //$this->call(CardmainsSeeder::class);
        $this->call(InstructionsSeeder::class);

    }
}
