<?php

namespace App\Models\Sponsor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;
    protected $table = 'sponsors';
    protected $primaryKey = 'id';
    protected $fillable = [
        'logo',
        'name'
    ];
}
