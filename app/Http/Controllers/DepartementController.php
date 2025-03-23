<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use App\Models\Personnel;
use App\Models\Departement;
use Illuminate\Http\Request;
use App\Models\DepartementGenerale;
use App\Models\DepartementSpeciale;
use Illuminate\Support\Facades\Auth;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user= Auth::user();

     //  $departements = Departement::with('departementGenerale')->get();
       // $departementSpeciale = DepartementSpeciale::all();
//$Alldepartement = $departement->departementGenerale;

       $alldepartement = Departement::with('departementSpeciale','departementGenerale','chef')->get();
    //    $alldepartement = DepartementGenerale::join('departement', 'departement_generales.id', '=','departement.departement_generale_id')
    //                                         ->join('departement_speciales','departement.departement_speciale_id', '=', 'departement_speciales.id')
    //                                         ->select('departement_generales.*', 'departement_speciales.*')
    //                                         ->get();
//dd($alldepartement);
        //$departementGenerale = DepartementGenerale::all();
        //dd($alldepartement);
        //$departementSpeciale = DepartementSpeciale::with('departementSpeciale')->get();
        $users = User::all();
        $services = Service::all();
        //d($departements);
        return view('departement.department-list', ([
        'name' => $user->name,
        'prenom' => $user->prenom,
        'role' => $user->role,
        'departement' => $user->departement,
        'alldepartement' => $alldepartement,
        'users'=>$users,
        'services'=>$services,
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $user = Auth::user();
        $departements = Departement::all();
        $users = User::all();
        $personnel = Personnel::all();
        $services = Service::all();

        return view('departement.add-department', ([
        'name' => $user->name,
        'prenom' => $user->prenom,
        'role' => $user->role,
        'departement' => $user->departement,
        'departements' => $departements,
        'users'=>$users,
        'services'=>$services,
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $user = Auth::user();
        $request->validate([
            'code_depart'=>['string','required'],
            'libelle'=>['string','required'],
            'telephone'=>['string','required'],
            'medecin_id'=>'nullable|exists:users,id',
            'status'=>['string','required'],
            'email'=>['string','email', 'required'],
           'service_id'=>'nullable|exists:service,id',
            'chef_departement_id' =>'nullable|exists:users,id'
        ]);

        //dd($request->all());
        if ($request->input('libelle')==='Médecine Générale'){
            $departement = DepartementGenerale::create($request->all());

            Departement::create([
                'departement_generale_id' => $departement->id,
                'departement_speciale_id' =>null,
            ]);
            }else{
                $departement = DepartementSpeciale::create($request->all());
                 Departement::create([
                'departement_generale_id' => null,
                'departement_speciale_id' =>$departement->id,
            ]);
        }

        return redirect()->back()->with('DepartementCreated', 'Les informations ont été ajoutées avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function show(Departement $departement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function edit(Departement $departement)
    {
        $user = Auth::user();
        $departements = Departement::all();
        $users = User::all();
        $personnel = Personnel::all();
        $services = Service::all();

       return view('departement.edit-department', ([
        'name' => $user->name,
        'prenom' => $user->prenom,
        'role' => $user->role,
        'departement' => $user->departement,
        'departements' => $departements,
        'users'=>$users,
        'services'=>$services,
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Departement $departement)
    {
         $user = Auth::user();
        $request->validate([
            'code_depart'=>['string','required'],
            'libelle'=>['string','required'],
            'telephone'=>['string','required'],
            'medecin_id'=>'nullable|exists:users,id',
            'status'=>['string','required'],
            'email'=>['string','email', 'required'],
           'service_id'=>'nullable|exists:service,id',
            'chef_departement_id' =>'nullable|exists:users,id'
        ]);

        $departement->update($request->all());


        return redirect()->back()->with('DepartementCreated', 'Les informations ont été ajoutées avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departement $departement)
    {
        $departement->delete();
        return redirect()->back()->with('DepartementDeleted', 'Action réussie: Département supprimé');


    }
}