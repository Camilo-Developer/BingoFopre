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
        State::create([
            'name'=> 'No disponible',
            'check'=> '2',
        ]);
        State::create([
            'name'=> 'Circulación',
            'check'=> '3',
        ]);
        State::create([
            'name'=> 'Anulado',
            'check'=> '4',
        ]);
        State::create([
            'name'=> 'Vendido',
            'check'=> '5',
        ]);
        State::create([
            'name'=> 'Obsequio',
            'check'=> '6',
        ]);
    }
}
