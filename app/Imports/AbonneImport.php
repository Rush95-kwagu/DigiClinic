<?php

namespace App\Imports;

use App\Models\Abonne;
use Maatwebsite\Excel\Concerns\ToModel;

class AbonneImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Abonne([
           'subscriber_mail' => $row[0],
           'subscriber_name' => $row[1],
           'subscriber_product' => $row[2],           
        ]);
    }
}
