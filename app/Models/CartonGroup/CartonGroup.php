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

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function state()
    {
        return $this->belongsTo('App\Models\State\State', 'state_id');
    }

    public function cardboard()
    {
        return $this->hasMany('App\Models\Cardboard\Cardboard', 'group_id');
    }

    public function areAllCardboardsSold()
    {
        return $this->cardboard->every(function ($carton) {
            return $carton->state_id === 5;
        });
    }
}
