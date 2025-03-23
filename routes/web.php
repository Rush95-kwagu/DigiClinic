<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RayonController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SrayonController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ResultatController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\PriseEnChargeController;
use App\Http\Controllers\Auth\RegisteredController;
use App\Http\Controllers\MedecinGeneralistController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//  Route::get('/', function () {
//      return view('admin/index');
// });
// Route::get('signup', [AdminController::class,('create')])->name('users.showform');
// Route::post('signup', [AdminController::class,('store')])->name('users.storeform');

//Backend routes......................................................
Route::get('/', [AuthenticatedSessionController::class,('create')])->name('login.user.form');
Route::post('login', [AuthenticatedSessionController::class,('store')])->name('login.user');
Route::get('create-new-user', [RegisteredController::class, 'create'])->name('create.user');
Route::post('save-new-user', [RegisteredController::class, 'store'])->name('store.user');
Route::get('dashboard', [AdminController::class, 'index']);
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy']);
//Prise en charge
Route::get('/all-prestations', [PriseEnChargeController::class, 'prestation']);
Route::get('/prestation-edit/{prestation_id}',[PriseEnChargeController::class,'editPrestation']);
Route::get('/all-analyses/{patient_id}/{id_type_analyse}/{services_id}', [PriseEnChargeController::class, 'analyse']);
Route::get('/add-form', [PriseEnChargeController::class, 'addPrestation']);
Route::get('/edit-analyse-form/{id_type_analyse}', [PriseEnChargeController::class, 'editAnalyse']);
Route::post('/update-analyse-form/{id_type_analyse}', [PriseEnChargeController::class, 'updateAnalyse']);
Route::get('/add-analyse', [PriseEnChargeController::class, 'addAnalyse']);
Route::post('/add-form', [PriseEnChargeController::class, 'savePrestation'])->name('add.prestation');
Route::post('/add-analyse', [PriseEnChargeController::class, 'saveAnalyse'])->name('save.analyse');
Route::get('/prises-en-charges', [PriseEnChargeController::class,('index')]);
Route::get('/enregistrer-prise-en-charge', [PriseEnChargeController::class,('record_prisenc')]);
Route::post('/save-prisenc', [PriseEnChargeController::class,('save_prisenc')]);
Route::get('/caisse-consultations', [PriseEnChargeController::class,('caisse_conslt')]);
Route::post('/pay-consult', [PriseEnChargeController::class,('pay_consult')]);
Route::get('/caisse-hospitalisations', [PriseEnChargeController::class,('caisse_hospt')]);
Route::get('/caisse-analyses', [PriseEnChargeController::class,('caisse_analyses')]);
Route::get('get-analyse/{id}',[PriseEnChargeController::class, 'get_analyse']);
Route::post('/save-analyse', [PriseEnChargeController::class,('save_analyse')]);
Route::post('/save-step1', [PriseEnChargeController::class, 'saveStep1'])->name('save.step1');
Route::get('/save-step2', [PriseEnChargeController::class, 'showStep2Form'])->name('show.step2');
Route::post('/save-step2', [PriseEnChargeController::class, 'saveStep2'])->name('save.step2');
Route::get('complements-information/{id_prise_en_charge}/{patient_id}',[PriseEnChargeController::class, 'patientEdit'])->name('edit.patient');
Route::post('complements-information/{patient_id}', [PriseEnChargeController::class,'patientUpdate'])->name('update.patient');
Route::post('/make-ordonnance', [ConsultationController::class,('make_ordonance')]);
Route::get('/ordonnance/{ordo_id}', [ConsultationController::class,('get_ordo')]);


// Patient
Route::resource('patient', PatientController::class);
Route::get('patients/repertoire', [PatientController::class,('all_patient')])->name('patient.repertoire');
Route::get('patient/data/{id}', [PatientController::class, ('showPatientDatas')])->name('patient.datas');


//Chambre
Route::post('save-chambre', [PriseEnChargeController::class,('save_chambre')]);
Route::post('hospitaliser', [PriseEnChargeController::class,('hospitaliser')]);
// Chambre
Route::resource('room', RoomController::class);
Route::get('allotted/room', [RoomController::class,('allottedRoom')])->name('allotted-room');
Route::get('available/room', [RoomController::class,('available')])->name('available-room');
Route::get('allotted/room', [RoomController::class,('allotted')])->name('allotted-room');

// Service

Route::resource('services',ServiceController::class);

//Revenus
Route::get('revenus-globaux', [SalesController::class, ('income')]);

// Entités
Route::get('entities/index', [ServiceController::class,('entitieIndex')])->name('entities.index');
Route::get('entities/add/entitie', [ServiceController::class,('entitieCreate')])->name('entities.add');
Route::post('entities/store/entitie', [ServiceController::class,('entitieStore')])->name('entities.store');
Route::get('/directeur/entitie/{id}/{nom}-{prenom}', [ServiceController::class, 'entitieShowDirecteur'])->name('entitie.directeur.show');

//Centres
Route::get('centers/index', [ServiceController::class,('centerIndex')])->name('centers.index');
Route::get('centers/add/center', [ServiceController::class,('centerCreate')])->name('centers.add');
Route::post('centers/store/center', [ServiceController::class,('centerStore')])->name('centers.store');
Route::get('/directeur/center/{id}/{nom}-{prenom}', [ServiceController::class, 'centerShowDirecteur'])->name('center.directeur.show');

