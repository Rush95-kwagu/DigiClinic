<?php

namespace App\Models;

use App\Models\User;
use App\Models\Personnel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;
    protected $table ='services';

    protected $fillable = [
        'nom',
        'email',
        'telephone',
        'nbre_chambre',
        'status',
        'personnel_id'    
    ];

    public function chef()
    {
        return $this->belongsTo(Personnel::class,  'personnel_id');
    }
}