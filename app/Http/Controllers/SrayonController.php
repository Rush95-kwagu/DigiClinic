<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect; 


class SrayonController extends Controller
{
     public function PharmacieAuthCheck()
   {
       $user_role_id=Session::get('user_role_id');
        if ($user_role_id == 1) {
        return;
        }
        else 
        {
            return Redirect::to('/')->send();
        }
   }

     public function index()
   {
      $this->PharmacieAuthCheck();
   	return view ('admin.add_srayon');
   }

   public function all_srayon()

   {
      $this->PharmacieAuthCheck();
   	$all_srayon_info=DB::table('tbl_srayon')->get();
      $manage_srayon=view('admin.all_srayon')
   	     ->with('all_srayon_info',$all_srayon_info);
   	
   	return view ('admin_layout')
   	->with ('admin.all_srayon',$manage_srayon);


  
   }

   public function save_srayon(Request $request)
   {
      $this->PharmacieAuthCheck();
   	  $data=array();
   	  $data['srayon_id']=$request->srayon_id;
   	  $data['rayon_id']=$request->rayon_id;
   	   $data['srayon_name']=$request->srayon_name;
   	    $data['srayon_description']=$request->srayon_description;
           $data['rayon_id']=$request->rayon_id;
   	  

   	     DB::table('tbl_srayon')->insert($data);
   	     Session::put('message','Sous rayon ajoutée avec succès!!');
   	     return Redirect::to('/sous-rayon-par-rayon-entite/'.$request->rayon_id);
   }


  public function unactive_srayon($srayon_id)
   {
      $this->PharmacieAuthCheck();
      
      DB::table('tbl_srayon')
            ->where('srayon_id',$srayon_id)
            ->update(['publication_status'=>0]);
              Session::put('message','Sous rayon désactivée avec succès!!');
              return back()->withInput()->with('message','Produit ajoutée avec succès!!');

   }


public function active_srayon($srayon_id)
   {
      $this->PharmacieAuthCheck();
      DB::table('tbl_srayon')
            ->where('srayon_id',$srayon_id)
            ->update(['publication_status'=>1]);
              Session::put('message','Sous rayon activée avec succès!!');
            return back()->withInput()->with('message','Produit ajoutée avec succès!!');

   }


public function edit_srayon($srayon_id)
      {    
        $this->PharmacieAuthCheck();
         $srayon_info=DB::table('tbl_srayon')
            ->where('srayon_id',$srayon_id)
            ->first(); 

         $srayon_info=view('admin.edit_rayon')
              ->with('srayon_info',$srayon_info);
         
         return view ('admin_layout')
         ->with ('admin.edit_rayon',$srayon_info);
            //return view('/admin.edit_category');
      }

public function update_srayon(Request $request,$srayon_id)
{
   $this->PharmacieAuthCheck();
   $data=array();
   $data['srayon_name']=$request->srayon_name;
   $data['srayon_description']=$request->srayon_description;
  // $data['publication_status']=$request->publication_status;
   DB::table('tbl_srayon')
         ->where('srayon_id',$srayon_id)
            ->update($data); 

            Session::put('message', 'Sous rayon modifiée avec succès');
         return back()->withInput()->with('message','Produit ajoutée avec succès!!');

}


public function delete_srayon($srayon_id)
{
   $this->PharmacieAuthCheck();
   DB::table('tbl_srayon')
         ->where('srayon_id',$srayon_id)
            ->delete(); 

            Session::get('message', 'Sous rayon supprimée avec succès');
      return back()->withInput()->with('message','Produit ajoutée avec succès!!');

}
}
