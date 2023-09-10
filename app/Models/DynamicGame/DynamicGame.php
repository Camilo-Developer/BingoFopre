<?php

namespace App\Models\DynamicGame;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DynamicGame extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'dynamic_games';
    protected $primaryKey = 'id';
    protected $fillable = [
        'logo',
        'title',
        'letra',
        'fila',
        'colum',
    ];
    protected $dates = ['deleted_at'];
}
