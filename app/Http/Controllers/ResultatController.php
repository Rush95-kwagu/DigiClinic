<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
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


class ResultatController extends Controller
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
    public function edit($id_demande, $patient_id)
    {
   // Récupérer les données avec une jointure
   $analyse = DB::table('tbl_analyse_payed')
   ->join('tbl_patient', 'tbl_analyse_payed.patient_id', '=', 'tbl_patient.patient_id')
   ->join('tbl_prestation', 'tbl_analyse_payed.prestation_id', '=', 'tbl_prestation.prestation_id')
   ->where('tbl_analyse_payed.id_demande', $id_demande)
   ->where('tbl_analyse_payed.patient_id', $patient_id)
   ->select(
       'tbl_analyse_payed.*',
       'tbl_patient.*',
       'tbl_prestation.nom_prestation',
       )
   ->get();

// Vérifier si des données ont été trouvées
if ($analyse->isEmpty()) {
   return redirect()->back()->with('error', 'Aucune analyse trouvée pour ce patient.');
}

// Passer les données à la vue
return view('Resultat.edit_resultat', [
   'patient' => (object) [
       'nom_patient' => $analyse->first()->nom_patient,
       'prenom_patient' => $analyse->first()->prenom_patient,
       'telephone' => $analyse->first()->telephone,
   ],
   'prestations' => $analyse,
]);
    }

public function save(Request $request, $id_prestation)
{
    // Vérifier si la demande est payée
    $demandePayee = DB::table('tbl_analyse_payed')
        ->where('id_prestation', $id_prestation)
        ->exists();

    if (!$demandePayee) {
        return redirect()->back()->with('error', 'Cette analyse n\'a pas encore été payée.');
    }

    $validatedData = $request->validate([
        'resultat' => 'required|string',
    ]);

    // Enregistrer ou mettre à jour le résultat
    DB::table('tbl_resultats_analyse')->updateOrInsert(
        ['id_prestation' => $id_prestation],
        ['resultat' => $validatedData['resultat'], 'date_resultat' => now()]
    );

    return redirect()->back()->with('success', 'Résultat enregistré avec succès !');
}


public function generatePDF($id_demande)
{
    // Récupérer les résultats des analyses
    $resultats = DB::table('tbl_resultats_analyse')
        ->join('tbl_prestation', 'tbl_resultats_analyse.id_prestation', '=', 'tbl_prestation.id_prestation')
        ->where('tbl_resultats_analyse.id_demande', $id_demande)
        ->get();

    // Récupérer les informations du patient
    $patient = DB::table('tbl_demande_ext')
        ->join('tbl_patient', 'tbl_demande_ext.patient_id', '=', 'tbl_patient.patient_id')
        ->where('tbl_demande_ext.id_demande', $id_demande)
        ->first();

    // Générer le PDF
    $pdf = PDF::loadView('pdf.resultats', [
        'patient' => $patient,
        'resultats' => $resultats,
    ]);

    return $pdf->download('resultats_analyses.pdf');
}
}
