<?php

namespace App\Models\Cardboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cardboard extends Model
{
    use HasFactory;

    protected $table = 'cardboards';
    protected $primaryKey = 'id';
    protected  $fillable = [
      'name',
      'date_finish',
    ];
}
