<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestation extends Model
{
    use HasFactory;
    protected $table ="tbl_prestation";
    protected $primaryKey = 'prestation_id';
    protected $guarded=[];
}
