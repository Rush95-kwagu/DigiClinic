<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Rules\Password;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect; 
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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


         $email=Session::get('email');
         $acces=DB::table('users')
                ->where('email',$email)
                ->first();

        $ratio_rayon = DB::table('tbl_order_details') 
               ->join('tbl_products','tbl_order_details.product_id','=','tbl_products.product_id')
               ->join('tbl_srayon','tbl_products.srayon_id','=','tbl_srayon.srayon_id')
               ->select(
                        DB::raw('srayon_name as srayon_name'),
                        DB::raw('sum(tbl_order_details.product_price) as number'),

                      )
                       ->groupBy('srayon_name')   
                       ->get();
  
       $ratio[] = ['Rayons','Répartions des Ventes par rayons'];
        foreach ($ratio_rayon as $index => $values) {
             $ratio[++$index] = [$values->srayon_name, (int)$values->number];
        }



        $barMens = DB::table('tbl_order_details') 
               ->join('tbl_products','tbl_order_details.product_id','=','tbl_products.product_id')
               ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
               ->select(
                        DB::raw('tbl_order_details.product_price as product_price'),
                        DB::raw('sum(tbl_order_details.product_price) as number'),
                        DB::raw("created_at as month")
                      )  
                       ->orderBy(DB::raw("month(created_at)"))
                       ->groupBy(DB::raw("month(created_at)"))
                       ->get();
  
       $result2[] = ['Mois','Ventes du mois'];
        foreach ($barMens as $key => $valu) {
             $result2[++$key] = [\Carbon\Carbon::parse($valu->month)->formatLocalized('%b'), (int)$valu->number];
        }
        
        $barAn = DB::table('tbl_order_details') 
               ->join('tbl_products','tbl_order_details.product_id','=','tbl_products.product_id')
               ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
               ->select(
                        DB::raw('tbl_order_details.product_price as product_price'),
                        DB::raw('sum(tbl_order_details.product_price) as number'),
                        DB::raw("year(created_at) as year")
                      )
                       
                       ->orderBy(DB::raw("year(created_at)"))
                       ->groupBy(DB::raw("year(created_at)"))
                       ->get();
  
        $result3[] = ['Années','Ventes annuelles'];
        foreach ($barAn as $key => $value) {
            $result3[++$key] = [$value->year, (int)$value->number];
        }
        
        $this->UserAuthCheck(); 
        Session::put('user_role_id',$acces->user_role_id); 
        return view ('Accueil.dashboard')->with(array('barMens' => json_encode($result2),'barAn' => json_encode($result3), 'ratio' => json_encode($ratio)));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('signup');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
             'password' => Hash::make($request->password),
             'role' => $request->role, // Optionnel, selon la logique d'application
            'departement' => $request->departement, // Option
        ]);


        Auth::login($user);

        return redirect()->back()->with('Compte créé avec succès'); // Modifier selon la route appropriée après l'inscription
    }



    public function all_sales()
    { 

        $this->PharmacieAuthCheck();
        $user_role_id=Session::get('user_role_id');
        $centre_id=Session::get('centre_id');
        $caisse="caisse";


        
        $all_ventes_info=DB::table('tbl_order')      
                   ->join('tbl_order_details','tbl_order_details.order_id','=','tbl_order.order_id')              
                   ->join('tbl_payment','tbl_payment.payment_id','=','tbl_order.payment_id')                   
                   ->join('tbl_guest','tbl_guest.guest_id','=','tbl_order.guest_id')                   
                   ->select('tbl_order.*','tbl_order_details.*','tbl_payment.*','tbl_guest.*')
                   ->where('payment_method','like',$caisse)
                   ->where('tbl_order.id_centre',$centre_id)
                   ->groupBy('tbl_order.order_id')
                   ->orderBy('tbl_order.order_id','DESC')
                   ->get();    
          
    
        return view ('Pharmacie.all_ventes')
        ->with(array('all_ventes_info'=>$all_ventes_info,));

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
    
}