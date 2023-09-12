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

    /*Lista con relacion directa e inversa revisada*/
    public function users()
    {
        return $this->hasMany('App\Models\User', 'state_id');
    }
}
