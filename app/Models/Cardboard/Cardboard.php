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
        'price',
        'document_number',
        'Categoria_Principal__c',
        'Categoria__c',
        'Categoria_Administrativo__c',
        'FirstName',
        'LastName',
        'Email',
        'generoEmail__c',
        'Tipo_identificaci_n__c',
        'N_mero_de_Identificaci_n__c',
        'Tel_fono_celular_1__c',
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
