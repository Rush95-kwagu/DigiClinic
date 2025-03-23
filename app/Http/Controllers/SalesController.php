<?php

namespace App\Http\Controllers;

// use PDF;
use Mail;
use Carbon\Carbon;
use App\Http\Requests;
use GuzzleHttp\Client;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\libraries\Configuration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use SimpleSoftwareIO\QrCode\Generator;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
Use App\libraries\Api\SfeInvoiceApi;
use Barryvdh\DomPDF\Facade\Pdf;
Use App\libraries\Api\SfeInfoApi;
Use App\libraries\Model\InvoiceTypeEnum;
Use App\libraries\Model\TaxGroupTypeEnum;
use Illuminate\Support\Facades\Redirect; 
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;



class SalesController extends Controller
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


   public function LaboAuthCheck()
   {
       $user_role_id=Session::get('user_role_id');
        if ($user_role_id == 4) {
        return;
        }
        else 
        {
            return Redirect::to('/')->send();
        }
   }

    public function index(Request $request)
        {   
            $this->PharmacieAuthCheck(); 
            $today=date('Y-m-d');
            $tel=$request->guest_mobile_number;

            if ($tel) {
            $data['guest_mobile_number']=$request->guest_mobile_number; 
            $data['guest_first_name']=$request->guest_first_name; 
            $data['guest_last_name']=$request->guest_last_name; 
            $data['id_centre']=$request->centre_id; 
                $get_tel=DB::table('tbl_guest')->where('guest_mobile_number',$tel)->first();

                  if ($get_tel){
                      return back()->withInput()->with('error', 'Echec de validation : Veuillez rechercher le client car il existe déjà sous le numéro renseigné');
                  }

            $client_id = DB::table('tbl_guest')->insertGetId($data);
            }else{
            $client_id=$request->client_id;
            }
            
            $user_id=Session::get('user_id');
            DB::table('tbl_panier')
             ->where('user_id',$user_id)
             ->where('panier_date','<',$today)
             ->delete();

            
            $client_info=DB::table('tbl_guest')
                ->where('guest_id',$client_id)
                ->first(); 

            $all_products=DB::table('tbl_products')
                ->join('tbl_srayon','tbl_products.srayon_id','=','tbl_srayon.srayon_id')
                ->join('tbl_rayon','tbl_srayon.rayon_id','tbl_rayon.rayon_id')
                ->select('tbl_products.*','tbl_rayon.*')
                ->get(); 
           
               return view ('Pharmacie.add_sale')
                ->with(array(
                    'client_info'=>$client_info,
                    'all_products'=>$all_products,
                                
                ));
              
        }

    public function get_detail(Request $request, $id)
    {
        $this->PharmacieAuthCheck();
        $client_id=$request->client_id;

        $all_detail = DB::table('tbl_products')
                    ->where('product_id', $id)
                    ->first();

        $data=['prix' => $all_detail->product_price];     
      
        return response()->json(array($data));
    }
    public function get_panier(Request $request, $guest_id)
    {
        $this->PharmacieAuthCheck();
        $user_id=Session::get('user_id');
        $tabpanier=DB::table('tbl_panier')
                 ->join('tbl_products','tbl_products.product_id','=','tbl_panier.product_id')
                 ->select('tbl_panier.*','tbl_products.*')
                 ->where('guest_id',$guest_id)
                 ->where('user_id',$user_id)
                 ->get();

        $total_panier=DB::table('tbl_panier')
                 ->join('tbl_products','tbl_products.product_id','=','tbl_panier.product_id')
                 ->select('tbl_panier.*','tbl_products.*')
                 ->where('guest_id',$guest_id)
                 ->where('user_id',$user_id)
                 ->sum('total');


         return response()->json([
            'tabpanier'=>$tabpanier,
            'total_panier'=>$total_panier,
        ]);

    }
        public function store_tabpanier(Request $request)
    {
        $this->PharmacieAuthCheck();
        $validator = Validator::make($request->all(), [
            'prix'=> 'required',
            'qty'=> 'required',
           
        ],[
            'prix.required' => 'Veuillez renseigner le prix',
            'qty.required' => 'Veuillez renseigner la quantité',
           
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);

        }else{

            $qty=$request->qty;
            $product_info=DB::table('tbl_products')
                    ->where('product_id',$request->product_id)
                    ->first();
            $stock=$product_info->stock;  

            if ($qty>$stock) {
                return response()->json([
                'status'=>400,
                'error'=>'La quantité de ce produit n\'est pas disponible.'
            ]);
            
            }


            $data=array();
            $data['product_id']=$request->product_id;
            $data['prix']=$request->prix;
            $data['qty']=$request->qty;
            $data['total']=$request->total; 
            $data['user_id']=$request->user_id; 
            $data['guest_id']=$request->guest_id; 
            $data['taxe_id']=$request->taxe_id; 
            $data['id_centre']=$request->centre_id; 

            DB::table('tbl_panier')
                ->insert($data);
            return response()->json([
                'status'=>200,
                'message'=>'Ajout au panier. Vérifier dans le tableau'
            ]);
        }

    }
    public function delete_tabpanier($id)
    {
        $this->PharmacieAuthCheck();
        $delete =DB::table('tbl_panier')
             ->where('panier_id',$id)
             ->delete(); 

       if($delete)
        {
            return response()->json([
                'status'=>200,
                'message'=>'Suppression effectuée avec succès.'
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'Pas de correspondance.'
            ]);
        }
               
    }
     public function make_caisse (Request $request)
    {   
        $this->PharmacieAuthCheck();
        $today=date('d-m-Y H:i:s');
        
        $user_id=Session::get('user_id');
        $client_id=$request->guest_id;
        $guest_id=$request->guest_id;
        $centre_id=$request->id_centre;
        $is_receipt=$request->receipt;
        $client_info=DB::table('tbl_guest')
                ->where('guest_id',$client_id)
                ->first();

        $guest_email= $client_info->guest_email;
       
        $getpanier=DB::table('tbl_panier')
                 ->join('tbl_products','tbl_products.product_id','=','tbl_panier.product_id')
                 ->join('tbl_category','tbl_category.category_id','=','tbl_products.category_id')
                 ->select('tbl_panier.*','tbl_products.*','tbl_category.*')
                 ->where('guest_id',$guest_id)
                 ->where('user_id',$user_id)
                 ->get();

        $total_panier=DB::table('tbl_panier')
                 ->where('guest_id',$guest_id)
                 ->where('user_id',$user_id)
                 ->sum('total');

          $payment_method="caisse";
          $pdata=array();
          $pdata['payment_method']=$payment_method; 
          $pdata['payment_status']='Payé';  

          $payment_id=DB::table('tbl_payment')
            ->insertGetId($pdata);

          $odata=array();
          $odata['guest_id']=$guest_id;
          $odata['id_centre']=$centre_id;
          $odata['transaction_id']='CAISSE0'.$user_id.'-'.$today;
          $odata['payment_id']=$payment_id;
          $odata['order_total']=$total_panier;
          $odata['order_status']='Cloturé';
          $order_id=DB::table('tbl_order')
                  ->insertGetId($odata);

          $oddata=array();

          foreach ($getpanier as $v_content) 
          {
            $oddata['order_id']=$order_id;
            $oddata['user_id']=$user_id;
            $oddata['product_id']=$v_content->product_id;
            $oddata['category_id']=$v_content->category_id;
            $oddata['product_name']=$v_content->product_name;
            $oddata['product_price']=$v_content->prix;
            $oddata['product_sales_quantity']=$v_content->qty;
            $oddata['taxe_id']=$v_content->taxe_id;

            DB::table('tbl_order_details')
               ->insert($oddata);

            $product= DB::table('tbl_products')
                    ->where('product_id','=',$v_content->product_id)
                    ->decrement('stock', $v_content->qty);

          }
        DB::table('tbl_panier')
             ->where('user_id',$user_id)
             ->where('guest_id',$guest_id)
             ->delete();


        if ($is_receipt == 1) {

        // Configure API key authorization: Bearer
        $config = Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1bmlxdWVfbmFtZSI6IjAyMDIxMTIyODE3MjJ8VFMwMTAxMDcxMyIsInJvbGUiOiJUYXhwYXllciIsIm5iZiI6MTcxOTkzMzYwMSwiZXhwIjoxNzM1ODMxMjAxLCJpYXQiOjE3MTk5MzM2MDEsImlzcyI6ImltcG90cy5iaiIsImF1ZCI6ImltcG90cy5iaiJ9.LBdkfCjUUeMRkZ79-tSfiMVDL338U13sHLRs0BlgQds');
        print_r($config);
        // Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
        // $config = App\libraries\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

        $apiInvoiceInstance = new SfeInvoiceApi(
           
            new Client(array('verify'=> false)),
            $config
        );

          $apiInfoInstance = new SfeInfoApi(
      
          new Client(array('verify'=> false)),
          $config
      );

        try {
            $statusReponseDto = $apiInvoiceInstance->apiInvoiceGet();
            
        } catch (Exception $e) {
            echo 'Exception when calling SfeInvoiceApi->apiInvoiceGet: ', $e->getMessage(), PHP_EOL;
        }

        $body = new \App\libraries\Model\InvoiceRequestDataDto(); // \App\libraries\Model\InvoiceRequestDataDto | 
        $body->setIfu('0202112281722');//YOUR IFU HERE

        $operatorDto = new \App\libraries\Model\OperatorDto();
        $operatorDto->setName('Test');
        $body->setOperator($operatorDto);

        $body->setType(InvoiceTypeEnum::FV);

        $items = array();

        $all_ventes_info=DB::table('tbl_order')      
                ->join('tbl_order_details','tbl_order_details.order_id','=','tbl_order.order_id')              
                ->join('tbl_payment','tbl_payment.payment_id','=','tbl_order.payment_id')                   
                ->join('tbl_guest','tbl_guest.guest_id','=','tbl_order.guest_id')                   
                ->select('tbl_order.*','tbl_order_details.*','tbl_payment.*','tbl_guest.*')
                ->where('tbl_order.order_id',$order_id)
                ->get(); 

        foreach ($all_ventes_info as $v_vente){

        $item1 = new \App\libraries\Model\ItemDto();
        $item1->setName($v_vente->product_name);
        $item1->setPrice($v_vente->product_price);
        $item1->setQuantity($v_vente->product_sales_quantity);
        $item1->setTaxGroup(TaxGroupTypeEnum::B);
        array_push($items, $item1);
        
        }
    
        $body->setItems($items);


        try {
            $invoiceResponseDto = $apiInvoiceInstance->apiInvoicePost($body);
            print_r($invoiceResponseDto);
        } catch (Exception $e) {
            echo 'Exception when calling SfeInvoiceApi->apiInvoicePost: ', $e->getMessage(), PHP_EOL;
        }


        $uid = $invoiceResponseDto['uid']; // string | 
            if (!is_null($uid)){

              try {
                  $invoiceDetailsDto = $apiInvoiceInstance->apiInvoiceUidGet($uid);
                  print_r($invoiceDetailsDto);
                  
                    try {
                        $securityElementsDto = $apiInvoiceInstance->apiInvoiceUidConfirmPut($uid);
                        print_r($securityElementsDto);
                    } catch (Exception $e) {
                        echo 'Exception when calling SfeInvoiceApi->apiInvoiceUidConfirmPut: ', $e->getMessage(), PHP_EOL;
                    }
                  
              } catch (Exception $e) {
                  echo 'Exception when calling SfeInvoiceApi->apiInvoiceUidConfirmPut: ', $e->getMessage(), PHP_EOL;
              }

          $data = array();
          $data['user_id']=$user_id;
          $data['code_me_ce_fdgi']=$securityElementsDto['code_me_ce_fdgi'];
          $data['order_id']=$order_id;
          $data['qr_code']=$securityElementsDto['qr_code'];
          $data['counters']=$securityElementsDto['counters'];
          $data['uid']=$uid;
          $data['nim']=$securityElementsDto['nim'];
          
          $datta=DB::table('tbl_receipt')->insert($data);

          $facture_info=DB::table('tbl_receipt')      
                   ->where('order_id',$order_id)
                   ->first(); 

            $code = $facture_info->qr_code;
    
            $qrcode_1 = new Generator;
            $dataQr = $qrcode_1->size(100)
                              ->generate($code);

          $message='Paiement effectué à la caisse. Facture généré avec succès';
          return Redirect::to('make-facture/'.$order_id)->with(array(
                    'message'=>$message,
                    'dataQr'=>$dataQr,
                    'facture_info'=>$facture_info,                       
                    'all_ventes_info'=>$all_ventes_info,                                
                ));
          
         }

        }
        Alert::success('Info Vente', 'Paiement effectué');
        return Redirect::to('les-ventes');


    }
    // public function pay_analyse(Request $request)
    // {
    
    //     $centre_id = Session::get('centre_id');

    //     if (!$centre_id) {
    //         return response()->json(['error' => 'Aucun centre sélectionné.'], 400);
    //     }

    //     $validatedData = $request->validate([
    //         'patient_id' => 'required|integer',
    //         'id_demande' => 'required|integer',
    //         'prestation_id' => 'required|array',
    //         'total' => 'required|numeric',
    //     ]);
    // // dd($validatedData);
      
    //     // Enregistrer dans tbl_analyse_payed
    //     DB::table('tbl_analyse_payed')->insert([
    //         'patient_id' => $validatedData['patient_id'],
    //         'id_demande' => $validatedData['id_demande'],
    //         'prestations' => json_encode($validatedData['prestation_id']), // Stocker sous forme de JSON
    //         'montant_total' => $validatedData['total'],
    //         'centre_id' => $centre_id,
    //         'date_paiement' => now(),
    //         'updated_at' => now()
    //     ]);
    
    //     // return response()->json(['message' => 'Paiement enregistré avec succès !'], 200);
    //     return response()->json([
    //         'message' => 'Paiement enregistré avec succès !',
    //         'patient_id' => $validatedData['patient_id'],
    //         'total' => $validatedData['total']
    //     ], 200);
        
    // }

    public function add_patient(Request $request)
    {
        $patient_id = DB::table('patients')->insertGetId([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'telephone' => $request->telephone
        ]);

        return response()->json(['id' => $patient_id, 'message' => 'Patient ajouté avec succès !']);
    }
     public function make_facture($order_id)
    {

    $user_role_id=Session::get('user_role_id');
    $category_id=Session::get('category_id');
    $caisse="caisse";

    $facture_info=DB::table('tbl_receipt')
                  ->join('users','users.user_id','=','tbl_receipt.user_id')
                  ->join('personnel','users.email','=','personnel.email')
                  ->select('tbl_receipt.*','users.*','personnel.*')
                  ->where('order_id',$order_id)
                  ->first(); 

    $all_ventes_info=DB::table('tbl_order') 
             ->join('tbl_centre','tbl_centre.id_centre','=','tbl_order.id_centre') 
             ->join('tbl_entite','tbl_entite.id_entite','=','tbl_centre.id_entite') 
             ->join('tbl_order_details','tbl_order_details.order_id','=','tbl_order.order_id')              
             ->join('tbl_payment','tbl_payment.payment_id','=','tbl_order.payment_id')                   
             ->join('tbl_guest','tbl_guest.guest_id','=','tbl_order.guest_id')                   
             ->select('tbl_order.*','tbl_order_details.*','tbl_payment.*','tbl_guest.*','tbl_entite.*','tbl_centre.*')
             ->where('tbl_order.order_id',$order_id)
             ->get(); 


      $code = $facture_info->qr_code;
    
      $qrcode_1 = new Generator;
      $dataQr = $qrcode_1->size(100)
                      ->generate($code);

      return view ('Pharmacie.receipt')
                ->with(array(
                    'dataQr'=>$dataQr,
                    'facture_info'=>$facture_info,                       
                    'all_ventes_info'=>$all_ventes_info,                                
                ));

      
    }


    public function index_sale(){
        $this->PharmacieAuthCheck();
        
        $client_info=DB::table('tbl_guest')

                ->get();
        return view ('Pharmacie.index_sale')
                ->with(array(
                    'client_info'=>$client_info,               
                ));         

    }

    public function etat_stock(){
        $this->PharmacieAuthCheck();
        $out_stock=DB::table('tbl_products')
            ->where('stock',0)
            ->get();

        $low_stock=DB::table('tbl_products')
            ->where('stock','<=',5)
            ->where('stock','!=',0)
            ->get();


        return view ('Pharmacie.etat_stock')
                ->with(array(
                    'out_stock'=>$out_stock,               
                    'low_stock'=>$low_stock,               
                ));         

    }
    // Labo
    public function etat_stock_labo(){
        $this->PharmacieAuthCheck();
        $out_stock=DB::table('tbl_products')
            ->where('stock',0)
            ->get();

        $low_stock=DB::table('tbl_products')
            ->where('stock','<=',5)
            ->where('stock','!=',0)
            ->get();


        return view ('Pharmacie.etat_stock')
                ->with(array(
                    'out_stock'=>$out_stock,               
                    'low_stock'=>$low_stock,               
                ));         

    }
    public function etat_caisse(){
        $this->PharmacieAuthCheck();
        $user_id=Session::get('user_id');
        $get_caisse=DB::table('tbl_order')
                ->join('tbl_order_details','tbl_order_details.order_id','=','tbl_order.order_id')  
                ->where('user_id',$user_id)
                ->where('created_date','like',date('Y-m-d').'%')
                ->get();

        $get_total_caisse=DB::table('tbl_order')
                ->join('tbl_order_details','tbl_order_details.order_id','=','tbl_order.order_id')  
                ->where('user_id',$user_id)
                ->where('created_date','like',date('Y-m-d').'%')
                ->sum('order_total');


        return view ('Pharmacie.etat_caisse')
                ->with(array(
                    'get_total_caisse'=>$get_total_caisse,                             
                    'get_caisse'=>$get_caisse,                             
                ));         

    }

    public function fermer_caisse (Request $request){
        $user_id=$request->user_id;
        $data=array();
        $data['user_id']=$user_id;
        DB::table('tbl_etat_caisse')
                  ->insert($data);

        Alert::warning('Info Caisse', 'La caisse a été fermé');
        return back();

    }



    public function all_provision()
    {
        $this->PharmacieAuthCheck();
        $all_appro=DB::table('tbl_approvisionnement')
                ->join('tbl_products','tbl_approvisionnement.product_id','=','tbl_products.product_id')
                ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
                ->join('tbl_srayon','tbl_products.srayon_id','=','tbl_srayon.srayon_id')
                ->join('tbl_rayon','tbl_srayon.rayon_id','tbl_rayon.rayon_id')
                ->select('tbl_products.*','tbl_rayon.*','tbl_category.*','tbl_approvisionnement.*')
                ->get();
        return view ('Pharmacie.all_provision')
                ->with(array(
                    'all_appro'=>$all_appro,               
                ));         

    }


     public function faire_appro()
    {
      $this->PharmacieAuthCheck();
        return view('Pharmacie.make_appro');
    }



    public function post_caisse(Request $request)
    {
      $this->PharmacieAuthCheck();
      $stock=$request->stock;
      $product_id=$request->product_id;
      $stock_defective=$request->stock_defective;
      $comments=$request->comments;
      $product_info=DB::table('tbl_products')
        ->where('product_id',$product_id)
        ->first();

        $get_stock=$product_info->stock;
        $new_stock=$get_stock + $stock;
       
        
            DB::table('tbl_products')
                ->where('product_id',$product_id)
                ->update(['stock'=>$new_stock]);
          
            
        $data=array();
        $data['product_id']=$product_id;
        $data['stock']=$stock;
        $data['stock_defective']=$stock_defective;
        $data['comments']=$comments; 
        DB::table('tbl_approvisionnement')
                ->insert($data);

        Session::put('message','Approvisionnement effectué avec succès!!');
        return Redirect::to('/faire-appro');
    }

     public function get_reactif(Request $request, $user_id, $id_analyse)
    {
        $this->LaboAuthCheck();
         

        $tabreactif=DB::table('tbl_cart_reactif')
                 ->join('tbl_reactif','tbl_reactif.reactif_id','=','tbl_cart_reactif.reactif_id')
                 ->select('tbl_cart_reactif.*','tbl_reactif.*')
                 ->where('user_id',$user_id)
                 ->where('id_analyse',$id_analyse)
                 ->get();

        $total_reactif=DB::table('tbl_cart_reactif')
                 ->join('tbl_reactif','tbl_reactif.reactif_id','=','tbl_cart_reactif.reactif_id')
                 ->select('tbl_cart_reactif.*','tbl_reactif.*')
                 ->where('user_id',$user_id)
                 ->where('id_analyse',$id_analyse)
                 ->count();


         return response()->json([
            'tabreactif'=>$tabreactif,
            'total_reactif'=>$total_reactif,
        ]);

    }


    public function store_tabreactif(Request $request)
    {
        $this->LaboAuthCheck();
        $validator = Validator::make($request->all(), [
           
            'qty'=> 'required',
           
        ],[
            
            'qty.required' => 'Veuillez renseigner la quantité',
           
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);

        }else{

            $qty=$request->qty;
            $product_info=DB::table('tbl_reactif')
                    ->where('reactif_id',$request->product_id)
                    ->first();
            $stock=$product_info->stock;  

            if ($qty>$stock) {
                return response()->json([
                'status'=>400,
                'error'=>'La quantité de ce réactif n\'est pas disponible.'
            ]);
            
            }


            $data=array();
            $data['reactif_id']=$request->product_id;
            
            $data['qty']=$request->qty;

            $data['id_analyse']=$request->id_analyse;
           
            $data['user_id']=$request->user_id; 
            
            $data['id_centre']=$request->centre_id; 

            DB::table('tbl_cart_reactif')
                ->insert($data);
            return response()->json([
                'status'=>200,
                'message'=>'Ajout au panier. Vérifier dans le tableau'
            ]);
        }

    }


    public function delete_tabreactif($id)
    {
        $this->LaboAuthCheck();
        $delete =DB::table('tbl_cart_reactif')
             ->where('reactif_id',$id)
             ->delete(); 

       if($delete)
        {
           
            return response()->json([
                'status'=>200,
                'message'=>'Suppression effectuée avec succès.'
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'Pas de correspondance.'
            ]);
        }
               
    }

    public function generateTicket($patient_id, $payed_analyse_id)
    {
        
        $paiement = DB::table('tbl_analyse_payed')
                        ->join('tbl_patient', 'tbl_patient.patient_id', '=', 'tbl_analyse_payed.patient_id')
                        ->join('tbl_prestation', 'tbl_prestation.prestation_id', '=', 'tbl_analyse_payed.prestation_id')
                        ->where('tbl_analyse_payed.patient_id', $patient_id) // Correction du nom de l'ID
                        ->select('tbl_patient.*', 'tbl_prestation.*','tbl_analyse_payed.*') // Sélectionner les données des deux tables
                        ->get();
           
        // dd($paiement);
        // dd($paiement->first()->patient_id);

        $qrCode = base64_encode(QrCode::format('svg')->size(200)->color(100, 200, 100)->generate(route('verif.ticket', ['panier_analyse_id' => $paiement->first()->panier_analyse_id])));
$qrCode = str_replace('svg', 'png', $qrCode);

        
        if (!$paiement) {
            return back()->with('error', 'Aucune donnée trouvée.');
        }
        
        $pdf = PDF::loadView('ticket.recu', compact('paiement','qrCode'));
        return $pdf->stream();
        
    }

    public function genererRecu($payed_analyse_id, $patient_id)
    {
        // Récupération du paiement
        $paiement = DB::table('tbl_analyse_payed')
                        ->where('payed_analyse_id', $payed_analyse_id)
                        ->first();
    
        if (!$paiement) {
            abort(404, "Paiement non trouvé.");
        }
    
        // Décoder le JSON contenant les ID des analyses
        $prestation_ids = json_decode($paiement->prestations, true); // Convertit en tableau
    
        // Vérifier que le décodage s'est bien passé
        if (!is_array($prestation_ids)) {
            $prestation_ids = [];
        }
    
        // Récupérer les prestations associées aux ID
        $prestations = DB::table('tbl_prestation')
                            ->whereIn('prestation_id', $prestation_ids)
                            ->get();
    
        // Récupérer les infos du patient
        $patient = DB::table('tbl_patient')
                        ->where('patient_id', $patient_id)
                        ->first();
    
        // Vérifier que le patient existe
        if (!$patient) {
            abort(404, "Patient non trouvé.");
        }
    
        // Génération du QR Code
        $qr_code = QrCode::size(150)->generate(URL::to('verifier_paiement', ['id' => $paiement->payed_analyse_id,]));
    
        // Préparer les données pour la vue
        $data = [
            'patient' => $patient,
            'montant' => $paiement->montant_total,
            'date_paiement' => \Carbon\Carbon::parse($paiement->date_paiement)->format('d/m/Y H:i'),
            'qr_code' => $qr_code,
            'prestations' => $prestations, // Envoyer les prestations à la vue
        ];
        // dd($data);
        // Générer le PDF
        $pdf = Pdf::loadView('ticket.recu', $data);

        return $pdf->download('Reçu_Paiement_' . $paiement->payed_analyse_id . '.pdf');
    }


