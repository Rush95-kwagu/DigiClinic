<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    use HasFactory;
    protected $table ="tbl_demande_ext";
    protected $primaryKey = 'id_demande';
    protected $guarded=[];
}
