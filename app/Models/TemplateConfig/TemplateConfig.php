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
        'logo',
        'img_main',
        'color_main_one',
        'color_main_two',
        'img_carton',
        'url_carton',
        'description_carton',
        'price_carton',
        'img_live',
        'url_live',
        'description_live',
        'area',
        'email',
        'phone',
        'color_text_one',
        'color_text_two',
        'color_text_three',
        'color_text_four',
        'img_login',
        'color_login_one',
        'color_login_two',
        'color_login_hover_three',
        'color_login_hover_four',
    ];
}
