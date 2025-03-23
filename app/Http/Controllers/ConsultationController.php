<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    if ($user_role_id == 4 || $user_role_id == 1) {
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

            // $data = [
            //     'id_demande'=> $id_demande, 
            //     'user_id'=> $user_id,
            //     'user_role_id'=> $user_role_id, ];
            
            // DB::table('tbl_demande_ext')->insertGetId($data);

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
        $all_patient_nt=DB::table('tbl_consultation')
                ->join('tbl_prise_en_charge','tbl_consultation.id_prise_en_charge','=','tbl_prise_en_charge.id_prise_en_charge')              
                ->join('tbl_patient','tbl_prise_en_charge.patient_id','=','tbl_patient.patient_id')
                ->where('etat_traitement',0)
                ->where([
                      ['tbl_consultation.user_id',$user_id],
                      ['tbl_prise_en_charge.id_centre',$centre_id],
                  ]) 
               
                ->select('tbl_prise_en_charge.*','tbl_patient.*','tbl_consultation.*')
                ->orderBy('etat_consultation','DESC')
                ->get(); 

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



        return view('Consult.patients_nt')->with(array(
                    'all_patient_nt'=>$all_patient_nt,             
                    'all_patient_t'=>$all_patient_t,             
                    'all_patient_h'=>$all_patient_h,             
                ));;
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
    

        $all_details=DB::table('tbl_prise_en_charge')
                ->leftjoin('tbl_patient','tbl_prise_en_charge.patient_id','=','tbl_patient.patient_id')
                ->leftjoin('tbl_consultation','tbl_consultation.id_prise_en_charge','=','tbl_prise_en_charge.id_prise_en_charge')
                  ->leftjoin('tbl_ordo_consultation','tbl_ordo_consultation.id_consultation','=','tbl_consultation.id_consultation')
                ->where('tbl_prise_en_charge.patient_id',$patient_id)
                ->select('tbl_prise_en_charge.*','tbl_patient.*','tbl_consultation.*','tbl_ordo_consultation.*')
                ->orderBy('created_at','DESC')
                ->get();

        
        return view('Consult.traitement_patient')->with(array(
                    'all_details'=>$all_details,                         
                    'id_consultation'=>$id_consultation,                         
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

        $etat_hospitalisation=$request->etat_hospitalisation;
        $id_consultation=$request->id_consultation;
        $id_prise_en_charge=$request->id_prise_en_charge;
        $ordonnance=$request->ordonnance;
        $user_id=$request->specialiste;
        $patient_id=$request->patient_id;
        $observation=$request->observation;
        $diagnostic=$request->diagnostic;

        $file=$request->file('fichier_joint');
    
        
        if ($etat_hospitalisation == 0 && $user_id > 0) {
        $get_user_role=DB::table('users')
            ->join('personnel','users.email','=','personnel.email')
            ->select('users.*','personnel.*')
            ->where('user_id',$user_id)
            ->first();

            $user_role_id=$get_user_role->user_role_id;
            $qualification=$get_user_role->qualification;
            $prenom=$get_user_role->prenom;
            $nom=$get_user_role->nom;

            
            
            $datau['diagnostic']=$diagnostic;
            $datau['observation']=$observation;
            $datau['etat_traitement']=1;
                if ($file) {
                $file_name=$file->getClientOriginalName();
                $ext=strtolower($file->getClientOriginalExtension());
                $file_full_name=$file_name;
                $upload_path= "Uploads/consultations/";
                $file_url=$upload_path.$file_full_name;
                
                $success=$file->move($upload_path,$file_full_name);
                if ($success) {
            $datau['fichier_joint']=$file_url;
                    }
                }      
            DB::table('tbl_consultation')
                ->where('id_consultation',$id_consultation)
                ->update($datau);

            $datap['last_consult_user_role_id']=$user_role_id; 
            $datap['last_consult_user_id']=$user_id; 
            DB::table('tbl_prise_en_charge')
                ->where('id_prise_en_charge',$id_prise_en_charge)
                ->update($datap);

            $datac['user_id']=$user_id; 
            $datac['user_role_id']=$user_role_id;
            $datac['id_prise_en_charge']=$id_prise_en_charge;
            DB::table('tbl_consultation')->insertGetId($datac);
            

            Alert::success('Info', 'Patient affecté pour consultation vers '.$qualification.' '.$prenom.' '.$nom);
               return Redirect::to ('/consultations');
        }elseif ($etat_hospitalisation == 1 || $user_id == 0) {
            
        $get_patient=DB::table('tbl_patient')
            ->where('patient_id',$patient_id)
            ->first();
            $prenom_patient=$get_patient->prenom_patient;
            $nom_patient=$get_patient->nom_patient;

            if ($user_id == 0) {
            $data['is_hospitalisation']=1;
            }
            $data['diagnostic']=$diagnostic;
            $data['observation']=$observation;
            $data['etat_traitement']=1;
    
                if ($file) {
                $file_name=$file->getClientOriginalName();
                $ext=strtolower($file->getClientOriginalExtension());
                $file_full_name=$file_name;
                $upload_path= "Uploads/consultations/";
                $file_url=$upload_path.$file_full_name;
                
                $success=$file->move($upload_path,$file_full_name);
                if ($success) {
            $data['fichier_joint']=$file_url;
                    }
                }      
            DB::table('tbl_consultation')
                ->where('id_consultation',$id_consultation)
                ->update($data);

            
            $datap['etat_hospitalisation']=$etat_hospitalisation;
            DB::table('tbl_prise_en_charge')
                ->where('id_prise_en_charge',$id_prise_en_charge)
                ->update($datap);



        if ($etat_hospitalisation == 1) {
            // code...
        
        
        $today=date('YmdHis');
        $num_ordo=$id_prise_en_charge.'-'.$id_consultation.'-'.$today;
        $data=array();
        $data['id_consultation']=$id_consultation;
        $data['ordonnance_consultation']=$ordonnance;
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
                Alert::success('Info', 'Prise en charge du patient '.$prenom_patient.' '.$nom_patient.' terminée. Le traitement est cloturé');
                 return Redirect::to('ordonnance/'.$id_ordo)->with(array(
                    'message'=>$message,
                    
                    'ordo_info'=>$ordo_info,                       
                                                   
                ));   
        }

                Alert::success('Info', 'Prise en charge du patient '.$prenom_patient.' '.$nom_patient.' terminée. Le traitement est cloturé');
               return Redirect::to ('/consultations');

        
        }
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
