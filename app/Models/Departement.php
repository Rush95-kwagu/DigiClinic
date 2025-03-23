<?php

namespace App\Models;

use App\Models\User;
use App\Models\DepartementGenerale;
use App\Models\DepartementSpeciale;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Departement extends Model
{
    use HasFactory;
    protected $table ='departement';

    //  protected $fillable = [

    //      'departement_generale_id',
    //      'departement_speciale_id',

    //  ];

    public function departementGenerale()
    {
        return $this->belongsTo(DepartementGenerale::class,'departement_generale_id');
    }
    public function departementSpeciale()
    {
        return $this->belongsTo(DepartementSpeciale::class,'departement_speciale_id');
    }

    public function chef()
    {
        return $this ->belongsTo(User::class, 'id_chef');
    }
}