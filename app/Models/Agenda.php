<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;
    protected $table ='tbl_agendas';
    protected $fillable = [
        'title',
        'description',
        'date',
        'patient_id',
        'user_id',
    ];
}
