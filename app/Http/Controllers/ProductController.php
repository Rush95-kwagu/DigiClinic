<?php

namespace App\Http\Controllers;

use File;
use Product;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect; 



class ProductController extends Controller
{
	//public function __construct()
	//{
	  //$this->PharmacieAuthCheck();
	//}

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
    	return view('admin.add_product');
    }

 public function all_product()
    {
      $this->PharmacieAuthCheck();
    	$all_product_info=DB::table('tbl_products')

    					->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
                        ->join('tbl_srayon','tbl_products.srayon_id','=','tbl_srayon.srayon_id')
                        ->join('tbl_rayon','tbl_srayon.rayon_id','tbl_rayon.rayon_id')
    					->join('tbl_manufacture','tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
    					->select('tbl_products.*','tbl_rayon.*','tbl_category.*','tbl_manufacture.*')
    					->get();

      $manage_product=view('admin.all_product')
   	     ->with('all_product_info',$all_product_info);
   	
   	return view ('admin_layout')
   	->with ('admin.all_product',$manage_product);


    }

    public function save_product(Request $request)
    {
    	$data=array();
   	 
	   	$data['product_name']=$request->product_name;
	   	$data['category_id']=$request->category_id;
        $data['srayon_id']=$request->srayon_id;
	   	$data['manufacture_id']=$request->manufacture_id;   
   	   
   	    $data['product_description']=$request->product_description;
   	    $data['product_price']=$request->product_price;

        $image=$request->file('product_image');
        
   	    if ($image) {
   	    	$image_name=$image->getClientOriginalName();
   	    	$ext=strtolower($image->getClientOriginalExtension());
   	    	$image_full_name=$image_name.'.'.$ext;
   	    	$upload_path='image/';
   	    	$image_url=$upload_path.$image_full_name;
   	    	$success=$image->move($upload_path,$image_full_name);
   	    	if ($success) {
   	    		$data['product_image']=$image_url;	  
   	    	}
   	    }


    DB::table('tbl_products')->insert($data);
    return back()->withInput()->with('message','Produit ajoutée avec succès!!');
           
    }







     public function update_product(Request $request,$product_id)
    {   
    

    $data=array();

    if ($request->product_name) {
        $data['product_name']=$request->product_name;
    }

     if ($request->manufacture_id) {
        $data['manufacture_id']=$request->manufacture_id;   
    }

    if ($request->product_description) {
        $data['product_description']=$request->product_description;
    }

    if ($request->product_price) {
        $data['product_price']=$request->product_price;
    }

    if ($request->stock) {
        $data['stock']=$request->stock;
    }


     if ($request->slider_status) {
        $data['slider_status']=$request->slider_status;
    }

    
        $image=$request->file('product_image');
        $image1=$request->file('image_un');
        $image2=$request->file('image_deux');
        $image3=$request->file('image_trois');
        if ($image) {
            $image_name=str_random(20);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='image/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if ($success) {
                $data['product_image']=$image_url;    
            }
        }

        if ($image1) {
            $image_name1=str_random(20);
            $ext1=strtolower($image1->getClientOriginalExtension());
            $image_full_name1=$image_name1.'.'.$ext1;
            $upload_path1='image/';
            $image_url1=$upload_path1.$image_full_name1;
            $success1=$image1->move($upload_path1,$image_full_name1);
            if ($success1) {
                $data['image_un']=$image_url1;    
            }
        }

        if ($image2) {
            $image_name2=str_random(20);
            $ext2=strtolower($image2->getClientOriginalExtension());
            $image_full_name2=$image_name2.'.'.$ext2;
            $upload_path2='image/';
            $image_url2=$upload_path2.$image_full_name2;
            $success2=$image2->move($upload_path2,$image_full_name2);
            if ($success2) {
                $data['image_deux']=$image_url2;    
            }
        }


        if ($image3) {
            $image_name3=str_random(20);
            $ext3=strtolower($image3->getClientOriginalExtension());
            $image_full_name3=$image_name3.'.'.$ext3;
            $upload_path3='image/';
            $image_url3=$upload_path3.$image_full_name3;
            $success3=$image3->move($upload_path3,$image_full_name3);
            if ($success3) {
                $data['image_trois']=$image_url3;    
            }
        }
    
         
      DB::table('tbl_products')
                  ->where('product_id',$product_id)
                  ->update($data);
     Session::put('message','Produit modifié avec succès!!');
     return Redirect::to('/produit-sous-rayon/'.$request->srayon_id);
         
    }



   public function edit_product($product_id)
        {    
           
           $product_info=DB::table('tbl_products')
              ->where('product_id',$product_id)
              ->first(); 

           $product_info=view('admin.edit_product')
                ->with('product_info',$product_info);
           
           return view ('admin_layout')
           ->with ('admin.edit_product',$product_info);
              
        }

    public function delete_product($product_id)
	{
    $this->PharmacieAuthCheck();
	   DB::table('tbl_products')
	         ->where('product_id',$product_id)
	            ->delete(); 

	            Session::get('message', 'product supprimée avec succès');
	            return back()->withInput()->with('message','Produit ajoutée avec succès!!');
	}


	public function unactive_product($product_id)
	   {
	      
	      DB::table('tbl_products')
	            ->where('product_id',$product_id)
	            ->update(['publication_status'=>0]);
	              Session::put('message','product désactivée avec succès!!');
	            return back()->withInput()->with('message','Produit ajoutée avec succès!!');
	   }


	public function active_product($product_id)
	   {
	      
	      DB::table('tbl_products')
	            ->where('product_id',$product_id)
	            ->update(['publication_status'=>1]);
	              Session::put('message','product activée avec succès!!');
	            return back()->withInput()->with('message','Produit ajoutée avec succès!!');
	   }


    public function produit_srayon ($id)
     {

      $this->PharmacieAuthCheck();

        $rayon=DB::table('tbl_srayon')
                  ->join('tbl_rayon','tbl_rayon.rayon_id','tbl_srayon.rayon_id')
                  ->join('tbl_category','tbl_category.category_id','tbl_rayon.category_id')
                  ->where('tbl_srayon.srayon_id',$id)
                  ->first();

        $srayon=DB::table('tbl_srayon')
                  ->where('srayon_id',$id)
                  ->first();


        $all_sproduit=DB::table('tbl_products')
            ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
            ->join('tbl_srayon','tbl_products.srayon_id','=','tbl_srayon.srayon_id')
            ->join('tbl_manufacture','tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
            ->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
            ->where('tbl_products.srayon_id',$id)
            ->get(); 


    
                               
      
        $get_srayon=$srayon->srayon_name;
        $get_srayon_id=$srayon->srayon_id;
        $get_category_id=$rayon->category_id;
        $get_category=$rayon->category_name;
        $get_rayon_id=$rayon->rayon_id;
        $get_rayon=$rayon->rayon_name;
            
    
       
       return view ('Pharmacie.all_product_by_srayon')
         ->with(array('all_sproduit'=>$all_sproduit,'get_category'=>$get_category,'get_srayon'=>$get_srayon,'get_rayon'=>$get_rayon,'get_rayon_id'=>$get_rayon_id,'get_category_id'=>$get_category_id, 'get_srayon_id'=>$get_srayon_id)); 
     }


     public function save_promo(Request $request)
    {
        $data=array();
     
        $data['promo_price']=$request->promo_price;
        $data['promo_end']=$request->promo_end;
        $data['product_id']=$request->product_id;
        $srayon_id=$request->srayon_id;
        
       
    DB::table('tbl_promo')->insert($data);
    Session::put('message','Produit modifié avec succès!!');
    return Redirect::to('/produit-sous-rayon/'.$srayon_id);
           
    }


    public function detail_product($product_id)
    {
    $this->PharmacieAuthCheck();
    $products_details=DB::table('tbl_products')
            ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
            ->join('tbl_srayon','tbl_products.srayon_id','=','tbl_srayon.srayon_id')
            ->join('tbl_rayon','tbl_srayon.rayon_id','tbl_rayon.rayon_id')
            ->join('tbl_manufacture','tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
            ->select('tbl_products.*','tbl_rayon.*','tbl_category.*','tbl_manufacture.*')
            ->where('product_id',$product_id)
            ->first();

    $last_sale=DB::table('tbl_order_details')
            ->where('product_id',$product_id)
            ->latest('order_details_id')
            ->first();

          


    $sold_count=DB::table('tbl_order_details')
            ->where('product_id',$product_id)
            ->count();

    return view ('admin.detail_product')
    ->with(array(
        'products_details'=>$products_details,
        'last_sale'=>$last_sale,
        'sold_count'=>$sold_count,
                    
    ));
    }



    public function stats()
    {
        $this->PharmacieAuthCheck();
        return view('admin.stats', [
            'categories' => DB::table('tbl_rayon')->get(),
            'products' => DB::table('tbl_products')
                        ->join('tbl_srayon','tbl_products.srayon_id','=','tbl_srayon.srayon_id')
                        ->join('tbl_rayon','tbl_srayon.rayon_id','tbl_rayon.rayon_id')
                        ->select('tbl_products.*','tbl_rayon.*')
                        ->get(),
            


            'soldproductsbystock' => DB::table('tbl_order_details')
                ->join('tbl_products','tbl_order_details.product_id','=','tbl_products.product_id')
                ->join('tbl_srayon','tbl_products.srayon_id','=','tbl_srayon.srayon_id')
                ->join('tbl_rayon','tbl_srayon.rayon_id','tbl_rayon.rayon_id')
                ->select('tbl_rayon.rayon_name','tbl_products.stock','tbl_products.product_name')
                ->selectRaw('tbl_order_details.product_id, max(created_at), sum(product_sales_quantity) as total_qty, sum(tbl_order_details.product_price*product_sales_quantity) as incomes, avg(tbl_order_details.product_price) as avg_price')
                ->whereYear('created_at', Carbon::now()->year)
                ->groupBy('product_id')
                ->orderBy('total_qty', 'desc')
                ->limit(15)->get(),





            'soldproductsbyincomes' => DB::table('tbl_order_details')
            ->join('tbl_products','tbl_order_details.product_id','=','tbl_products.product_id')
                ->join('tbl_srayon','tbl_products.srayon_id','=','tbl_srayon.srayon_id')
                ->join('tbl_rayon','tbl_srayon.rayon_id','tbl_rayon.rayon_id')
            ->select('tbl_rayon.rayon_name','tbl_products.stock','tbl_products.product_name')
            ->selectRaw('tbl_products.product_id, max(created_at), sum(product_sales_quantity) as total_qty, sum(tbl_order_details.product_price*product_sales_quantity) as incomes, avg(tbl_order_details.product_price) as avg_price')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('product_id')
            ->orderBy('incomes', 'desc')->limit(15)->get(),





            'soldproductsbyavgprice' => DB::table('tbl_order_details')
            ->join('tbl_products','tbl_order_details.product_id','=','tbl_products.product_id')
            ->join('tbl_srayon','tbl_products.srayon_id','=','tbl_srayon.srayon_id')
            ->join('tbl_rayon','tbl_srayon.rayon_id','tbl_rayon.rayon_id')
            ->select('tbl_rayon.rayon_name','tbl_products.stock','tbl_products.product_name')
            ->selectRaw('tbl_products.product_id, max(created_at), sum(product_sales_quantity) as total_qty, sum(tbl_order_details.product_price*product_sales_quantity) as incomes, avg(tbl_order_details.product_price) as avg_price')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('product_id')
            ->orderBy('avg_price', 'desc')->limit(15)->get()
        ]);

    
    }



}
