<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect; 


class RayonController extends Controller
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
   	return view ('admin.add_rayon');
   }

   public function all_rayon()

   {
      $this->PharmacieAuthCheck();
   	$all_rayon_info=DB::table('tbl_rayon')->get();
      $manage_rayon=view('admin.all_rayon')
   	     ->with('all_rayon_info',$all_rayon_info);
   	
   	return view ('admin_layout')
   	->with ('admin.all_rayon',$manage_rayon);


  
   }

   public function save_rayon(Request $request)
   {
      $this->PharmacieAuthCheck();
   	  $data=array();
   	  $data['rayon_id']=$request->rayon_id;
   	   $data['rayon_name']=$request->rayon_name;
   	    $data['rayon_description']=$request->rayon_description;
           
   	     $data['category_id']=$request->category_id;


   	     DB::table('tbl_rayon')->insert($data);
   	     Session::put('message','Rayon ajoutée avec succès!!');
   	     return Redirect::to('/rayon-par-entite/'.$request->category_id);
   }


  public function unactive_rayon($rayon_id)
   {
      $this->PharmacieAuthCheck();
      
      DB::table('tbl_rayon')
            ->where('rayon_id',$rayon_id)
            ->update(['publication_status'=>0]);
              Session::put('message','Rayon désactivée avec succès!!');
            return back()->withInput()->with('message','Rayon désactivé avec succès!!');
   }


public function active_rayon($rayon_id)
   {
      $this->PharmacieAuthCheck();
      DB::table('tbl_rayon')
            ->where('rayon_id',$rayon_id)
            ->update(['publication_status'=>1]);
              Session::put('message','Rayon activée avec succès!!');
            return back()->withInput()->with('message','Rayon activé avec succès!!');
   }


public function edit_rayon($rayon_id)
      {    
        $this->PharmacieAuthCheck();
         $rayon_info=DB::table('tbl_rayon')
            ->where('rayon_id',$rayon_id)
            ->first(); 

         $rayon_info=view('admin.edit_rayon')
              ->with('rayon_info',$rayon_info);
         
         return view ('admin_layout')
         ->with ('admin.edit_rayon',$rayon_info);
            //return view('/admin.edit_category');
      }

public function update_rayon(Request $request,$rayon_id)
{
   $this->PharmacieAuthCheck();
   $data=array();
   $data['rayon_name']=$request->rayon_name;
   $data['rayon_description']=$request->rayon_description;
  // $data['publication_status']=$request->publication_status;
   DB::table('tbl_rayon')
         ->where('rayon_id',$rayon_id)
            ->update($data); 

            Session::put('message', 'Rayon modifiée avec succès');
            return back()->withInput()->with('message','Produit ajoutée avec succès!!');
}


public function delete_rayon($rayon_id)
{
   $this->PharmacieAuthCheck();
   DB::table('tbl_rayon')
         ->where('rayon_id',$rayon_id)
            ->delete(); 

            Session::get('message', 'Rayon supprimée avec succès');
            return back()->withInput()->with('message','Produit ajoutée avec succès!!');
}


public function detail_rayon($rayon_id)
    {
    $this->PharmacieAuthCheck();
    $rayons_details=DB::table('tbl_rayon')
            ->where('rayon_id',$rayon_id)
            ->first();

    $rayons_products=DB::table('tbl_products')
            ->join('tbl_srayon','tbl_products.srayon_id','=','tbl_srayon.srayon_id')
            ->join('tbl_rayon','tbl_srayon.rayon_id','tbl_rayon.rayon_id') 
            ->select('tbl_products.*','tbl_rayon.*')
            ->where('tbl_rayon.rayon_id',$rayon_id)
            ->count();

    $getrayons_products=DB::table('tbl_products')
            ->join('tbl_srayon','tbl_products.srayon_id','=','tbl_srayon.srayon_id')
            ->join('tbl_rayon','tbl_srayon.rayon_id','tbl_rayon.rayon_id') 
            ->select('tbl_products.*','tbl_rayon.*')
            ->where('tbl_rayon.rayon_id',$rayon_id)
            ->get();

    $sold_count=DB::table('tbl_order_details')
            ->join('tbl_products','tbl_order_details.product_id','=','tbl_products.product_id')
            ->join('tbl_srayon','tbl_products.srayon_id','=','tbl_srayon.srayon_id')
            ->join('tbl_rayon','tbl_srayon.rayon_id','tbl_rayon.rayon_id')
            ->where('tbl_rayon.rayon_id',$rayon_id)
            ->count();

   $stock_rayon=DB::table('tbl_products')
            ->join('tbl_srayon','tbl_products.srayon_id','=','tbl_srayon.srayon_id')
            ->join('tbl_rayon','tbl_srayon.rayon_id','tbl_rayon.rayon_id')
            ->select('tbl_products.*','tbl_rayon.*')
            ->where('tbl_rayon.rayon_id',$rayon_id)
            ->sum('stock');

   $stock_def_rayon=DB::table('tbl_products')
            ->join('tbl_srayon','tbl_products.srayon_id','=','tbl_srayon.srayon_id')
            ->join('tbl_rayon','tbl_srayon.rayon_id','tbl_rayon.rayon_id')
            ->select('tbl_products.*','tbl_rayon.*')
            ->where('tbl_rayon.rayon_id',$rayon_id)
            ->sum('stock_defective');

    return view ('admin.detail_rayon')
    ->with(array(
        'rayons_details'=>$rayons_details,
        'sold_count'=>$sold_count,
        'rayons_products'=>$rayons_products,
        'stock_rayon'=>$stock_rayon,
        'stock_def_rayon'=>$stock_def_rayon,                
        'getrayons_products'=>$getrayons_products,                
    ));
    }


}