//Consultation
Route::post('send-consult', [ConsultationController::class,('send_consult')]);
Route::get('consultations', [ConsultationController::class,('consultation')]);
Route::get('traitement-patient/{id_consultation}/{patient_id}', [ConsultationController::class,('traitement_patient')]);
Route::post('save-traitement', [ConsultationController::class,('save_traitement')]);
Route::post('modifier-constante', [ConsultationController::class,('update_constante')]);

//Analyses
Route::get('gestion-analyses', [ConsultationController::class,('gestion_analyses')]);
Route::get('traitement-analyse/{id_analyse}/{patient_id}', [ConsultationController::class,('traitement_analyse')]);
Route::get('get-reactif/{user_id}/{id_analyse}', [SalesController::class, 'get_reactif']);
Route::post('/store-tabreactif',[SalesController::class, 'store_tabreactif']);
Route::get('/2/delete-tabreactif/{id}',[SalesController::class, 'delete_tabreactif']);
Route::post('/save-analyse-traitement', [ConsultationController::class,('save_analyse_traitement')]);
Route::post('/payer-analyse', [SalesController::class, 'pay_analyse'])->name('pay_analyse');
Route::post('/add_patient', [SalesController::class, 'add_patient'])->name('add_patient');
Route::get('/ticket/{panier_analyse_id}', [SalesController::class, 'generateTicket'])->name('ticket.generate');
Route::post('/generate-pdf/{patient_id}/{payed_analyse_id}/{services_id}', [SalesController::class, 'generateTicket'])->name('generate_pdf');
Route::get('/verifier-recu/{filename}', function ($filename) {
    $filePath = public_path('storage/pdfs/' . $filename);
    
    if (file_exists($filePath)) {
        return response()->file($filePath);
    } else {
        return response()->json(['message' => 'Reçu non trouvé.'], 404);
    }
})->name('verifier-recu');

Route::get('/test-qrcode', function () {
    return response(QrCode::format('svg')->size(200)->color(100, 200, 100)->generate('https://www.irokotour.com'))
        ->header('Content-Type', 'image/svg+xml');
});
Route::get('/demande-externe', [PriseEnChargeController::class,('demande_ext')]);
Route::get('/enregistrer-demande-externe', [PriseEnChargeController::class,('record_demande_ext')]);
Route::post('/save-demande-externe', [PriseEnChargeController::class,('save_demande_ext')])->name('save.demandeExt');
Route::post('send-demande-ext', [ConsultationController::class,('send_demande_ext')]);
Route::get('gestion-demande-ext', [PriseEnChargeController::class,('caisse_demande_ext')]);
Route::get('/verify-receipt/{receipt_id}', [SalesController::class, ('verifyReceipt')]);

// Resultats analyses
Route::get('/edit-resultat/{patient_id}/{id_demande}', [ResultatController :: class,('edit')])->name('edit_resultat');
Route::post('/save-resultat/{patient_id}/{prestation_id}', [ResultatController ::class, ('save')])->name('save_resultat');
Route::get('/generate-pdf/{id_demande}', [ResultatController::class, ('generatePDF')])->name('generate_pdf');

// Urgence
Route::get('traitement-urgent-patient/{id_prise_en_charge}/{patient_id}', [ConsultationController::class,('traitement_urgent_patient')]);





//Pharmacie
Route::get('/all-category',[CategoryController::class, 'all_category']);
Route::post('/save-category',[CategoryController::class, 'save_category']);
Route::post('/save-rayon',[RayonController::class, 'save_rayon']);
Route::post('/save-srayon',[SrayonController::class, 'save_srayon']);
Route::post('/save-product',[ProductController::class, 'save_product']);

Route::get('/rayon-par-entite/{id}',[CategoryController::class, 'rayon_by_entite']);
Route::get('/sous-rayon-par-rayon-entite/{id}',[CategoryController::class, 'srayon_by_entite']);
Route::get('/produit-sous-rayon/{id}',[ProductController::class, 'produit_srayon']);

//Gestion vente stock approvisionnement
Route::get('/les-ventes',[AdminController::class, 'all_sales']);
Route::get('/choix-client',[SalesController::class, 'index_sale']);
Route::post('enregistrer-vente',[SalesController::class, 'index']);
Route::get('get-detail/{id}',[SalesController::class, 'get_detail']);
Route::get('get-panier/{guest_id}', [SalesController::class, 'get_panier']);
Route::post('/store-tabpanier',[SalesController::class, 'store_tabpanier']);
Route::get('delete-tabpanier/{id}',[SalesController::class, 'delete_tabpanier']);
Route::post('/make-caisse',[SalesController::class, 'make_caisse']);
Route::get('/make-facture/{order_id}',[SalesController::class, 'make_facture']);
Route::get('/etat-caisse/',[SalesController::class, 'etat_caisse']);
Route::get('/etat-stock/',[SalesController::class, 'etat_stock']);
Route::get('approvisionnement/',[SalesController::class, 'all_provision']);
Route::get('faire-appro/',[SalesController::class, 'faire_appro']);
Route::post('/post-appro/',[SalesController::class, 'post_caisse']);


Route::get('/logout', [AuthenticatedSessionController::class, 'destroy']);
Route::resource('admin',AdminController::class);
Route::resource('departement',DepartementController::class);
Route::resource('personnel', PersonnelController::class);
