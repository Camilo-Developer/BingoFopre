<?php

namespace App\Models\State;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected $table = 'states';
    protected $primaryKey = 'id';
    protected $fillable = [
      'name',
      'check',
    ];

    public function users()
    {
        return $this->hasMany('App\Models\User', 'state_id');
    }

     public function cardmains()
     {
         return $this->hasMany('App\Models\CardMain\CardMain', 'state_id');
     }
    public function sponsors()
    {
        return $this->hasMany('App\Models\Sponsor\Sponsor', 'state_id');
    }
    public function dynamicgames()
    {
        return $this->hasMany('App\Models\DynamicGame\DynamicGame', 'state_id');
    }
    public function prizes()
    {
        return $this->hasMany('App\Models\Prize\Prize', 'state_id');
    }
    public function cardboard()
    {
        return $this->hasMany('App\Models\Cardboard\Cardboard', 'state_id');
    }
    public function cartongrups()
    {
        return $this->hasMany('App\Models\CartonGroup\CartonGroup', 'state_id');
    }
}
