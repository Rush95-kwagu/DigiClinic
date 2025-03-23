<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Redirect; 
use Illuminate\Validation\ValidationException;

class PriseEnChargeController extends Controller
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

    public function CaisseAuthCheck()
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
    public function ChefAuthCheck()
   {
    $user_role_id=Session::get('user_role_id');
    if ($user_role_id == 11) {
        return;
        }
        else 
        {
            return Redirect::to('/')->send();
        }
    }

    public function AccueilAuthCheck()
   {
    $user_role_id=Session::get('user_role_id');
    if ($user_role_id == 0 || $user_role_id == 1) {
        return;
        }
        else 
        {
            return Redirect::to('/')->send();
        }
    }
    public function index()
    {
        $this->UserAuthCheck();
        $this->AccueilAuthCheck();
        $centre_id=Session::get('centre_id');
        $all_prisenc=DB::table('tbl_prise_en_charge')
                ->join('tbl_patient','tbl_prise_en_charge.patient_id','=','tbl_patient.patient_id')
                ->where('last_consult_user_role_id',Null)
                ->where('tbl_prise_en_charge.id_centre',$centre_id)
                ->select('tbl_prise_en_charge.*','tbl_patient.*')
                ->orderBy('etat_consultation','DESC')
                ->get(); 

        $all_consult=DB::table('tbl_prise_en_charge')
                ->join('tbl_patient','tbl_prise_en_charge.patient_id','=','tbl_patient.patient_id')
                ->where('last_consult_user_role_id','!=',Null)
                ->where('tbl_prise_en_charge.id_centre',$centre_id)
                ->select('tbl_prise_en_charge.*','tbl_patient.*')
                ->get();

        $all_patient_h=DB::table('tbl_consultation')
                  ->join('tbl_lits','tbl_consultation.id_lit','=','tbl_lits.id_lit')
                  ->join('tbl_chambre','tbl_lits.id_chambre','=','tbl_chambre.id_chambre')
                  ->join('tbl_prise_en_charge','tbl_consultation.id_prise_en_charge','=','tbl_prise_en_charge.id_prise_en_charge')              
                  ->join('tbl_patient','tbl_prise_en_charge.patient_id','=','tbl_patient.patient_id')
                  ->where('is_hospitalisation',1)
                  ->where('tbl_prise_en_charge.id_centre',$centre_id)
                  ->select('tbl_prise_en_charge.*','tbl_patient.*','tbl_consultation.*','tbl_chambre.*','tbl_lits.*')
                  ->groupBy('tbl_prise_en_charge.patient_id')
                  ->orderBy('etat_consultation','DESC')
                  ->get();

        $all_patient_u = DB::table('tbl_prise_en_charge')
                   ->join('tbl_patient','tbl_prise_en_charge.patient_id','=','tbl_patient.patient_id')
                    ->where('nom_patient', '')
                    ->orderBy('pcreated_at')
                    ->get();

        return view('prise_enc.all_prise_enc')->with(array(
                    'all_prisenc'=>$all_prisenc,             
                    'all_consult'=>$all_consult,             
                    'all_patient_h'=>$all_patient_h,             
                    'all_patient_u'=>$all_patient_u,             
                ));
    }
    public function caisse_analyses()
    {
       $this->CaisseAuthCheck();
       $centre_id=Session::get('centre_id');
       $all_analyse_nt=DB::table('tbl_analyse')
                ->join('tbl_patient','tbl_analyse.patient_id','=','tbl_patient.patient_id')
                ->join('tbl_type_analyse','tbl_analyse.id_type_analyse','=','tbl_type_analyse.id_type_analyse')
                ->where('statut_analyse',0)
                ->where('tbl_analyse.id_centre',$centre_id)
                ->select('tbl_analyse.*','tbl_patient.*','tbl_type_analyse.*')
                ->orderBy('tbl_analyse.created_at','DESC')
                ->get(); 

        $all_analyse_t=DB::table('tbl_analyse')
                ->join('tbl_patient','tbl_analyse.patient_id','=','tbl_patient.patient_id')
                ->join('tbl_type_analyse','tbl_analyse.id_type_analyse','=','tbl_type_analyse.id_type_analyse')
                ->where('statut_analyse',1)
                ->where('tbl_analyse.id_centre',$centre_id)
                ->select('tbl_analyse.*','tbl_patient.*','tbl_type_analyse.*')
                ->get();
        $all_demand_p=DB::table('tbl_demande_ext')
                ->join('tbl_patient','tbl_demande_ext.patient_id','=','tbl_patient.patient_id')
                ->where('is_payed',1)
                ->join('services','tbl_demande_ext.services_id','=','services.services_id')
                ->where('tbl_demande_ext.centre_id',$centre_id)
                ->select('tbl_demande_ext.*','services.service as nom_service','tbl_patient.*')
                ->get();         

       return view('prise_enc.all_analyses')->with(array(
                    'all_analyse_nt'=>$all_analyse_nt,             
                    'all_analyse_t'=>$all_analyse_t,   
                    'all_demand_p'=>$all_demand_p,
                ));
          
    }
    public function prestation()
    {
        return view('prise_enc/all_prestations');
    }

    public function addPrestation()
    {
        return view('prise_enc/add_prestation_form');
    }
  

    public function savePrestation(Request $request)
    {
        $this->CaisseAuthCheck();
         
        // $user = Auth::user();
        $user_role_id=Session::get('user_role_id');
        $centre_id=Session::get('centre_id');
      

        $request->validate([
           'nom_prestation'=>'required|string',
           'prix_prestation'=>'required|integer',
           'user_role_id'   => 'required|integer|in:' . Session::get('user_role_id'),
           'centre_id'      => 'required|integer|in:' . Session::get('centre_id'),
          
        ]);
       
        DB::table('tbl_prestation')->insert([
            'nom_prestation' => $request->input('nom_prestation'),
            'prix_prestation' => $request->input('prix_prestation'),
            'user_role_id'   => $user_role_id,
            'centre_id'      => $centre_id,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
    return redirect()->back()->with('PersonnalAdded', 'Informations sauvegardées avec succès');
    }

    public function editPrestation($prestation_id)
    {
        $this->ChefAuthCheck();
        $user_id =Session::get('user_id');
        $all_prestation = DB::table('tbl_prestatiion')
                            ->where('prestation_id', $prestation_id)
                             ->first();
                if(!$all_prestation){
                    return redirect()->back()->with('error', 'Erreur lors de la récupération de la prestation');
                }
            return view('prise_enc/edit_prestation_form', compact('all_prestation'));
    }

    public function analyse($patient_id, $id_demande, $services_id)
    {
        $this->CaisseAuthCheck();
        $user_id =Session::get('user_id');
        
        $validate_analyse = DB::table('tbl_demande_ext')
                                ->leftJoin('tbl_type_analyse', 'tbl_demande_ext.id_type_analyse', '=', 'tbl_type_analyse.id_type_analyse')
                                ->leftJoin('tbl_patient', 'tbl_demande_ext.patient_id', '=', 'tbl_patient.patient_id')
                                ->leftJoin('services','tbl_demande_ext.services_id', '=', 'services.services_id')
                                ->where('tbl_demande_ext.services_id', $services_id)
                                ->where('tbl_demande_ext.patient_id', $patient_id)
                                ->where('tbl_demande_ext.id_demande', $id_demande)
                                ->select(
                                    'tbl_demande_ext.*','services.service as nom_service', 'tbl_patient.*',
                                    DB::raw('TIMESTAMPDIFF(YEAR, tbl_patient.datenais, CURDATE()) as age')
                                        )
                                ->first();
    
    // dd($validate_analyse);
    
        return view('Analys/all_prestations_analyses')->with(array(

            'validate_analyse' => $validate_analyse));
    }

    public function addAnalyse()
    {
        return view('prise_enc/add_analyse_form');
    }

    public function saveAnalyse(Request $request)
    {
        $this->CaisseAuthCheck();
        // $user = Auth::user();
       
        $centre_id=Session::get('centre_id');
      

        $request->validate([
           'libelle_analyse'=>'required|string',
           'prix_analyse'=>'required|integer',
           'prix_analyse_assure'=>'required|integer',
           'centre_id'      => 'required|integer|in:' . Session::get('centre_id'),
          
        ]);
    //    dd($request->all());
        DB::table('tbl_type_analyse')->insert([
            'libelle_analyse' => $request->input('libelle_analyse'),
            'prix_analyse' => $request->input('prix_analyse'),
            'prix_analyse_assure' => $request->input('prix_analyse_assure'),
            'centre_id'      => $centre_id,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
    return redirect()->back()->with('PersonnalAdded', 'Informations sauvegardées avec succès');
    }

    public function editAnalyse($id)
    {
        $this->CaisseAuthCheck();
        $centre_id=Session::get('centre_id');
        $analyses = DB::table('tbl_type_analyse')
                    ->where('id_type_analyse', $id)
                    ->first();
    
        
        return view('prise_enc/edit_analyse_form', compact('analyses','centre_id'));

    }

    public function updateAnalyse(Request $request, $id_type_analyse)
    {
        $this->CaisseAuthCheck();
        $centre_id=Session::get('centre_id');
       
        $request->validate([
            'libelle_analyse' => 'required|string',
            'prix_analyse' => 'required|integer',
            'prix_analyse_assure' => 'required|integer',
            'centre_id' => 'required|integer|in:' . Session::get('centre_id'),
        ]);
        
        $analyses = DB::table('tbl_type_analyse')
                    ->where('id_type_analyse', $id_type_analyse)
                    ->first();
        
        if ($analyses) {
            $analyses->update($request->all());
        } else {
            return response()->json(['error' => 'Analyse non trouvée'], 404);
        }
        
        return redirect()->back()->with('PersonnalAdded', 'Mise à jour effectuée');

    }

    public function get_analyse(Request $request, $id)
    {
        $this->CaisseAuthCheck();

        $all_detail = DB::table('tbl_type_analyse')
                    ->where('id_type_analyse', $id)
                    ->first();

        $data=['prix' => $all_detail->prix_analyse];     
      
        return response()->json(array($data));
    }


    public function save_analyse(Request $request)
    {
        $this->CaisseAuthCheck();
        $tel=$request->telephone;

        if ($tel) {
        $data['telephone']=$request->telephone; 
        $data['nom_patient']=$request->nom_patient;
        $data['prenom_patient']=$request->prenom_patient; 
            $get_patient=DB::table('tbl_patient')->where('telephone',$tel)->first();

              if ($get_patient){
                  return back()->withInput()->with('error', 'Echec de validation : Veuillez rechercher le patient car il existe déjà sous le numéro renseigné');
              }
        $patient_id = DB::table('tbl_patient')->insertGetId($data);
        }else{
        $patient_id=$request->patient_id;
        }

        $datap['patient_id']=$patient_id; 
        $datap['id_centre']=$request->centre_id;
        $datap['user_id']=$request->specialiste;
        if ($request->id_type_analyse) {
        $datap['id_type_analyse']=$request->id_type_analyse; 
        $datap['prix']=$request->prix;
        }else{
        $datap['analyse']=$request->analyse; 
        $datap['prix_manuel']=$request->prix_manuel; 
        }
        DB::table('tbl_analyse')->insertGetId($datap);

        Alert::success('Info', 'Analyse enregistré dans le système.');
           return Redirect::to ('/caisse-analyses');

    }

    public function record_prisenc()
    {
        $this->UserAuthCheck();
        $this->AccueilAuthCheck();
        return view('prise_enc.add_prise_enc');
    }
    public function record_demande_ext()
    {
        $this->UserAuthCheck();
        $this->AccueilAuthCheck();
        return view('Analys.add_analyse_ext');
    }

    
    public function save_prisenc(Request $request)
    {
        $this->UserAuthCheck(); 
        $this->AccueilAuthCheck();
            
            $tel=$request->telephone;

            if ($tel) {
            $data['telephone']=$request->telephone; 
            $data['nom_patient']=$request->nom_patient;
            $data['prenom_patient']=$request->prenom_patient; 
            $data['nip']=$request->nip; 
            $data['email_patient']=$request->email_patient; 
            $data['nationalite']=$request->nationalite;
            $data['smatrimonial']=$request->smatrimonial; 
            $data['contact_urgence']=$request->contact_urgence; 
            $data['datenais']=$request->datenais; 
            $data['adresse']=$request->adresse; 
                $get_patient=DB::table('tbl_patient')->where('telephone',$tel)->first();

                  if ($get_patient){
                      return back()->withInput()->with('error', 'Echec de validation : Veuillez rechercher le patient car il existe déjà sous le numéro renseigné');
                  }

            $patient_id = DB::table('tbl_patient')->insertGetId($data);
            }else{
            $patient_id=$request->patient_id;
            }

            $user_role_id=Session::get('user_role_id');
            $user_id=Session::get('user_id');
            $datap['user_role_id']=$user_role_id; 
            $datap['patient_id']=$patient_id; 
            $datap['user_id']=$user_id; 
            $datap['id_centre']=$request->centre_id;
            $datap['maux']=$request->maux; 
            $datap['temp']=$request->temp; 
            $datap['observation']=$request->observation; 
            $id_prise_en_charge = DB::table('tbl_prise_en_charge')->insertGetId($datap);

            $datac['id_prise_en_charge']=$id_prise_en_charge; 
            $datac['id_centre']=$request->centre_id;
            $id_prise_en_charge = DB::table('tbl_caisse_prise_en_charge')->insertGetId($datac);
            
            
            Alert::success('Info', 'Nouveau patient enregistré dans les prises en charges.');
               return Redirect::to ('/prises-en-charges');
    }
   
    public function saveStep1(Request $request)
    {
        $this->UserAuthCheck(); 
        $this->AccueilAuthCheck();
    
        $request->validate([
            'maux' => 'required|string',
            'observation' => 'required|string',
            'sexe_patient' => 'required|in:F,M',
        ]);

        $user_id=Session::get('user_id'); 
        $userCentre = DB::table('users')
            ->join('tbl_centre', 'users.id_centre', '=', 'tbl_centre.id_centre') 
            ->where('users.user_id', $user_id)
            ->select('users.user_id', 'users.id_centre', 'users.user_role_id', 'tbl_centre.nom_centre') 
            ->first();
    
        if (!$userCentre) {
            return back()->with('error', 'Erreur : Impossible de récupérer le centre de l’utilisateur.');
        }
    
    //    Génération N° du dossier des patients
    // Extraire les trois premières lettres du deuxième mot du centre 
    $centreWords = explode(' ', $userCentre->nom_centre); // Séparer les mots du nom du centre
    $centreAbbreviation = isset($centreWords[1]) 
        ? strtoupper(substr($centreWords[1], 0, 3)) 
        : strtoupper(substr($centreWords[0], 0, 3)); 

    $dateTime = Carbon::now('Africa/Lagos')->format('Y/m/d/Hi'); 
    $numeroDossier = $centreAbbreviation . '/' . str_replace('/', '/', $dateTime); 
        $patientData = [
            'sexe_patient' => $request->sexe_patient,
            'dossier_numero' => $numeroDossier,
            'pcreated_at' => now(),
            'pupdated_at' => now(),
        ];
        // dd($patientData);
        $patient_id = DB::table('tbl_patient')->insertGetId($patientData);
       
        $priseEnChargeData = [
        'patient_id' => $patient_id, 
        'maux' => $request->maux,
        'observation' => $request->observation,
        'user_id' => $userCentre->user_id, 
        'id_centre' => $userCentre->id_centre, 
        'user_role_id' => $userCentre->user_role_id, 
        'created_at' => now(),
        'updated_at' => now(),
        ];
    
    //   dd($priseEnChargeData);
        DB::table('tbl_prise_en_charge')->insert($priseEnChargeData);
    
      if ($request->has('next')) {
        session(['patient_id' => $patient_id]);
            return redirect()->route('save.step2');
        }
        Alert::success('Info', 'Données enregistrées avec succès. Vous pourrez compléter les informations ultérieurement.');
         return Redirect::to ('/prises-en-charges');
    }

    public function showStep2Form()
    {
        $this->UserAuthCheck();
        $this->AccueilAuthCheck();
        return view('prise_enc.add_prise_enc_step2');
    }

       public function saveStep2(Request $request)
    {
        $this->UserAuthCheck(); 
        $this->AccueilAuthCheck();
    
       
        $request->validate([
            'email_patient' => 'nullable|email',
            'adresse' => 'required|string',
            'datenais' => 'required|date',
            'smatrimonial'=>'required|string',
            'nationalite'=>'required|string',
            'gsang'=>'required|string',
            'nom_patient'=>'required|string',
            'prenom_patient'=>'required|string',
            'nip'=>'required|integer',
            'contact_urgence'=>'required|integer',
            'telephone'=>'required|integer',
            'temp'=>'required|integer',

        ]);
    
       $patientId = session('patient_id');
    
        if (!$patientId) {
            return redirect()->route('save.step1')->with('error', 'Impossible de compléter les informations. Veuillez recommencer.');
        }
    
        DB::table('tbl_patient')
            ->where('patient_id', $patientId)
            ->update([
                'email_patient' => $request->email_patient,
                'adresse' => $request->adresse,
                'datenais' => $request->datenais,
                'smatrimonial' => $request->smatrimonial,
                'nationalite' => $request->nationalite,
                'gsang'=>$request->gsang,
                'telephone'=>$request->telephone,
                'nom_patient'=>$request->nom_patient,
                'prenom_patient'=>$request->prenom_patient,
                'nip'=>$request->nip,
                'contact_urgence'=>$request->contact_urgence,
                    ]);
                    DB::table('tbl_prise_en_charge')->updateOrInsert(
                        ['patient_id' => $patientId], // Condition : vérifier si patient_id existe
                        [
                            'temp' => $request->temp,   // Mettre à jour ou insérer la température
                            'updated_at' => now(),
                        ]
                    );
    
        session()->forget('patient_id');
        Alert::success('Info', 'Données enregistrées avec succès.');
        return Redirect::to ('/prises-en-charges');
    }
    public function patientEdit($id_prise_en_charge, $patient_id)
    {
        $all_details = DB::table('tbl_prise_en_charge')
                        ->join('tbl_patient','tbl_prise_en_charge.patient_id',"=",'tbl_patient.patient_id')
                        ->where('tbl_patient.patient_id', $patient_id)
                        ->where('id_prise_en_charge', $id_prise_en_charge)
                        ->first();

        return view('prise_enc.update_prise_enc', compact('all_details'));                
    }
    public function patientUpdate(Request $request, $patient_id)
    {
        $this->UserAuthCheck(); 
        $this->AccueilAuthCheck();
        // dd($request->all());
        $validatedData = $request->validate([
            'dossier_numero'=>'required|string',
            'email_patient' => 'required|email',
            'adresse' => 'required|string',
            'sexe_patient' => 'required|string',
            'maux' => 'required|string',
            'observation' => 'required|string',
            'datenais' => 'required|date',
            'smatrimonial'=>'required|string',
            'nationalite'=>'required|string',
            'gsang'=>'required|string',
            'nom_patient'=>'required|string',
            'prenom_patient'=>'required|string',
            'nip'=>'required|integer',
            'contact_urgence'=>'required|string',
            'telephone'=>'required|string',
            'temp'=>'required|integer',
        ]);
// dd($validatedData);
$patientExists = DB::table('tbl_patient')
->where('patient_id', $patient_id)
->exists();

$consultationExists = DB::table('tbl_prise_en_charge')
                        ->where('patient_id', $patient_id)
                        ->exists();
// dd($patientExists, $consultationExists);
       
            DB::transaction(function () use ($validatedData, $patient_id) {
                // Mettre à jour les informations dans la table tbl_patient
                DB::table('tbl_patient')
                ->where('patient_id', $patient_id)
                ->update([
                    'dossier_numero' => $validatedData['dossier_numero'],
                    'nom_patient' => $validatedData['nom_patient'],
                    'prenom_patient' => $validatedData['prenom_patient'],
                    'email_patient' => $validatedData['email_patient'],
                    'adresse' => $validatedData['adresse'],
                    'nip' => $validatedData['nip'],
                    'telephone' => $validatedData['telephone'],
                    'contact_urgence' => $validatedData['contact_urgence'],
                    'sexe_patient' => $validatedData['sexe_patient'],
                    'datenais' => $validatedData['datenais'],
                    'smatrimonial' => $validatedData['smatrimonial'],
                    'nationalite' => $validatedData['nationalite'],
                    'gsang' => $validatedData['gsang'],

                    'pupdated_at' => now(),
                ]);
                DB::table('tbl_prise_en_charge')
                ->where('patient_id', $patient_id)
                ->update([
                    'maux' => $validatedData['maux'],
                    'observation' => $validatedData['observation'],
                    'temp' => $validatedData['temp'],
                    'updated_at' => now(),
                ]);
                });

            Alert::success('Info', 'Les Informations mises à jours avec succès');
        return Redirect::to ('/prises-en-charges');

    }
    
    public function caisse_conslt()
    {
        $this->UserAuthCheck();
        $this->CaisseAuthCheck();
        $centre_id=Session::get('centre_id');
        $all_consulti=DB::table('tbl_caisse_prise_en_charge')  
                ->join('tbl_prise_en_charge','tbl_caisse_prise_en_charge.id_prise_en_charge','=','tbl_prise_en_charge.id_prise_en_charge')
                ->join('tbl_patient','tbl_prise_en_charge.patient_id','=','tbl_patient.patient_id')
                ->where('frais_consultation',NULL)
                ->where('tbl_caisse_prise_en_charge.id_centre',$centre_id)
                ->select('tbl_prise_en_charge.*','tbl_patient.*')
                ->get(); 

        $all_consultp=DB::table('tbl_caisse_prise_en_charge')
                ->join('tbl_prise_en_charge','tbl_caisse_prise_en_charge.id_prise_en_charge','=','tbl_prise_en_charge.id_prise_en_charge')
                ->join('tbl_patient','tbl_prise_en_charge.patient_id','=','tbl_patient.patient_id')
                ->where('frais_consultation','!=',NULL)
                ->where('tbl_caisse_prise_en_charge.id_centre',$centre_id)
                ->select('tbl_prise_en_charge.*','tbl_patient.*')
                ->get();



        return view('prise_enc.caisse_consultation')->with(array(
                    'all_consultp'=>$all_consultp,             
                    'all_consulti'=>$all_consulti,             
                ));;
    }
    public function caisse_demande_ext()
    {
        $this->UserAuthCheck();
        $this->CaisseAuthCheck();
        $centre_id=Session::get('centre_id');
        $all_demand_np=DB::table('tbl_demande_ext')
                ->join('tbl_patient','tbl_demande_ext.patient_id','=','tbl_patient.patient_id')
                ->where('last_demande_user_id',2)
                ->where('is_payed',0)
                ->join('services','tbl_demande_ext.services_id','=','services.services_id')
                ->where('tbl_demande_ext.centre_id',$centre_id)
                ->select('tbl_demande_ext.*','services.service as nom_service','tbl_patient.*')
                ->get(); 

        $all_demand_p=DB::table('tbl_demande_ext')
                ->join('tbl_patient','tbl_demande_ext.patient_id','=','tbl_patient.patient_id')
                ->where('is_payed',1)
                ->join('services','tbl_demande_ext.services_id','=','services.services_id')
                ->where('tbl_demande_ext.centre_id',$centre_id)
                ->select('tbl_demande_ext.*','services.service as nom_service','tbl_patient.*')
                ->get(); 
      
        $all_consultp=DB::table('tbl_caisse_prise_en_charge')
                ->join('tbl_prise_en_charge','tbl_caisse_prise_en_charge.id_prise_en_charge','=','tbl_prise_en_charge.id_prise_en_charge')
                ->join('tbl_patient','tbl_prise_en_charge.patient_id','=','tbl_patient.patient_id')
                ->where('frais_consultation','!=',NULL)
                ->where('tbl_caisse_prise_en_charge.id_centre',$centre_id)
                ->select('tbl_prise_en_charge.*','tbl_patient.*')
                ->get();



        return view('Analys.caisse_analyse')->with(array(
                    'all_consultp'=>$all_consultp,
                    'all_demand_p' =>$all_demand_p,             
                    'all_demand_np'=>$all_demand_np,
                ));;
    }



    public function pay_consult(Request $request)
    {
        $this->UserAuthCheck();
        $this->CaisseAuthCheck();
        $patient=DB::table('tbl_caisse_prise_en_charge')  
                ->join('tbl_prise_en_charge','tbl_caisse_prise_en_charge.id_prise_en_charge','=','tbl_prise_en_charge.id_prise_en_charge')
                ->join('tbl_patient','tbl_prise_en_charge.patient_id','=','tbl_patient.patient_id')
                ->where('tbl_caisse_prise_en_charge.id_prise_en_charge',$request->id_prise_en_charge)
                ->first();

       

        $user_role_id=Session::get('user_role_id');
        $user_id=Session::get('user_id');
        $data['id_prise_en_charge']=$request->id_prise_en_charge; 
        $data['frais_consultation']=$request->frais_consultation;
        $data['user_role_id']=$user_role_id;
        $data['user_id']=$user_id;
        DB::table('tbl_caisse_prise_en_charge')
        ->where('id_prise_en_charge',$request->id_prise_en_charge)
        ->update($data);

        
       
        DB::table('tbl_prise_en_charge')
        ->where('id_prise_en_charge',$request->id_prise_en_charge)
        ->update(['etat_consultation'=>1]);

    Alert::success('Info', $patient->prenom_patient.' '.$patient->nom_patient.' a payé ses frais de consultation');
        return Redirect::to ('/caisse-consultations');
    }


    public function caisse_hospt()
    {
        $this->UserAuthCheck();
        $this->CaisseAuthCheck();
        $centre_id=Session::get('centre_id');
        $all_hospiti=DB::table('tbl_caisse_prise_en_charge')  
                ->join('tbl_prise_en_charge','tbl_caisse_prise_en_charge.id_prise_en_charge','=','tbl_prise_en_charge.id_prise_en_charge')
                ->join('tbl_patient','tbl_prise_en_charge.patient_id','=','tbl_patient.patient_id')
                ->where('tbl_caisse_prise_en_charge.id_centre',$centre_id)
                ->select('tbl_prise_en_charge.*','tbl_patient.*')
                ->get(); 

        $all_hospitp=DB::table('tbl_caisse_prise_en_charge')
                ->join('tbl_prise_en_charge','tbl_caisse_prise_en_charge.id_prise_en_charge','=','tbl_prise_en_charge.id_prise_en_charge')
                ->join('tbl_patient','tbl_prise_en_charge.patient_id','=','tbl_patient.patient_id')
                ->where('frais_hospitalisation','!=',Null)
                ->where('tbl_caisse_prise_en_charge.id_centre',$centre_id)
                ->select('tbl_prise_en_charge.*','tbl_patient.*')
                ->get();



        return view('prise_enc.caisse_hospitalisation')->with(array(
                    'all_hospiti'=>$all_hospiti,             
                    'all_hospitp'=>$all_hospitp,             
                ));;
    }
    

    public function save_chambre(Request $request)
    {
    $this->UserAuthCheck(); 
    $this->AccueilAuthCheck();
                           
    $data['libelle_chambre']=$request->libelle_chambre; 
    $data['type_chambre']=$request->type_chambre; 
    $data['service']=$request->id_services; 
    $data['is_vip']=$request->is_vip; 
    $nbre_lits=$request->nbre_lit;
//   dd($data);
  
    $chambre_id = DB::table('tbl_chambre')->insertGetId($data);

    for ($i=0; $i < $nbre_lits ; $i++) { 
    $datac['id_chambre']=$chambre_id;
    $datac['lit']="lit".$i+1; 
    DB::table('tbl_lits')->insertGetId($datac);
    }

    Alert::success('Info', 'Nouvelle chambre enregistrée');
    return Redirect::to ('/dashboard');
                

    }


    public function hospitaliser(Request $request)
    {
    $this->UserAuthCheck(); 
    $this->AccueilAuthCheck();

    $id_consultation=$request->id_consultation;
    $id_lit=$request->id_lit;

    DB::table('tbl_consultation')
            ->where('id_consultation',$id_consultation)
            ->update(['id_lit'=>$id_lit]);

    DB::table('tbl_lits')
            ->where('id_lit',$id_lit)
            ->update(['statut'=>1]);

     Alert::success('Info', 'Le patient a été hospitalisé.');
               return Redirect::to ('/dashboard');
    }

    public function save_demande_ext(Request $request)
    {
    $this->UserAuthCheck(); 
    $this->AccueilAuthCheck();
    $user_role_id=Session::get('user_role_id');
    $user_id=Session::get('user_id');
    $userCentre = DB::table('users')
                 ->join('tbl_centre', 'users.id_centre', '=', 'tbl_centre.id_centre') 
                 ->where('users.user_id', $user_id)
                 ->select('users.user_id', 'users.id_centre', 'users.user_role_id', 'tbl_centre.nom_centre') 
                 ->first();

    // if (!$userCentre) {
    //         return back()->with('error', 'Erreur : Impossible de récupérer le centre de l’utilisateur.');
    //             }
    $centreWords = explode(' ', $userCentre->nom_centre); // Séparer les mots du nom du centre
    $centreAbbreviation = isset($centreWords[1]) 
        ? strtoupper(substr($centreWords[1], 0, 3)) 
        : strtoupper(substr($centreWords[0], 0, 3)); 

    $dateTime = Carbon::now('Africa/Lagos')->format('Y/m/d/Hi'); 
    $numeroDossier = $centreAbbreviation . '/' . str_replace('/', '/', $dateTime);
            $tel=$request->telephone;

            if ($tel) {
            $data = [
            'dossier_numero'=>$numeroDossier,    
            'telephone'=>$request->telephone, 
            'nom_patient'=>$request->nom_patient,
            'prenom_patient'=>$request->prenom_patient,
            'sexe_patient' =>$request->sexe_patient,
            'nip'=>$request->nip, 
            // 'centre_id'->centre_id,
            
            'nationalite'=>$request->nationalite,
            'datenais'=>$request->datenais ]; 
// dd($data);

                $get_patient=DB::table('tbl_patient')->where('telephone',$tel)->first();

                  if ($get_patient){
                      return back()->withInput()->with('error', 'Echec de validation : Veuillez rechercher le patient car il existe déjà sous le numéro renseigné');
                  }
            $patient_id = DB::table('tbl_patient')->insertGetId($data);
            }else{
            $patient_id=$request->patient_id;
            }
            $datap = [
            'user_role_id' =>$user_role_id, 
            'patient_id' => $patient_id, 
            'user_id'=>$user_id,
            'last_demande_user_id'=>$user_role_id,
            'centre_id'=>$request->centre_id,
            'services_id'=>$request->services_id 
            ];
            
            // dd($datap);
             
            $id_demande = DB::table('tbl_demande_ext')->insertGetId($datap);

            $datac = [
           'id_demande'=> $id_demande,
           'centre_id'=> $request->centre_id,
           'services_id'=> $request->services_id,
           'patient_id'=> $patient_id, ];
            
            // dd($datac);


            $id_demande = DB::table('tbl_analyse_payed')->insertGetId($datac);
            
            
            Alert::success('Info', 'Nouveau patient enregistré pour demandes externes.');
               return redirect()->back();
                

    }
    public function demande_ext()
    {
        $this->UserAuthCheck();
        $this->AccueilAuthCheck();
        // $this->CaisseAuthCheck();
        $centre_id=Session::get('centre_id');
        $new_demand=DB::table('tbl_demande_ext')
                ->join('tbl_patient','tbl_demande_ext.patient_id','=','tbl_patient.patient_id')
                ->join('users','tbl_demande_ext.user_id','=','users.user_id')
                ->join('tbl_centre','tbl_demande_ext.centre_id','=','tbl_centre.id_centre')
                ->join('services','tbl_demande_ext.services_id','=','services.services_id')
                ->where('tbl_demande_ext.last_demande_user_id',0)
                ->where('tbl_demande_ext.centre_id',$centre_id)
                ->select('tbl_demande_ext.*','services.service as nom_service','tbl_patient.*')
                // ->orderBy('etat_consultation','DESC')
                ->get(); 

        $all_demand=DB::table('tbl_demande_ext')
                ->join('tbl_patient','tbl_demande_ext.patient_id','=','tbl_patient.patient_id')
                ->where('last_demande_user_id',2)
                ->join('services','tbl_demande_ext.services_id','=','services.services_id')
                ->where('tbl_demande_ext.centre_id',$centre_id)
                ->select('tbl_demande_ext.*','services.service as nom_service','tbl_patient.*')
                ->get();

        $all_patient_h=DB::table('tbl_consultation')
                  ->join('tbl_lits','tbl_consultation.id_lit','=','tbl_lits.id_lit')
                  ->join('tbl_chambre','tbl_lits.id_chambre','=','tbl_chambre.id_chambre')
                  ->join('tbl_prise_en_charge','tbl_consultation.id_prise_en_charge','=','tbl_prise_en_charge.id_prise_en_charge')              
                  ->join('tbl_patient','tbl_prise_en_charge.patient_id','=','tbl_patient.patient_id')
                  ->where('is_hospitalisation',1)
                  ->where('tbl_prise_en_charge.id_centre',$centre_id)
                  ->select('tbl_prise_en_charge.*','tbl_patient.*','tbl_consultation.*','tbl_chambre.*','tbl_lits.*')
                  ->groupBy('tbl_prise_en_charge.patient_id')
                  ->orderBy('etat_consultation','DESC')
                  ->get();

        $all_patient_u = DB::table('tbl_prise_en_charge')
                   ->join('tbl_patient','tbl_prise_en_charge.patient_id','=','tbl_patient.patient_id')
                    ->where('nom_patient', '')
                    ->orderBy('pcreated_at')
                    ->get();

        return view('Analys.all_demande_ext')->with(array(
                    'new_demand'=>$new_demand,             
                    'all_demand'=>$all_demand,             
                    'all_patient_h'=>$all_patient_h,             
                    'all_patient_u'=>$all_patient_u,             
                ));
    }

}
