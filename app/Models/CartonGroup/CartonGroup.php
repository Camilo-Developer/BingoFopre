<?php

namespace App\Models\CartonGroup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartonGroup extends Model
{
    use HasFactory;
    protected $table ='carton_groups';
    protected $primaryKey = 'id';
    protected $fillable = [
      'user_id',
    ];

    /*Lista con relacion directa e inversa revisada*/
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /*Lista con relacion directa e inversa revisada*/
    public function cardboard()
    {
        return $this->hasMany('App\Models\Cardboard\Cardboard', 'group_id');
    }
}