public function generatePDF($patient_id, $payed_analyse_id)
{
    // Récupérer les données de la demande
    $validate_analyse = DB::table('tbl_demande_ext')
        ->leftJoin('tbl_type_analyse', 'tbl_demande_ext.id_type_analyse', '=', 'tbl_type_analyse.id_type_analyse')
        ->leftJoin('tbl_patient', 'tbl_demande_ext.patient_id', '=', 'tbl_patient.patient_id')
        ->leftJoin('services', 'tbl_demande_ext.services_id', '=', 'services.services_id')
        ->where('tbl_demande_ext.patient_id', $patient_id)
        ->where('tbl_demande_ext.id_demande', $payed_analyse_id)
        ->select(
            'tbl_demande_ext.*',
            'services.service as nom_service',
            'tbl_patient.*',
            DB::raw('TIMESTAMPDIFF(YEAR, tbl_patient.datenais, CURDATE()) as age')
        )
        ->first();

    // Vérifier si la demande existe
    if (!$validate_analyse) {
        return redirect()->back()->with('error', 'Aucune demande trouvée pour les critères spécifiés.');
    }

    // Générer le PDF
    $pdf = PDF::loadView('ticket.receipt', ['validate_analyse' => $validate_analyse]);

    // Retourner le PDF pour affichage dans le navigateur
    return $pdf->stream('receipt.pdf'); // Utilisez `stream()` pour afficher le PDF dans le navigateur
}

