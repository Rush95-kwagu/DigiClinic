<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect; 
use App\Http\Requests;
use Session;
use DB;


class CategoryController extends Controller
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
   	return view ('admin.add_category');
   }

   public function all_category()

   {

      $this->UserAuthCheck();
      $this->PharmacieAuthCheck();
      $user_role_id=Session::get('user_role_id');
      
      $all_category_info=DB::table('tbl_category')
                        ->get();

      return view('Pharmacie.all_category')->with(array(
                    'all_category_info'=>$all_category_info,           
                ));

   }

   public function save_category(Request $request)
   {
      $this->PharmacieAuthCheck();
   	  $data=array();
   	  $data['category_id']=$request->category_id;
   	   $data['category_name']=$request->category_name;
   	    $data['category_description']=$request->category_description;
   	     $data['publication_status']=$request->publication_status;

   	     DB::table('tbl_category')->insert($data);
   	     Session::put('message','Categorie ajoutée avec succès!!');
   	     return Redirect::to('/all-category');
   }


  public function unactive_category($category_id)
   {
      $this->PharmacieAuthCheck();
      
      DB::table('tbl_category')
            ->where('category_id',$category_id)
            ->update(['publication_status'=>0]);
              Session::put('message','Categorie désactivée avec succès!!');
            return Redirect::to('all-category');
   }


public function active_category($category_id)
   {
      $this->PharmacieAuthCheck();
      DB::table('tbl_category')
            ->where('category_id',$category_id)
            ->update(['publication_status'=>1]);
              Session::put('message','Categorie activée avec succès!!');
            return Redirect::to('all-category');
   }


public function edit_category($category_id)
      {    
        $this->PharmacieAuthCheck();
         $category_info=DB::table('tbl_category')
            ->where('category_id',$category_id)
            ->first(); 

         $category_info=view('admin.edit_category')
              ->with('category_info',$category_info);
         
         return view ('admin_layout')
         ->with ('admin.edit_category',$category_info);
            //return view('/admin.edit_category');
      }

public function update_category(Request $request,$category_id)
{
   $this->PharmacieAuthCheck();
   $data=array();
   $data['category_name']=$request->category_name;
   $data['category_description']=$request->category_description;
  // $data['publication_status']=$request->publication_status;
   DB::table('tbl_category')
         ->where('category_id',$category_id)
            ->update($data); 

            Session::put('message', 'Categorie modifiée avec succès');
            return Redirect::to('/all-category');
}


public function delete_category($category_id)
{
   $this->PharmacieAuthCheck();
   DB::table('tbl_category')
         ->where('category_id',$category_id)
            ->delete(); 

            Session::get('message', 'Categorie supprimée avec succès');
            return Redirect::to('/all-category');
}



public function rayon_by_entite ($id)
     {

      $this->PharmacieAuthCheck();

       $category=DB::table('tbl_category')
                  ->where('category_id',$id)
                  ->first();


       $all_rayon=DB::table('tbl_rayon')
                  ->join('tbl_category','tbl_category.category_id','tbl_rayon.category_id')
                  ->where('tbl_rayon.category_id',$id)
                  ->get();

      $get_category=$category->category_name;
      $get_category_id=$category->category_id;
                
    
       
       return view ('Pharmacie.all_rayon_by_category')
         ->with(array('all_rayon'=>$all_rayon, 'get_category'=>$get_category,'get_category_id'=>$get_category_id)); 
     }


   public function srayon_by_entite ($id)
     {

      $this->PharmacieAuthCheck();

       $rayon=DB::table('tbl_rayon')
                  ->where('rayon_id',$id)
                  ->first();


       $all_srayon=DB::table('tbl_srayon')
                  ->join('tbl_rayon','tbl_rayon.rayon_id','tbl_srayon.rayon_id')
                  ->where('tbl_srayon.rayon_id',$id)
                  ->get();

      
      
         $get_rayon=$rayon->rayon_name;
         $get_rayon_id=$rayon->rayon_id;
            
    
       
       return view ('Pharmacie.all_srayon_by_category')
         ->with(array('all_srayon'=>$all_srayon, 'get_rayon'=>$get_rayon,'get_rayon_id'=>$get_rayon_id)); 
     }


}
