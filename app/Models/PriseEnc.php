<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriseEnc extends Model
{
    use HasFactory;
    protected $table = 'tbl_prise_en_charge';

    protected $fillable = [
        'status',
        'patient_id',
        'user_role_id',
        'last_consult_user_id',
        'user_id',
        'maux',
        'temp',
        'etat_consultation',
        'etat_observation',
        'etat_hospitalisation',
        'observation',
        'ordonnance',
        'date_cloture',
        'id_centre',
        'etape'
    ];
    protected $casts=[
        'date_cloture'=>'datetime'
    ];
}
