<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalysPayed extends Model
{
    use HasFactory;
    protected $table ="tbl_analyse_payed";
    protected $primaryKey = 'payed_analyse_id';
    protected $guarded=[];


    public function patient()
{
    return $this->belongsTo(Patient::class, 'patient_id');
}

public function prestation()
{
    return $this->belongsTo(Prestation::class, 'prestation_id');
}

public function resultat()
{
    return $this->hasOne(AnalysPayedResult::class, 'id_demande', 'payed_analyse_id');
}
}