public function pay_analyse(Request $request)
{
    $centre_id = Session::get('centre_id');

    if (!$centre_id) {
        return response()->json(['error' => 'Aucun centre sélectionné.'], 400);
    }

    // Valider les données
    $validatedData = $request->validate([
        'patient_id' => 'required|integer',
        'id_demande' => 'required|integer',
        'prestation_id' => 'required|array', // Valider que c'est un tableau
        'prestation_id.*' => 'integer', // Valider que chaque élément du tableau est un entier
        'total' => 'required|numeric',
        'services_id' => 'required|integer',
    ]);

    // Récupérer les informations du patient
    $patient = DB::table('tbl_patient')
        ->where('patient_id', $validatedData['patient_id'])
        ->first();


    if (!$patient) {
        return response()->json(['error' => 'Patient non trouvé.'], 404);
    }
    $prestations = DB::table('tbl_prestation')
                        ->whereIn('prestation_id', 
                            $validatedData['prestation_id'])
                        ->get();

    // Enregistrer chaque prestation dans tbl_analyse_payed
    foreach ($validatedData['prestation_id'] as $prestation_id) {
        DB::table('tbl_analyse_payed')->insert([
            'patient_id' => $validatedData['patient_id'],
            'id_demande' => $validatedData['id_demande'],
            'prestation_id' => $prestation_id, // Stocker une seule prestation par ligne
            'montant_total' => $validatedData['total'],
            'centre_id' => $centre_id,
            'date_paiement' => now(),
            'updated_at' => now(),
        ]);
    }

    // Mettre à jour tbl_demande_ext avec un tableau encodé en JSON
    DB::table('tbl_demande_ext')
        ->where('id_demande', $validatedData['id_demande'])
        ->update([
            'is_payed' => 1, // Mettre à jour is_payed à 1
            'prestation_id' => json_encode($validatedData['prestation_id']), // Encoder en JSON
            'updated_at' => now(),
        ]);

    // Générer un identifiant unique pour le reçu
    $receipt_id = uniqid('RECEIPT_');

    // Générer le code QR
    $qrData = json_encode([
        'receipt_id' => $receipt_id,
        'patient_id' => $validatedData['patient_id'],
        'total' => $validatedData['total'],
        'date' => now()->format('Y-m-d H:i:s'),
    ]);
    $qrCode = QrCode::size(200)->generate($qrData);

    // Générer le PDF
    $pdf = PDF::loadView('ticket.receipt', [
        'patient' => $patient, // Passer les informations du patient à la vue
        'prestations' => $prestations,
        'montant' => $validatedData['total'],
        'qrCode' => $qrCode,
        'receipt_id' => $receipt_id,
    ]);

    // Sauvegarder le PDF dans un dossier accessible publiquement
    $pdfPath = storage_path('app/public/receipts/' . $receipt_id . '.pdf');
    $pdf->save($pdfPath);

    // Vérifier si le fichier a été créé
    if (!file_exists($pdfPath)) {
        return response()->json(['error' => 'Le fichier PDF n\'a pas pu être créé.'], 500);
    }

    // Générer l'URL publique du PDF
    $pdfUrl = asset('storage/receipts/' . $receipt_id . '.pdf');

    return response()->json([
        'message' => 'Paiement enregistré avec succès !',
        'pdf_url' => $pdfUrl,
        'patient_id' => $validatedData['patient_id'],
        'total' => $validatedData['total'],
    ], 200);
}


public function verifyReceipt($receipt_id)
{
    $receipt = DB::table('tbl_analyse_payed')
                    ->where('receipt_id', $receipt_id)
                    ->first();

    if ($receipt) {
        return response()->json([
            'message' => 'Reçu trouvé.',
            'receipt' => $receipt,
        ], 200);
    } else {
        return response()->json([
            'error' => 'Reçu non trouvé.',
        ], 404);
    }
}
}