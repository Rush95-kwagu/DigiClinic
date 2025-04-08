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
use SimpleSoftwareIO\QrCode\Facades\QrCode;


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

          Session::put('error','Vous devez être connecté(e) pour accéder à cette page');
            
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
          Session::put('error','Vous n\'êtes pas autorisé à accéder à cette page');

            return Redirect::to('/')->send();
        }

    }


    public function SpecialisteAuthCheck()
   {
    $user_role_id=Session::get('user_role_id');
    if ($user_role_id != 1 && $user_role_id != 0) {
        return;
        }
        else 
        {
          Session::put('error','Vous n\'êtes pas autorisé à accéder à cette page');

            return Redirect::to('/')->send();
        }

    }

    // Envoie de Patient pour consultation
    public function send_consult(Request $request)
    {
        $this->UserAuthCheck(); 
        $this->AccueilAuthCheck();
        $user_id = $request->specialiste;
        $id_prise_en_charge = $request->id_prise_en_charge;
        
         
  
        $get_user_role = DB::table('users')
                        ->join('personnel','users.email','=','personnel.email')
                        ->select('users.*','personnel.*')
                        ->where('user_id', $user_id)
                        ->first();
    
        $user_role_id = $get_user_role->user_role_id;
        $qualification = $get_user_role->qualification;
        $prenom = $get_user_role->prenom;
        $nom = $get_user_role->nom;
    
       
        $data = [
            'id_prise_en_charge' => $id_prise_en_charge,
            'user_id' => $user_id,
            'user_role_id' => $user_role_id
        ];
        
        
        $id_consultation = DB::table('tbl_consultation')->insertGetId($data);
        $patient_id = DB::table('tbl_prise_en_charge')
               ->where('id_prise_en_charge', $id_prise_en_charge)
               ->value('patient_id');
        
        DB::table('tbl_constantes')
                ->where('patient_id', $patient_id)
                ->where('id_prise_en_charge', $id_prise_en_charge)
                ->where('id_consultation',0)
                ->update(['id_consultation' => $id_consultation]);
    
      
        $datac = [
            'last_consult_user_role_id' => $user_role_id,
            'last_consult_user_id' => $user_id,
            'etat_consultation'=>1
        ];
        
        DB::table('tbl_prise_en_charge')
            ->where('id_prise_en_charge', $id_prise_en_charge)
            ->update($datac);
            
        Alert::success('Info', 'Patient affecté pour consultation vers '.$qualification.' '.$prenom.' '.$nom);
        return Redirect::to('/prises-en-charges');
    }

    // Envoie de demande externe d'analyse à la caisse pr paiement

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
        $this->UserAuthCheck();
        $this->SpecialisteAuthCheck();
        $user_id=Session::get('user_id');
        $centre_id=Session::get('centre_id');
        $all_patient_nt = DB::table('tbl_consultation')
                    ->join('tbl_prise_en_charge','tbl_consultation.id_prise_en_charge','=','tbl_prise_en_charge.id_prise_en_charge')
                    ->join('tbl_patient','tbl_prise_en_charge.patient_id','=','tbl_patient.patient_id')
                    
                    ->where([
                        ['id_lit',null],
                        ['tbl_prise_en_charge.id_centre',$centre_id],
                        ['tbl_consultation.user_id',$user_id],
                        ['tbl_prise_en_charge.etat_consultation', 1],
                        ['tbl_consultation.etat_traitement',0],
                        ])
                    ->select('tbl_prise_en_charge.*',
                            'tbl_patient.*',
                            'tbl_consultation.*')
                    ->groupBy('tbl_prise_en_charge.patient_id')
                    ->orderBy('etat_consultation','DESC')
                    ->get();

        $totalPatient_nt = $all_patient_nt->count();


        $all_patient_t=DB::table('tbl_consultation')
                ->join('tbl_prise_en_charge','tbl_consultation.id_prise_en_charge','=','tbl_prise_en_charge.id_prise_en_charge')             
                ->join('tbl_patient','tbl_prise_en_charge.patient_id','=','tbl_patient.patient_id')
                ->where([
                      ['tbl_consultation.user_id',$user_id],
                      ['tbl_prise_en_charge.id_centre',$centre_id],
                      ['tbl_prise_en_charge.etat_consultation',1],
                      ['tbl_consultation.etat_traitement',1],
                     ]) 
                
                ->select('tbl_prise_en_charge.*','tbl_patient.*','tbl_consultation.*')
                ->groupBy('tbl_prise_en_charge.patient_id')
                ->orderBy('etat_consultation','DESC')
                ->get();

        $totalPatient_t = $all_patient_t->count();


        $all_patient_h = DB::table('tbl_consultation')
                ->join('tbl_lits', 'tbl_consultation.id_lit', '=', 'tbl_lits.id_lit')
                ->join('tbl_chambre', 'tbl_lits.id_chambre', '=', 'tbl_chambre.id_chambre')
                ->join('tbl_prise_en_charge', 'tbl_consultation.id_prise_en_charge', '=', 'tbl_prise_en_charge.id_prise_en_charge')              
                ->join('tbl_patient', 'tbl_prise_en_charge.patient_id', '=', 'tbl_patient.patient_id')
                ->where([
                        ['tbl_prise_en_charge.etat_consultation',1],
                        ['tbl_consultation.is_hospitalisation', 1],
                        ['tbl_prise_en_charge.id_centre', $centre_id],
                        ['tbl_consultation.user_id', $user_id]
                         ])
                ->select(
                        'tbl_prise_en_charge.*',
                        'tbl_prise_en_charge.patient_id', 
                        'tbl_patient.*',
                        'tbl_consultation.id_consultation',
                        'tbl_consultation.is_hospitalisation',
                        'tbl_consultation.diagnostic',
                        'tbl_chambre.libelle_chambre',
                        'tbl_lits.lit'
                         )
                ->groupBy('tbl_prise_en_charge.patient_id')
                ->orderBy('is_hospitalisation', 'DESC')
                ->get();

        $totalPatient_h = $all_patient_h->count();

        $all_patient_ob=DB::table('tbl_consultation')
                ->join('tbl_prise_en_charge','tbl_consultation.id_prise_en_charge','=','tbl_prise_en_charge.id_prise_en_charge')             
                ->join('tbl_patient','tbl_prise_en_charge.patient_id','=','tbl_patient.patient_id')
                ->where([
              ['tbl_consultation.user_id',$user_id],
              ['tbl_prise_en_charge.id_centre',$centre_id],
            //   ['tbl_prise_en_charge.etat_consultation',1], 
              ['tbl_prise_en_charge.etat_observation',1]
          ]) 
        
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
public function hospitalisation()
{
    $this->UserAuthCheck();
    $this->SpecialisteAuthCheck();
    $user_id = Session::get('user_id');
    $centre_id = Session::get('centre_id');
    $user_role_id = Session::get('user_role_id');

    $all_hospi_nt = DB::table('tbl_consultation')
    ->join('tbl_prise_en_charge','tbl_consultation.id_prise_en_charge','=','tbl_prise_en_charge.id_prise_en_charge')
    ->join('tbl_patient','tbl_prise_en_charge.patient_id','=','tbl_patient.patient_id')
    ->where('is_hospitalisation', 1)
    ->where([
          ['id_lit',null],
          ['tbl_prise_en_charge.id_centre',$centre_id],
      ])
    ->select('tbl_prise_en_charge.*','tbl_patient.*','tbl_consultation.*')
    ->groupBy('tbl_prise_en_charge.patient_id')
    ->orderBy('etat_consultation','DESC')
    ->get();
    $totalPatient_nh = $all_hospi_nt->count();

    $all_patient_h = DB::table('tbl_consultation')
        ->join('tbl_lits', 'tbl_consultation.id_lit', '=', 'tbl_lits.id_lit')
        ->join('tbl_chambre', 'tbl_lits.id_chambre', '=', 'tbl_chambre.id_chambre')
        ->join('tbl_prise_en_charge', 'tbl_consultation.id_prise_en_charge', '=', 'tbl_prise_en_charge.id_prise_en_charge')              
        ->join('tbl_patient', 'tbl_prise_en_charge.patient_id', '=', 'tbl_patient.patient_id')
        ->where('is_hospitalisation', 1)
        ->whereNotNull('tbl_consultation.id_lit')
        ->where('tbl_prise_en_charge.id_centre', $centre_id)
        ->select(
            'tbl_prise_en_charge.*',
            'tbl_prise_en_charge.patient_id', 
            'tbl_patient.*',
            
            'tbl_consultation.id_consultation',
            'tbl_consultation.is_hospitalisation',
            'tbl_chambre.libelle_chambre',
            'tbl_lits.lit'
        )
        ->groupBy('tbl_prise_en_charge.patient_id')
        ->orderBy('is_hospitalisation', 'DESC')
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

    return view('Hospi.patients_nt', with(array(
        'all_hospi_nt'=>$all_hospi_nt,
        'totalPatient_nh' => $totalPatient_nh,
        'all_patient_h'=>$all_patient_h,
        'totalPatient_h' => $totalPatient_h,
        'all_patient_ob'=>$all_patient_ob,
        'totalPatient_ob' => $totalPatient_ob,
    )));
    }
    public function gestion_analyses()
    {
        $this->UserAuthCheck();
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

    public function traitement_hospitalisation($id_consultation,$patient_id)
    {
        $this->UserAuthCheck();
        $this->SpecialisteAuthCheck();
        
        $this->traitement_patient($id_consultation,$patient_id);

        $patient_data = $this->getPatientData($patient_id);

        if (!$patient_data->first()) {
            abort(404, 'Patient non trouvé');
        }
        $last_constance = $this->getLastConstantes($patient_id, $id_consultation);
        return view('Hospi.traitement_patient', [
            'all_details' => $patient_data,
            'id_consultation' => $id_consultation,
            'last_constance' => $last_constance,
            'patient' => $patient_data->first() 
        ]);

    }
    function getPatientAnalyse($id)
    {
        
       // Récupérer les informations du patient
            $data = DB::table('tbl_patient as p')
            ->where('p.patient_id', $id)
            ->select(
                'p.patient_id',
                'p.nom_patient as nom',
                'p.prenom_patient as prenom'
            )
            ->first();

            // Récupérer les analyses du patient
            $analyses = DB::table('tbl_analyse_payed as a')
            ->leftJoin('tbl_prestation as pr', 'a.prestation_id', '=', 'pr.prestation_id')
            ->leftJoin('tbl_resultats_analyse as r', 'a.payed_analyse_id', '=', 'r.id_demande') // Ajout de la jointure
            ->where('a.patient_id', $id)
           // ->where('a.treated', false)
            ->select(
                'a.payed_analyse_id as analyse_id',
                'a.date_paiement',
                'a.id_demande as idDemand',
                'a.montant_total as montant',
                'pr.prestation_id',
                'pr.nom_prestation as libelle_analyse',
                'pr.tarif as prix',
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
        //  dd($result);

        return view('Analys.patient_analyse_details')->with(array(
            'patient'=>$result,
            'idDemand'=>$analyses->first()->idDemand,
        ));
    }

    function editAnalyseResult($id,$patient_id)
    {
        
        $analysis = DB::table('tbl_analyse_payed as a')
        ->leftJoin('tbl_prestation as pr', 'a.prestation_id', '=', 'pr.prestation_id')
        ->where('a.payed_analyse_id', $id)
        ->select(
            'a.payed_analyse_id as analyse_id',
            'a.treated',
            'a.date_paiement',
            'a.id_demande',
            'a.montant_total as montant',
            'pr.prestation_id',
            'pr.nom_prestation as libelle_analyse',
            'pr.tarif as prix'
        )
        ->first();

        $patient = DB::table('tbl_patient')->where('patient_id', $patient_id)->first();

        $sex=$patient->sexe_patient=="M"? "HOMME":"FEMME";

            if ( $analysis) {
                // 2ème requête : Récupérer les paramètres associés à cette analyse
                $parameters = DB::table('tbl_analyse_parametres')
                ->where('tbl_prestation_id', $analysis->prestation_id)
                ->where('genre', $sex)
                ->select(
                    'id as parametre_id',
                    'category',
                    'element',
                    'libelle_norme',
                    'valeur_norme',
                    'genre'
                )
                ->get()->groupby('category');

            }
           
            // Ajouter les paramètres à l'analyse
            $analysis->parametres = $parameters;          
           
        return view('Analys.edit_analyse_result')->with(array(
            'analyse'=>$analysis,
            'sex'=>$sex,
            'patient_id'=>$patient_id
        ));
    }

    function storeResult(Request $request)
    {
        
        $user_id=$request->user_id;
        $user_role_id=$request->user_role_id;

        //dd($request->all());
        $data=collect();
        if ($request->elements) {
            foreach ($request->elements as $key => $value) {
                $data->push([
                    "element"=>$value,
                    "category"=>$request->categories[$key],
                    "result"=>$request->results[$key],
                    "norme"=>$request->normes[$key],
                ]);
            }
        }

        // $analyse = DB::table('tbl_analyse_payed as a')
        // ->leftJoin('tbl_prestation as pr', 'a.prestation_id', '=', 'pr.prestation_id')
        // ->leftJoin('tbl_patient as p', 'a.patient_id', '=', 'p.patient_id') // Jointure avec la table des patients
        // ->where('pr.prestation_id', $request->prestation_id)
        // ->select(
        //     // Informations du patient
        //     'p.patient_id as patient_id',
        //     'p.nom_patient',
        //     'p.prenom_patient',

        //     // Informations de l'analyse
        //     'a.payed_analyse_id as analyse_id',
        //     'a.date_paiement',
        //     'a.montant_total as montant',
        //     'pr.prestation_id',
        //     'pr.nom_prestation',
        //     'pr.tarif as prix',
        // )
        // ->first(); // Un seul résultat

          //  dd($analyse);

            // $pdf = Pdf::loadView('Resultat.pdf-ext', [
            // "element"=>$analyse->nom_prestation,
            // "patient"=>$analyse->nom_patient. " ".$analyse->prenom_patient,
            // "resultats"=>$data,
            // "decision"=>$request->decision,
            // "observation"=>$request->observation
            // ]);
            // $name='Resultat_' . time(). '_.pdf';
            // $path=storage_path('app/public/'.$name);
            
            // $pdf->save($path);

            $get_user_role=DB::table('users')
            ->join('personnel','users.email','=','personnel.email')
            ->select('users.*','personnel.*')
            ->where('user_id',$user_id)
            ->first();

            $centre_id=Session::get('centre_id');

            DB::table('tbl_analyse_payed')->where('payed_analyse_id', $request->analyse_id)->update(['treated'=>true]);

            DB::table('tbl_resultats_analyse')->updateOrInsert(
                [
                    'id_demande' => $request->analyse_id,
                    'prestation_id' => $request->prestation_id
                ],
                [
                'id_demande' => $request->analyse_id, 
                'prestation_id' => $request->prestation_id, 
                'resultat' => $request->decision, 
                'path' => "non défini", 
                'observation' => $request->observation, 
                'content' => json_encode($data), 
                'personnel_id' => null, 
                'user_role_id' => $user_role_id,
                'personnel_id' => $user_id,
                'centre_id' => $centre_id
            ]);


            return redirect()->to(URL::to("gestion-analyses/".$request->patient_id));
        }

    function showResult($id,$result_id){
            $this->SpecialisteAuthCheck();
            $user_id=Session::get('user_id');
            $centre_id=Session::get('centre_id');

            $analyse = DB::table('tbl_analyse_payed as a')
            ->leftJoin('tbl_prestation as pr', 'a.prestation_id', '=', 'pr.prestation_id')
            ->leftJoin('tbl_patient as p', 'a.patient_id', '=', 'p.patient_id') // Jointure avec la table des patients
            ->where('pr.prestation_id', $id)
            ->select(
                // Informations du patient
                'p.patient_id as patient_id',
                'p.nom_patient',
                'p.prenom_patient',

                // Informations de l'analyse
                'a.payed_analyse_id as analyse_id',
                'a.date_paiement',
                'a.montant_total as montant',
                'pr.prestation_id',
                'pr.nom_prestation',
                'pr.tarif as prix',
            )
            ->first(); 
            $resultat = DB::table('tbl_resultats_analyse')->where('id_resultat', $result_id)->first();
             //   dd( $resultat);
           
             //dd(json_decode($resultat->content));

            return view('Analys.show_analys_result')->with( [
                "element"=>$analyse->nom_prestation,
                "patient"=>$analyse->nom_patient. " ".$analyse->prenom_patient,
                "decision"=>$resultat->resultat,
                "observation"=>$resultat->observation,
                "resultats"=>collect(json_decode($resultat->content))?->groupby('category'),
                ]);
                
        }

    
    function getResultPDF($id,$analyse_id,$id_demande){
        
        $analyse = DB::table('tbl_analyse_payed as a')
        ->leftJoin('tbl_prestation as pr', 'a.prestation_id', '=', 'pr.prestation_id')
        ->leftJoin('tbl_patient as p', 'a.patient_id', '=', 'p.patient_id')
        ->leftJoin('tbl_resultats_analyse as r', 'pr.prestation_id', '=', 'r.prestation_id')        // Jointure avec la table des patients
        ->whereIn('a.payed_analyse_id', explode(',',$analyse_id))
        ->where('a.treated', true)
        ->where('a.patient_id', $id)
        ->where('a.id_demande', $id_demande)
        ->select(
            // Informations du patient
            'p.patient_id as patient_id',
            'p.nom_patient',
            'p.prenom_patient',

            // Informations de l'analyse
            'a.payed_analyse_id as analyse_id',
            'a.date_paiement',
            'a.montant_total as montant',
            'pr.category',
            'pr.prestation_id',
            'pr.nom_prestation',
            'pr.tarif as prix',
             'r.resultat',
             'r.observation',
             'r.content',
        )
        ->distinct('a.analyse_id')
        ->get(); // Un seul résultat
             //   dd($analyse);
            $data1=array();
            $data2=array();
            $i=0;
            $j=0;
            foreach ($analyse as  $a) {

                $content=json_decode($a->content);
                if (sizeof($content)==0) {
                    $data1[$i]['categorie']=$a->category;
                    $data1[$i]['element']=$a->nom_prestation;
                    $data1[$i]['decision']=$a->resultat;
                    $data1[$i]['observation']=$a->observation;
                    $data1[$i]['resultats']=json_decode($a->content);
                    $i++;
                } else {
                    $data2[$j]['categorie']=$a->category;
                    $data2[$j]['element']=$a->nom_prestation;
                    $data2[$j]['decision']=$a->resultat;
                    $data2[$j]['observation']=$a->observation;
                    $data2[$j]['resultats']= collect(json_decode($a->content))?->groupby('category');
                    $j++;
                  //  dd(collect(json_decode($a->content)));

                }
               
            }  

            //  $qrCode = base64_encode(QrCode::format('png')->size(200)->generate('https://www.irokotour.com'));
            $qrCode ="QrCode ici";
            $pdf = Pdf::loadView('Resultat.pdf-ext', [
            "patient"=>$analyse[0]->nom_patient. " ".$analyse[0]->prenom_patient,
            "data1"=>$data1,
            "data2"=>$data2,
            "qrCode"=>$qrCode
            ]);
            $name='Resultat_' . time(). '_.pdf';
            $path=storage_path('app/public/'.$name);
            
          return  $pdf->stream();
    }

    public function traitement_analyse($id_analyse,$patient_id)
    {
        $this->UserAuthCheck();
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
    
    public function traitement_patient($id_consultation, $patient_id)
    {
        $this->UserAuthCheck();
        $this->SpecialisteAuthCheck();

        $patient_data = $this->getPatientData($patient_id);
        
        if (!$patient_data->first()) {
            abort(404, 'Patient non trouvé');
        }
        $last_constance = $this->getLastConstantes($patient_id, $id_consultation);
        $specialistes = $this->getSpecialistes(Session::get('user_id'));
                    
        return view('Consult.traitement_patient', [
            'all_details' => $patient_data,
            'id_consultation' => $id_consultation,
            'last_constance' => $last_constance,
            'specialistes' => $specialistes,
            'patient' => $patient_data->first() 
        ]);
    }
    
    private function getSpecialistes($exclude_user_id)
    {
        return DB::table('user_roles')
            ->join('users', 'user_roles.user_role_id', '=', 'users.user_role_id')
            ->join('personnel', 'users.email', '=', 'personnel.email')
            ->where('is_consult', 1)
            ->where('users.user_id', '!=', $exclude_user_id)
            ->select(
                'users.user_id',
                 
                'personnel.prenom', 
                'personnel.nom', 
                'user_roles.designation as qualification'
            )
            ->get();
    }
    private function getPatientData($patient_id)
    {
        return DB::table('tbl_prise_en_charge')
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
                if (!empty($item->patient_birthdate)) {
                    $birthdate = Carbon::parse($item->patient_birthdate);
                    $age = $birthdate->diff(Carbon::now());
                    
                    if ($age->y < 1 && $age->m < 1) {
                        $item->age_formatted = $age->d . ' jours';
                    } elseif ($age->y < 1) {
                        $item->age_formatted = $age->m . ' mois';
                    } else {
                        $item->age_formatted = $age->y . ' ans et ' . $age->m . ' mois';
                    }
                } else {
                    $item->age_formatted = 'Date de naissance inconnue';
                }
                
                return $item;
            });
    }
    
    private function getLastConstantes($patient_id,$id_consultation)
    {
        return DB::table('tbl_constantes')
            ->join('tbl_consultation', 'tbl_constantes.id_consultation', '=', 'tbl_consultation.id_consultation')
            
            ->where([
                ['tbl_constantes.patient_id', $patient_id],
                ['tbl_constantes.id_consultation',$id_consultation]])
            ->select(
                'tbl_constantes.type',
                'tbl_constantes.valeur',
                'tbl_constantes.unite',
                'tbl_constantes.created_at'
            )
            ->orderBy('created_at', 'DESC')
            ->get()
            ->groupBy('type')
            ->map(function($items) {
                return $items->first();
            });
        $data = [
            'constantes' => DB::table('tbl_constantes')
                ->where('patient_id', $patient_id)
                ->where('id_consultation', $id_consultation)
                ->get(),
            
            'consultation' => DB::table('tbl_consultation')
                ->where('id_consultation', $id_consultation)
                ->first(),
                                
            'patient' => DB::table('tbl_patient')
                ->where('patient_id', $patient_id)
                ->first()
        ];
    
        dd($data);
    }

    public function save_analyse_traitement (Request $request)
    {
        $this->UserAuthCheck();
        $this->SpecialisteAuthCheck();
    
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
    
        $decision_type = $this->determinerDecisionType($request);
    
        $request->validate($this->getValidationRules($decision_type));
    
        $fileData = $this->traiterFichierJoint($request);
    
        $consultData = array_merge([
            'diagnostic' => $request->diagnostic,
            'observation' => $request->observation,
            'conslt_updated_at' => now()
        ], $fileData);
    
        switch ($decision_type) {
            case 'hospitalisation':
                return $this->traiterHospitalisation($request, $consultData);
            case 'observation':
                return $this->traiterObservation($request, $consultData);
            case 'transfert':
                return $this->traiterTransfert($request, $consultData);
            case 'cloture':
                return $this->traiterCloture($request, $consultData);
        }
    }
    
        protected function determinerDecisionType($request)
        {
        if ($request->filled('etat_traitement') && $request->etat_traitement == 1) {
            return 'cloture';
        }
        if ($request->filled('specialiste')) {
            $specialisteId = $request->specialiste;
            
            if ($specialisteId === '0') {
                return 'hospitalisation';
            } elseif ($specialisteId === '2') {
                return 'observation';
            } else {
                $exists = DB::table('users')
                    ->join('personnel', 'users.email', '=', 'personnel.email')
                    ->where('user_id', $specialisteId)
                    ->exists();
                
                return $exists ? 'transfert' : abort(400, 'Spécialiste non trouvé');
            }
        }
        abort(400, 'Type de décision non reconnu');
        }
        
        protected function getValidationRules($decision_type)
        {
            $rules = [
                'diagnostic' => 'required',
                'id_consultation' => 'required|exists:tbl_consultation,id_consultation',
                'id_prise_en_charge' => 'required|exists:tbl_prise_en_charge,id_prise_en_charge',
                'patient_id' => 'required|exists:tbl_patient,patient_id',
                'fichier_joint' => 'nullable|file|mimes:pdf|max:2048'
            ];

            if ($decision_type === 'cloture') {
                $rules['ordonnance'] = 'required';
            } elseif ($decision_type === 'transfert') {
                $rules['specialiste'] = 'required|exists:users,user_id';
            }

            return $rules;
        }
            
        protected function traiterFichierJoint($request)
        {
            if (!$request->hasFile('fichier_joint')) {
                return [];
            }
        
            $file = $request->file('fichier_joint');
            $fileName = time().'_'.$file->getClientOriginalName();
            $filePath = $file->storeAs('consultations', $fileName, 'public');
            
            return ['fichier_joint' => '/storage/'.$filePath];
        }
        
        protected function traiterHospitalisation($request, $consultData)
        {
            DB::transaction(function () use ($request, $consultData) {
                // Mise à jour de la consultation
                DB::table('tbl_consultation')
                    ->where('id_consultation', $request->id_consultation)
                    ->update(array_merge($consultData, [
                        'is_hospitalisation' => 1,
                        'etat_traitement' => 0
                    ]));
        
                // Mise à jour de la prise en charge
                DB::table('tbl_prise_en_charge')
                    ->where('id_prise_en_charge', $request->id_prise_en_charge)
                    ->update([
                        'etat_hospitalisation' => 1,
                        'updated_at' => now()
                    ]);
            });
        
            Alert::success('Succès', 'Patient hospitalisé avec succès');
            return redirect()->route('consultations.index');
        }
        
     protected function traiterObservation($request, $consultData)
        {
            DB::transaction(function () use ($request, $consultData) {
                DB::table('tbl_consultation')
                    ->where('id_consultation', $request->id_consultation)
                    ->update(array_merge($consultData, [
                        'is_hospitalisation' => 0, 
                        'etat_traitement' => 0
                    ]));
        
                DB::table('tbl_prise_en_charge')
                    ->where('id_prise_en_charge', $request->id_prise_en_charge)
                    ->update([
                        'etat_observation' => 1,
                        'updated_at' => now()
                    ]);
            });
        
            Alert::success('Succès', 'Patient mis en observation');
            return redirect()->route('consultations.index');
        }
        
     protected function traiterTransfert($request, $consultData)
        {
        // Récupération validée du spécialiste (déjà vérifié dans determinerDecisionType)
        $specialiste = DB::table('users')
            ->join('personnel', 'users.email', '=', 'personnel.email')
            ->where('user_id', $request->specialiste)
            ->first();

        // Double vérification pour sécurité
        if (!$specialiste) {
            Alert::error('Erreur', 'Spécialiste non trouvé');
            return back()->withInput();
        }

        DB::transaction(function () use ($request, $consultData, $specialiste) {
            // Mise à jour consultation actuelle
            DB::table('tbl_consultation')
                ->where('id_consultation', $request->id_consultation)
                ->update(array_merge($consultData, [
                    'etat_traitement' => 1,
                    'conslt_updated_at' => now()
                ]));

            // Nouvelle consultation pour le spécialiste
            DB::table('tbl_consultation')->insert([
                'id_prise_en_charge' => $request->id_prise_en_charge,
                'user_id' => $specialiste->user_id,
                'user_role_id' => $specialiste->user_role_id,
                'conslt_created_at' => now(),
                'conslt_updated_at' => now()
            ]);

            // Mise à jour prise en charge
            DB::table('tbl_prise_en_charge')
                ->where('id_prise_en_charge', $request->id_prise_en_charge)
                ->update([
                    'last_consult_user_id' => $specialiste->user_id,
                    'last_consult_user_role_id' => $specialiste->user_role_id,
                    'updated_at' => now()
                ]);
        });

        Alert::success('Succès', "Patient transféré à {$specialiste->prenom} {$specialiste->nom}");
        return redirect()->route('consultations.index');
      }
        
        protected function traiterCloture($request, $consultData)
        {
            DB::transaction(function () use ($request, $consultData) {
                
                DB::table('tbl_consultation')
                    ->where('id_consultation', $request->id_consultation)
                    ->update(array_merge($consultData, [
                        'etat_traitement' => 1,
                        'is_hospitalisation' => 0
                    ]));
        
                // Nouvelle ordonnance
                DB::table('tbl_ordo_consultation')->insert([
                    'id_consultation' => $request->id_consultation,
                    'ordonnance_consultation' => $request->ordonnance,
                    'num_ordo' => 'ORD-'.time(),
                    'date_ordo' => now(),
                    'updated_at' => now()
                ]);
        
                DB::table('tbl_prise_en_charge')
                    ->where('id_prise_en_charge', $request->id_prise_en_charge)
                    ->update([
                        'etat_hospitalisation' => 0,
                        'updated_at' => now()
                    ]);
            });
        
            Alert::success('Succès', 'Traitement clôturé avec succès');
            return redirect()->route('consultations.index');
        }
    
    public function get_ordo($ordo_id)
    {
        $ordo_info=DB::table('tbl_ordo_consultation')
                  ->leftjoin('tbl_consultation','tbl_consultation.id_consultation','=','tbl_ordo_consultation.id_consultation')
                  ->leftjoin('tbl_prise_en_charge','tbl_prise_en_charge.id_prise_en_charge','=','tbl_consultation.id_prise_en_charge')
                  ->leftjoin('tbl_patient','tbl_patient.patient_id','=','tbl_prise_en_charge.patient_id')
                  ->select('tbl_ordo_consultation.*','tbl_consultation.*','tbl_prise_en_charge.*','tbl_patient.*')
                  ->where('id_ordo_traitement',$ordo_id)
                  ->first();
                  
        return view ('Consult.ordonnance')
                ->with(array(
                     'ordo_info'=>$ordo_info,      
                ));
    }

    public function make_ordonance (Request $request)
    {

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
    public function update_constante (Request $request)
    {
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
