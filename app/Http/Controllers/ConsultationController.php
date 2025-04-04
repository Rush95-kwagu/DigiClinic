<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Redirect; 
use Illuminate\Validation\ValidationException;


class ConsultationController extends Controller
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

    public function AccueilAuthCheck()
   {
    $user_role_id=Session::get('user_role_id');
    if ($user_role_id == 0) {
        return;
        }
        else 
        {
            return Redirect::to('/')->send();
        }

    }

   
    public function SpecialisteAuthCheck()
   {
    $user_role_id=Session::get('user_role_id');
    if ($user_role_id != 0 || $user_role_id != 1) {
        return;
        }
        else 
        {
            return Redirect::to('/')->send();
        }

    }
    public function send_consult(Request $request)
    {
            $this->UserAuthCheck(); 
            $this->AccueilAuthCheck();
            $user_id=$request->specialiste;
            $id_prise_en_charge=$request->id_prise_en_charge;  
            $get_user_role=DB::table('users')
                            ->join('personnel','users.email','=','personnel.email')
                            ->select('users.*','personnel.*')
                            ->where('user_id',$user_id)
                            ->first();

            $user_role_id=$get_user_role->user_role_id;
            $qualification=$get_user_role->qualification;
            $prenom=$get_user_role->prenom;
            $nom=$get_user_role->nom;

            $data['id_prise_en_charge']=$id_prise_en_charge; 
            $data['user_id']=$user_id; 
            $data['user_role_id']=$user_role_id;
            
            DB::table('tbl_consultation')->insertGetId($data);

            $datac['last_consult_user_role_id']=$user_role_id; 
            $datac['last_consult_user_id']=$user_id; 
            DB::table('tbl_prise_en_charge')
                ->where('id_prise_en_charge',$id_prise_en_charge)
                ->update($datac);
   
            Alert::success('Info', 'Patient affecté pour consultation vers '.$qualification.' '.$prenom.' '.$nom);
               return Redirect::to ('/prises-en-charges');
                

    }
    public function send_demande_ext(Request $request)
    {
            $this->UserAuthCheck(); 
            $this->AccueilAuthCheck();
            $user_id=$request->specialiste;
            $id_demande=$request->id_demande;  
            $get_user_role=DB::table('users')
                            ->join('personnel','users.email','=','personnel.email')
                            ->select('users.*','personnel.*')
                            ->where('user_id',$user_id)
                            ->first();

            $user_role_id=$get_user_role->user_role_id;
            $qualification=$get_user_role->qualification;
            $prenom=$get_user_role->prenom;
            $nom=$get_user_role->nom;


            $datad = [
                    'last_demande_user_id'=> $user_id 
                ]; 
            DB::table('tbl_demande_ext')
                ->where('id_demande',$id_demande)
                ->update($datad);
   
            Alert::success('Info', 'Demande transmise à la '.$qualification.' de '.$prenom.' '.$nom);
               return Redirect::to ('/demande-externe');
                

    }

    public function consultation()
    {
        $this->SpecialisteAuthCheck();
        $user_id=Session::get('user_id');
        $centre_id=Session::get('centre_id');
        $all_patient_nt = DB::table('tbl_consultation')
                        ->join('tbl_prise_en_charge', 'tbl_consultation.id_prise_en_charge', '=', 'tbl_prise_en_charge.id_prise_en_charge')              
                        ->join('tbl_patient', 'tbl_prise_en_charge.patient_id', '=', 'tbl_patient.patient_id')
                        ->where('etat_traitement', 0)
                        ->where([
                            ['tbl_consultation.user_id', $user_id],
                            ['tbl_prise_en_charge.id_centre', $centre_id],
                             ])
                        ->select('tbl_prise_en_charge.*', 'tbl_patient.*', 'tbl_consultation.*')
                        ->orderBy('etat_consultation', 'DESC')
                        ->get();
        $totalPatient_nt = $all_patient_nt->count();


        $all_patient_t=DB::table('tbl_consultation')
                ->join('tbl_prise_en_charge','tbl_consultation.id_prise_en_charge','=','tbl_prise_en_charge.id_prise_en_charge')             
                ->join('tbl_patient','tbl_prise_en_charge.patient_id','=','tbl_patient.patient_id')
                ->where([
                      ['tbl_consultation.user_id',$user_id],
                      ['tbl_prise_en_charge.id_centre',$centre_id],
                  ]) 
                ->where('etat_hospitalisation',1)
                ->select('tbl_prise_en_charge.*','tbl_patient.*','tbl_consultation.*')
                ->groupBy('tbl_prise_en_charge.patient_id')
                ->orderBy('etat_consultation','DESC')
                ->get();

        $totalPatient_t = $all_patient_t->count();


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

        $totalPatient_h = $all_patient_h->count();

        $all_patient_ob=DB::table('tbl_consultation')
                ->join('tbl_prise_en_charge','tbl_consultation.id_prise_en_charge','=','tbl_prise_en_charge.id_prise_en_charge')             
                ->join('tbl_patient','tbl_prise_en_charge.patient_id','=','tbl_patient.patient_id')
                ->where([
              ['tbl_consultation.user_id',$user_id],
              ['tbl_prise_en_charge.id_centre',$centre_id],
          ]) 
        ->where('tbl_prise_en_charge.etat_hospitalisation',2)
        ->select('tbl_prise_en_charge.*','tbl_patient.*','tbl_consultation.*')
        ->groupBy('tbl_prise_en_charge.patient_id')
        ->orderBy('etat_consultation','DESC')
        ->get();

        $totalPatient_ob = $all_patient_ob->count();
                  



        return view('Consult.patients_nt')->with(array(
                    'all_patient_nt'=>$all_patient_nt,             
                    'all_patient_t'=>$all_patient_t,             
                    'all_patient_h'=>$all_patient_h, 
                    'all_patient_ob'=>$all_patient_ob, 
                    'totalPatient_ob' => $totalPatient_ob,            
                    'totalPatient_nt' => $totalPatient_nt,            
                    'totalPatient_t' => $totalPatient_t,
                    'totalPatient_h' => $totalPatient_h            

                ));
    }

    public function gestion_analyses()
    {
        $this->SpecialisteAuthCheck();
        
        
        $user_id=Session::get('user_id');
        
        $centre_id=Session::get('centre_id');
        $all_analyse_nt=DB::table('tbl_analyse')       
                ->leftjoin('tbl_patient','tbl_analyse.patient_id','=','tbl_patient.patient_id') 
                ->leftjoin('tbl_type_analyse','tbl_analyse.id_type_analyse','=','tbl_type_analyse.id_type_analyse')
               
                ->where([
                      ['user_id',$user_id],
                      ['tbl_analyse.id_centre',$centre_id],
                  ]) 
                 ->where('statut_analyse',0)
               
                ->select('tbl_analyse.*','tbl_patient.*','tbl_type_analyse.*')
                ->orderBy('tbl_analyse.created_at', 'DESC')

                ->get(); 
       
        $all_analyse_t=DB::table('tbl_analyse')       
                ->join('tbl_patient','tbl_analyse.patient_id','=','tbl_patient.patient_id')
                ->join('tbl_type_analyse','tbl_analyse.id_type_analyse','=','tbl_type_analyse.id_type_analyse')
                ->where('statut_analyse',1)
                ->where([
                      ['user_id',$user_id],
                      ['tbl_analyse.id_centre',$centre_id],
                  ]) 
                ->select('tbl_analyse.*','tbl_patient.*','tbl_type_analyse.*')
                
                ->orderBy('tbl_analyse.created_at', 'DESC')

                ->get(); 

        $all_demand_p=DB::table('tbl_analyse_payed')
                ->join('tbl_patient','tbl_analyse_payed.patient_id','=','tbl_patient.patient_id')
                ->join('tbl_prestation','tbl_analyse_payed.prestation_id','=','tbl_prestation.prestation_id')
                ->where('tbl_analyse_payed.centre_id',$centre_id)
                ->select(
                    'tbl_analyse_payed.*',
                    'tbl_patient.*',
                    'tbl_prestation.*'
                    )
                ->get();  

        return view('Analys.gestion_analyse')->with(array(
                    'all_analyse_nt'=>$all_analyse_nt,             
                    // 'all_analyse_nt'=>$all_analyse_np,             
                    'all_analyse_t'=>$all_analyse_t,   
                    'all_demand_p'=>$all_demand_p,
                ));;
    }


    function getPatientAnalyse($id){
        
       // Récupérer les informations du patient
            $data = DB::table('tbl_patient as p')
            ->leftJoin('tbl_analyse_payed as a', 'p.patient_id', '=', 'a.patient_id')
            ->leftJoin('tbl_type_analyse as pr', 'a.prestation_id', '=', 'pr.id_type_analyse')
            ->where('p.patient_id', $id)
            ->select(
                'p.patient_id',
                'p.nom_patient as nom',
                'p.prenom_patient as prenom'
            )
            ->first();

            // Récupérer les analyses du patient
            $analyses = DB::table('tbl_analyse_payed as a')
            ->leftJoin('tbl_type_analyse as pr', 'a.prestation_id', '=', 'pr.id_type_analyse')
            ->leftJoin('tbl_resultats_analyse as r', 'a.payed_analyse_id', '=', 'r.id_demande') // Ajout de la jointure
            ->where('a.patient_id', $id)
            ->select(
                'a.payed_analyse_id as analyse_id',
                'a.date_paiement',
                'a.montant_total as montant',
                'pr.id_type_analyse',
                'pr.libelle_analyse',
                'pr.prix_analyse as prix',
                'r.*',
            )
            ->get();
            // Combiner les résultats
            $result = [
            'patient_id' => $data->patient_id,
            'nom' => $data->nom,
            'prenom' => $data->prenom,
            'analyses' => $analyses
            ];


        return view('Analys.patient_analyse_details')->with(array(
            'patient'=>$result
        ));
    }

    function editAnalyseResult($id,$patient_id){
        
        $analysis = DB::table('tbl_analyse_payed as a')
        ->leftJoin('tbl_type_analyse as pr', 'a.prestation_id', '=', 'pr.id_type_analyse')
        ->where('a.payed_analyse_id', $id)
        ->select(
            'a.payed_analyse_id as analyse_id',
            'a.treated',
            'a.date_paiement',
            'a.montant_total as montant',
            'pr.id_type_analyse',
            'pr.libelle_analyse',
            'pr.prix_analyse as prix'
        )
        ->first();

            if ( $analysis) {
                // 2ème requête : Récupérer les paramètres associés à cette analyse
                $parameters = DB::table('tbl_analyse_parametres')
                ->where('tbl_type_analyse_id', $analysis->id_type_analyse)
                ->where('genre', "FEMME")
                ->select(
                    'id as parametre_id',
                    'element',
                    'libelle_norme',
                    'valeur_norme',
                    'genre'
                )
                ->get();

            }
      
            // Ajouter les paramètres à l'analyse
            $analysis->parametres = $parameters;          
           
        return view('Analys.edit_analyse_result')->with(array(
            'analyse'=>$analysis,
            'patient_id'=>$patient_id
        ));
    }


    function storeResult(Request $request){
        
        $user_id=$request->user_id;
        $user_role_id=$request->user_role_id;

        //dd($request->all());
        $data=collect();
        if ($request->elements) {
            foreach ($request->elements as $key => $value) {
                $data->push([
                    "element"=>$value,
                    "result"=>$request->results[$key],
                    "norme"=>$request->normes[$key],
                ]);
            }
        }

        $analyse = DB::table('tbl_analyse_payed as a')
        ->leftJoin('tbl_type_analyse as pr', 'a.prestation_id', '=', 'pr.id_type_analyse')
        ->leftJoin('tbl_patient as p', 'a.patient_id', '=', 'p.patient_id') // Jointure avec la table des patients
        ->where('pr.id_type_analyse', $request->id_type_analyse)
        ->select(
            // Informations du patient
            'p.patient_id as patient_id',
            'p.nom_patient',
            'p.prenom_patient',

            // Informations de l'analyse
            'a.payed_analyse_id as analyse_id',
            'a.date_paiement',
            'a.montant_total as montant',
            'pr.id_type_analyse',
            'pr.libelle_analyse',
            'pr.prix_analyse as prix',
        )
        ->first(); // Un seul résultat

      

            $pdf = Pdf::loadView('Resultat.pdf-ext', [
            "element"=>$analyse->libelle_analyse,
            "patient"=>$analyse->nom_patient. " ".$analyse->prenom_patient,
            "resultats"=>$data,
            "decision"=>$request->decision,
            "observation"=>$request->observation
            ]);
            $name='Resultat_' . time(). '_.pdf';
            $path=storage_path('app/public/'.$name);
            
            $pdf->save($path);

            $get_user_role=DB::table('users')
            ->join('personnel','users.email','=','personnel.email')
            ->select('users.*','personnel.*')
            ->where('user_id',$user_id)
            ->first();

            $centre_id=Session::get('centre_id');


            DB::table('tbl_resultats_analyse')->insert([
                'id_demande' => $request->analyse_id, 
                'prestation_id' => $request->id_type_analyse, 
                'resultat' => $request->decision, 
                'path' => $name, 
                'observation' => $request->observation, 
                'content' => json_encode($data), 
                'personnel_id' => null, 
                'user_role_id' => $user_role_id,
                'personnel_id' => $user_id,
                'centre_id' => $centre_id
            ]);


            return redirect()->to(URL::to("gestion-analyses/".$request->patient_id));
        }

    public function traitement_analyse($id_analyse,$patient_id)
    {
        $this->SpecialisteAuthCheck();
        $user_id=Session::get('user_id');
    

        $all_details=DB::table('tbl_analyse')       
                ->leftjoin('tbl_patient','tbl_analyse.patient_id','=','tbl_patient.patient_id') 
                ->leftjoin('tbl_type_analyse','tbl_analyse.id_type_analyse','=','tbl_type_analyse.id_type_analyse')
                ->leftjoin('tbl_prise_en_charge','tbl_patient.patient_id','=','tbl_prise_en_charge.patient_id')              
                ->leftjoin('tbl_consultation','tbl_prise_en_charge.id_prise_en_charge','=','tbl_consultation.id_prise_en_charge')   
                ->where('tbl_patient.patient_id',$patient_id)
                ->select('tbl_analyse.*','tbl_patient.*','tbl_type_analyse.*','tbl_consultation.*','tbl_prise_en_charge.*')
                ->orderBy('tbl_analyse.created_at','DESC')
                ->get();
        
        return view('Analys.traitement_analyse')->with(array(
                    'all_details'=>$all_details,                         
                    'id_analyse'=>$id_analyse,                         
                ));;
    }
    
    public function traitement_patient($id_consultation,$patient_id)
    {
        $this->SpecialisteAuthCheck();
        $user_id=Session::get('user_id');
    
        $all_details = DB::table('tbl_prise_en_charge')
            ->leftjoin('tbl_patient', 'tbl_prise_en_charge.patient_id', '=', 'tbl_patient.patient_id')
            ->leftjoin('tbl_consultation', 'tbl_consultation.id_prise_en_charge', '=', 'tbl_prise_en_charge.id_prise_en_charge')
            ->leftjoin('tbl_ordo_consultation', 'tbl_ordo_consultation.id_consultation', '=', 'tbl_consultation.id_consultation')
            ->where('tbl_prise_en_charge.patient_id', $patient_id)
            ->select(
                    'tbl_prise_en_charge.*',
                    'tbl_patient.*',
                    'tbl_consultation.*',
                    'tbl_ordo_consultation.*',
                    'tbl_patient.datenais as patient_birthdate'
                    )
            ->orderBy('tbl_prise_en_charge.created_at', 'DESC')
            ->get()
            ->map(function ($item) {
            // Calcul de l'âge pour chaque résultat
            if (!empty($item->patient_birthdate)) {
                $birthdate = Carbon::parse($item->patient_birthdate);
                $age = $birthdate->diff(Carbon::now());
                if ($age->y < 1) {
                    $item->age_formatted = $age->m . ' mois';
                } else {
                    $item->age_formatted = $age->y . ' ans et ' . $age->m . ' mois';
                }
                if ($age->y < 1 && $age->m < 1) {
                    $item->age_formatted = $age->d . ' jours';
                }
            } else {
                $item->age_formatted = 'Date de naissance inconnue';
            }
            
            return $item;
        });
        
        $last_constance = DB::table('tbl_constantes')
                        ->join('tbl_consultation','tbl_constantes.id_consultation','=','tbl_consultation.id_consultation')
                        ->where('tbl_constantes.patient_id',$patient_id)
                        ->select(
                            'tbl_constantes.type',
                            'tbl_constantes.valeur',
                            'tbl_constantes.unite',
                            'tbl_constantes.created_at')
                        ->orderBy('created_at', 'DESC')
                        ->get()
                        ->groupBy('type')
                        ->map (function($items){
                            return $items->first();
                        });                
        return view('Consult.traitement_patient')->with(array(
                    'all_details'=>$all_details,                         
                    'id_consultation'=>$id_consultation,  
                    'last_constance'=>$last_constance,
                ));;
    }

    public function save_analyse_traitement (Request $request)
    {

        $user_id = $request->user_id;
        $id_centre = $request->id_centre;
        $analyse_resultat = $request->analyse_resultat;
        $id_analyse = $request->id_analyse;
        

        $dataA=array();
        $dataA['user_id']=$user_id;
        $dataA['id_centre']=$id_centre;
        $dataA['analyse_resultat']=$analyse_resultat;
        $dataA['statut_analyse']=1;

        $file=$request->file('analyse_fichier');
        if ($file) {
                $file_name=$file->getClientOriginalName();
                $ext=strtolower($file->getClientOriginalExtension());
                $file_full_name=$file_name;
                $upload_path= "Uploads/Analyses/";
                $file_url=$upload_path.$file_full_name;
                
                $success=$file->move($upload_path,$file_full_name);
                if ($success) {
            $dataA['analyse_fichier']=$file_url;
                    }
                }      
            DB::table('tbl_analyse')
                ->where('id_analyse',$id_analyse)
                ->update($dataA);


        $get_tabreactif=DB::table('tbl_cart_reactif')
                 ->join('tbl_reactif','tbl_reactif.reactif_id','=','tbl_cart_reactif.reactif_id')
                 ->select('tbl_cart_reactif.*','tbl_reactif.*')
                 ->where('user_id',$user_id)
                 ->get();

        $oddata=array();

          foreach ($get_tabreactif as $v_content) 
          {
            
            $oddata['user_id']=$user_id;
            $oddata['reactif_id']=$v_content->reactif_id;
            $oddata['id_analyse']=$v_content->id_analyse;
            $oddata['qty']=$v_content->qty;
            $oddata['id_centre']=$v_content->id_centre;
            $oddata['date_used']=$v_content->date;

            DB::table('tbl_reactif_used')
               ->insert($oddata);

            $product= DB::table('tbl_reactif')
                    ->where('reactif_id','=',$v_content->reactif_id)
                    ->decrement('stock', $v_content->qty);

          }

          DB::table('tbl_cart_reactif')
             ->where('user_id',$user_id)
             ->delete();
        
        Alert::success('Info Analyse', 'Analyse effectué');
        return Redirect::to('gestion-analyses');


    }

    public function save_traitement(Request $request)
    {
        $this->UserAuthCheck();
        $this->SpecialisteAuthCheck();

        // Récupération des données
        $decision = $request->specialiste;
        $id_consultation = $request->id_consultation;
        $id_prise_en_charge = $request->id_prise_en_charge;
        $patient_id = $request->patient_id;
        $ordonnance = $request->ordonnance;
        $observation = $request->observation;
        $diagnostic = $request->diagnostic;
        $file = $request->file('fichier_joint');

        // Données de base pour la consultation
        $consultData = [
            'diagnostic' => $diagnostic,
            'observation' => $observation,
            'etat_traitement' => 1 // Toujours à 1 quand traité
        ];

        // Gestion fichier joint
        if ($file) {
            $file_name = $file->getClientOriginalName();
            $upload_path = "Uploads/consultations/";
            $file_url = $upload_path.$file_name;
            
            if ($file->move($upload_path, $file_name)) {
                $consultData['fichier_joint'] = $file_url;
            }
        }

        // Décision de traitement
        switch ($decision) {
            case '0': // Hospitalisation
                return $this->traiterHospitalisation(
                    $patient_id,
                    $id_consultation,
                    $id_prise_en_charge,
                    $consultData,
                    $request->etat_hospitalisation,
                    $ordonnance
                );

            case '2': // Observation
                return $this->traiterObservation(
                    $id_consultation,
                    $id_prise_en_charge,
                    $consultData
                );

            default: // Affectation spécialiste
                return $this->traiterSpecialiste(
                    $decision,
                    $id_consultation,
                    $id_prise_en_charge,
                    $consultData
                );
        }
    }

    /**
     * Traitement pour la mise en observation
     */
    protected function traiterObservation($id_consultation, $id_prise_en_charge, $consultData)
    {
        DB::transaction(function () use ($id_consultation, $id_prise_en_charge, $consultData) {
            // tbl_consultation
            DB::table('tbl_consultation')
                ->where('id_consultation', $id_consultation)
                ->update(array_merge($consultData, [
                    'etat_traitement' => 1,
                    'is_hospitalisation' => 0
                ]));

            // tbl_prise_en_charge
            DB::table('tbl_prise_en_charge')
                ->where('id_prise_en_charge', $id_prise_en_charge)
                ->update([
                    'etat_hospitalisation' => 2,
                    'etat_consultation' => 1,
                    // 'is_hospitalisation' => 0
                ]);
        });

        Alert::success('Succès', 'Patient mis en observation');
        return Redirect::to('/consultations');
    }

    /**
     * Traitement pour l'hospitalisation
     */
    protected function traiterHospitalisation(
        $patient_id,
        $id_consultation,
        $id_prise_en_charge,
        $consultData,
        $etat_hospitalisation,
        $ordonnance
    ) {
        $patient = DB::table('tbl_patient')
            ->where('patient_id', $patient_id)
            ->first();

        DB::transaction(function () use ($id_consultation, $id_prise_en_charge, $consultData) {
            // tbl_consultation
            DB::table('tbl_consultation')
                ->where('id_consultation', $id_consultation)
                ->update(array_merge($consultData, [
                    'etat_consultation' => 0,
                    'is_hospitalisation' => 1
                ]));

            // tbl_prise_en_charge
            DB::table('tbl_prise_en_charge')
                ->where('id_prise_en_charge', $id_prise_en_charge)
                ->update([
                    'etat_hospitalisation' => 1,
                    'etat_consultation' => 0,
                    // 'is_hospitalisation' => 1,
                    'last_consult_user_id' => null,
                    'last_consult_user_role_id' => null
                ]);
        });

        // Génération ordonnance si clôture
        if ($etat_hospitalisation == 1) {
            $today = date('YmdHis');
            $num_ordo = $id_prise_en_charge.'-'.$id_consultation.'-'.$today;
            
            $id_ordo = DB::table('tbl_ordo_consultation')->insertGetId([
                'id_consultation' => $id_consultation,
                'ordonnance_consultation' => $ordonnance,
                'num_ordo' => $num_ordo
            ]);

            return Redirect::to('ordonnance/'.$id_ordo)
                ->with('success', 'Patient hospitalisé avec ordonnance');
        }

        Alert::success('Succès', 'Patient mis en hospitalisation');
        return Redirect::to('/consultations');
    }

    /**
     * Affectation à un spécialiste
     */
    protected function traiterSpecialiste($user_id, $id_consultation, $id_prise_en_charge, $consultData)
    {
        $specialiste = DB::table('users')
            ->join('personnel', 'users.email', '=', 'personnel.email')
            ->where('user_id', $user_id)
            ->first();

        DB::transaction(function () use ($user_id, $id_consultation, $id_prise_en_charge, $consultData, $specialiste) {
            // tbl_consultation
            DB::table('tbl_consultation')
                ->where('id_consultation', $id_consultation)
                ->update(array_merge($consultData, [
                    'etat_consultation' => 0,
                    'is_hospitalisation' => 0
                ]));

            // tbl_prise_en_charge
            DB::table('tbl_prise_en_charge')
                ->where('id_prise_en_charge', $id_prise_en_charge)
                ->update([
                    'etat_hospitalisation' => 0,
                    'etat_consultation' => 0,
                    // 'is_hospitalisation' => 0,
                    'last_consult_user_id' => $user_id,
                    'last_consult_user_role_id' => $specialiste->user_role_id
                ]);

            // Nouvelle consultation pour le spécialiste
            DB::table('tbl_consultation')->insert([
                'user_id' => $user_id,
                'user_role_id' => $specialiste->user_role_id,
                'id_prise_en_charge' => $id_prise_en_charge,
                'etat_consultation' => 0,
                'is_hospitalisation' => 0
            ]);
        });

        Alert::success('Succès', "Patient affecté à {$specialiste->qualification} {$specialiste->prenom} {$specialiste->nom}");
        return Redirect::to('/consultations');
    }

    public function make_ordonance (Request $request){

        $id_consultation=$request->id_consultation;
        $id_prise_en_charge=$request->id_prise_en_charge;
        $ordonnance_consultation=$request->ordonnance_consultation;
        $today=date('YmdHis');
        $num_ordo=$id_prise_en_charge.'-'.$id_consultation.'-'.$today;
        $data=array();
        $data['id_consultation']=$id_consultation;
        $data['ordonnance_consultation']=$ordonnance_consultation;
        $data['num_ordo']=$num_ordo;

        $id_ordo=DB::table('tbl_ordo_consultation')->insertGetId($data);

        $ordo_info=DB::table('tbl_ordo_consultation')
                  ->leftjoin('tbl_consultation','tbl_consultation.id_consultation','=','tbl_ordo_consultation.id_consultation')
                  ->leftjoin('tbl_prise_en_charge','tbl_prise_en_charge.id_prise_en_charge','=','tbl_consultation.id_prise_en_charge')
                  ->leftjoin('tbl_patient','tbl_patient.patient_id','=','tbl_prise_en_charge.patient_id')
                  ->select('tbl_ordo_consultation.*','tbl_consultation.*','tbl_prise_en_charge.*','tbl_patient.*')
                  ->where('tbl_ordo_consultation.id_consultation',$id_ordo)
                  ->first(); 


        $message='L\'ordonnance a été généré avec succès';
          return Redirect::to('ordonnance/'.$id_ordo)->with(array(
                    'message'=>$message,
                    
                    'ordo_info'=>$ordo_info,                       
                                                   
                ));    

      }


    public function update_constante (Request $request){
    $id_consultation=$request->id_consultation;
    $new_temp=$request->new_temp;
    $data['new_temp']=$new_temp;

    DB::table('tbl_consultation')
                ->where('id_consultation',$id_consultation)
                ->update($data);

            Alert::success('Info', 'Constante modifié avec succès');
               return Redirect::to ('/consultations');

    }
}
