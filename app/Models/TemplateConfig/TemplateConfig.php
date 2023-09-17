<?php

namespace App\Models\TemplateConfig;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateConfig extends Model
{
    use HasFactory;
    protected $table = 'template_configs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'logo',//1
        'img_main',//2
        'color_main_one',
        'color_main_two',
        'img_carton',//3
        'url_carton',
        'description_carton',
        'price_carton',
        'img_live',//4
        'url_live',
        'description_live',
        'area',
        'email',
        'phone',
        'color_text_one',
        'color_text_two',
        'color_text_three',
        'color_text_four',
        'img_login',//5
        'color_login_one',
        'color_login_two',
        'color_login_hover_three',
        'color_login_hover_four',
    ];
}
