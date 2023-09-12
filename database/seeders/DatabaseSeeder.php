<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\CardMains\CardmainsSeeder;
use Database\Seeders\Instructions\InstructionsSeeder;
use Database\Seeders\State\StateSeeder;
use Database\Seeders\TemplateConfigs\TemplateConfigsSeeder;
use Illuminate\Database\Seeder;

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
        //TemplateConfigs
        $this->call(TemplateConfigsSeeder::class);
        //CardmainsSeeder
        $this->call(CardmainsSeeder::class);
        //InstructionsSeeder
        $this->call(InstructionsSeeder::class);

    }
}
