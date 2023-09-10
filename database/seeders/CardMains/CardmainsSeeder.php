<?php

namespace Database\Seeders\CardMains;

use App\Models\CardMain\CardMain;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CardmainsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CardMain::create([
            'imagen'=> 'a',
            'title'=> 'sasad',
            'description'=> 'sdd',
            'mas_info'=> 'ddd',
        ]);
    }
}
