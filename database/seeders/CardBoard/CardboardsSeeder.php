<?php

namespace Database\Seeders\CardBoard;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cardboard\Cardboard;

class CardboardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carton = new Cardboard([
            'name' => 'Nombre del cartón',
            'date_finish' => now(),
            'state_id' => 1, // Reemplaza con el estado correcto
            'user_id' => null, // Puede ser nulo si es necesario
        ]);

        $carton->save();
    }
}
