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
      'document_number',
      'price',
      'state_id',
      'group_id',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($cardboard) {
            $latestGroup = CartonGroup::latest()->first();
            if (!$latestGroup) {
                $latestGroup = new CartonGroup();
                $latestGroup->save();
            }
            $cardboard->group_id = $latestGroup->id;
        });
    }
    public function state()
    {
        return $this->belongsTo('App\Models\State\State', 'state_id');
    }
    public function cartongroup()
    {
        return $this->belongsTo('App\Models\CartonGroup\CartonGroup', 'group_id');
    }
}
