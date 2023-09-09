<?php

namespace App\Models\CardMain;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\SoftDeletes;

class CardMain extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'card_mains';
    protected $primaryKey = 'id';
    protected $fillable = [
        'imagen',
        'title',
        'description',
        'mas_info',
    ];
    protected $dates = ['deleted_at'];
}
