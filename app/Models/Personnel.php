<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    use HasFactory;
    protected $table ='personnel';

    protected $fillable = [
        'nom',
        'prenom',
        'sexe',
        'birthdate',
        'qualification',
        'ville',
        'email',
        'adresse',
        'service_id',
        'departement_id',
        'telephone',
        'departement',

    ];

    public function service()
    {
        $this->belongsTo(Service::class, 'service_id');
    }

    public function departement()
    {
        $this->belongsTo(Departement::class, );
    }

}