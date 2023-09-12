<?php

namespace Database\Seeders\State;

use App\Models\State\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        State::create([
            'name'=> 'Disponible',
            'check'=> '1',
        ]);
    }
}
