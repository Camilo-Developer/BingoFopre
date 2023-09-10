<?php

namespace App\Models\Instruction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instruction extends Model
{
    use HasFactory;
    protected $table = 'instructions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'description_one',
        'description_two',
    ];
}
