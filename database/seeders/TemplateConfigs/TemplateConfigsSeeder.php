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
            'url_carton'=> 'https://portafolio.lckm-innovaty.com/',
            'description_carton'=> 'Lorem ipsum dolor sit amet consectetur adipiscing elit dignissim proin euismod venenatis tincidunt, commodo quam phasellus morbi egestas sociosqu neque diam lobortis urna ante. Parturient dictumst primis nec cum nulla fames cursus ligula sed, nisl per senectus nibh taciti lectus fringilla penatibus justo,',
            'price_carton'=> '',
            'url_live'=> 'https://portafolio.lckm-innovaty.com/',
            'description_live'=> 'Lorem ipsum dolor sit amet consectetur adipiscing elit dignissim proin euismod venenatis tincidunt, commodo quam phasellus morbi egestas sociosqu neque diam lobortis urna ante. Parturient dictumst primis nec cum nulla fames cursus ligula sed, nisl per senectus nibh taciti lectus fringilla penatibus justo,',
            'area'=> 'Dirección de relacionamiento',
            'email'=> 'bingofopre@uniandes.edu.co',
            'phone'=> '2222222222',
        ]);
    }
}
