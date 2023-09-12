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
      'state_id',
      'group_id',
      'user_id',
    ];
    /*Lista con relacion directa e inversa revisada*/
    public function state()
    {
        return $this->belongsTo('App\Models\State\State', 'state_id');
    }
    /*Lista con relacion directa e inversa revisada*/
    public function cartongroup()
    {
        return $this->belongsTo('App\Models\CartonGroup\CartonGroup', 'group_id');
    }
    /*Lista con relacion directa e inversa revisada*/
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
