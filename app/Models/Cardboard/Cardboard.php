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
        'Tel_fono_celular_1__c',
        'sold_date',
        'mode_sale',
        'state_id',
        'group_id',
        'user_id',
    ];


    public function state()
    {
        return $this->belongsTo('App\Models\State\State', 'state_id');
    }
    public function cartongroup()
    {
        return $this->belongsTo('App\Models\CartonGroup\CartonGroup', 'group_id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
