<?php

namespace App\Models\Prize;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Prize extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'prizes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'color',
        'imagen',
        'description',
    ];
    protected $dates = ['deleted_at'];
}
