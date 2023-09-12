<?php

namespace Database\Seeders\TemplateConfigs;

use App\Models\TemplateConfig\TemplateConfig;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemplateConfigsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TemplateConfig::create([
            'logo'=> '',
            'img_main'=> '',
            'url_carton'=> 'https://evento.uniandes.edu.co/es/bingo-fopre-2022/Compra-de-cartones',
            'description_carton'=> 'Adquierelo en el campus con nuestros voluntarios o',
            'price_carton'=> '10000',
            'url_live'=> 'https://www.youtube.com/watch?v=6ffOWmMESLY&ab_channel=UniversidaddelosAndes',
            'description_live'=> 'El evento iniciará el 11 de noviembre de 2022 a las 2:00 p.m.',
            'area'=> 'Dirección de Relacionamiento',
            'email'=> 'bingofopre@uniandes.edu.co',
            'phone'=> '332 4090',
        ]);
    }
}
