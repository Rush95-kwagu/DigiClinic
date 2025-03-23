<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class PatientController extends Controller
{
    public function UserAuthCheck()
    {
     $user_id=Session::get('user_id');
     if ($user_id) {
         return;
         }
         else 
         {
             return Redirect::to('/')->send();
         }
 
     }
     public function AdminAuthCheck()
     {
         $user_role_id=Session::get('user_role_id');
         if($user_role_id ==10){
             return;
         }
         else
         {
             return Redirect::to('/')->send();
         }
     }  
    public function all_patient()
    {
     return view('patient.patients-list');
    }


    public function showPatientDatas($id)
    
    {  $this->AdminAuthCheck();
        $this->UserAuthCheck();

        $patient_datas = DB::table('tbl_patient')->where('patient_id', $id)->first();
    
        if (!$patient_datas) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite.');
        }
        return view('patient.patient-infos', compact('patient_datas'));
    }
}
