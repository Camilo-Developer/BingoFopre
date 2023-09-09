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
        'url_carton',
        'description_carton',
        'price_carton',
        'url_live',
        'description_live',
        'area',
        'email',
        'phone',
    ];
}
