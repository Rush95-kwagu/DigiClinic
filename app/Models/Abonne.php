<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abonne extends Model
{
   protected $table ="tbl_subscriber";
   protected $primaryKey = 'subscriber_id ';

   protected $fillable = [ 
    'subscriber_id',
    'subscriber_mail',
    'subscriber_name',
    'subscriber_product',
    'subscribe_statut',
    'subscriber_date',
    ];
}
