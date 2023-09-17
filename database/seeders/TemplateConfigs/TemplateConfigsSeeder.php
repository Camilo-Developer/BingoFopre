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
            'logo'=> 'logo.png',
            'img_main'=> 'img_main.png',
            'color_main_one'=> '#408decd1',
            'color_main_two'=> '#3c61ddaf',
            'img_carton'=> 'img_carton.png',
            'url_carton'=> 'https://evento.uniandes.edu.co/es/bingo-fopre-2022/Compra-de-cartones',
            'description_carton'=> 'o adquierelo en el campus con nuestros voluntarios',
            'price_carton'=> '12000',
            'img_live'=> 'img_live.png',
            'url_live'=> 'https://www.youtube.com/watch?v=6ffOWmMESLY&ab_channel=UniversidaddelosAndes',
            'description_live'=> 'El evento iniciará el 11 de noviembre de 2022 a las 2:00 p.m.',
            'area'=> 'Dirección de Relacionamiento',
            'email'=> 'bingofopre@uniandes.edu.co',
            'phone'=> '332 4090',
            'color_text_one'=> '#000000',
            'color_text_two'=> '#fff',
            'color_text_three'=> '#110b79',
            'color_text_four'=> '#feae11',
            'img_login'=> 'img_login.png',
            'color_login_one'=> '#408decd1',
            'color_login_two'=> '#3c61ddaf',
            'color_login_hover_three'=> '#1e4ae966',
            'color_login_hover_four'=> '#0043ff96',
        ]);
    }
}
