<?php

namespace App\Models\Cardboard;

use App\Models\CartonGroup\CartonGroup;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cardboard extends Model
{
    use HasFactory;

    protected $table = 'cardboards';
    protected $primaryKey = 'id';
    protected  $fillable = [
      'name',
      //'date_finish',
      'document_number',
      'price',
      'state_id',
      'group_id',
      //'user_id',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($cardboard) {
            // Obtén el último grupo existente o crea uno nuevo
            $latestGroup = CartonGroup::latest()->first();
            if (!$latestGroup) {
                $latestGroup = new CartonGroup();
                $latestGroup->save();
            }

            // Asigna el group_id al cartón
            $cardboard->group_id = $latestGroup->id;
        });
    }
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
}
