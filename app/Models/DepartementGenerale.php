<?php

namespace App\Models;

use App\Models\User;
use App\Models\Service;
use App\Models\Personnel;
use App\Models\Departement;
use App\Models\DepartementSpeciale;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DepartementGenerale extends Model
{
    use HasFactory;
        protected $table = 'departement_generales';

    protected $fillable =[
        'code_depart',
        'libelle',
        'telephone',
        'email',
        'medecin_id',
        'chef_departement_id',
        'service_id',
        'status',
    ];

    public function personnel()
    {
        $this->hasMany(Personnel::class);
    }

    public function chef()
    {
        $this->hasOne(User::class, 'chef_departement_id');
    }

    public function services()
    {
        $this->hasMany(Service::class, 'service_id');
    }

    public function departements()
    {
       return $this->hasMany(Departement::class, 'departement_generale_id');
    }
}
