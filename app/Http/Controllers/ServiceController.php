<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use App\Models\Personnel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class ServiceController extends Controller
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
      public function AdminAuthCheck()
      {
          $user_role_id=Session::get('user_role_id');
          if($user_role_id ==10){
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
        
        $services = Service::all();
      
        return view('Service.services-list',([
        
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
        $this->UserAuthCheck();
        
        return view('service.add-service');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->AdminAuthCheck();
        $this->UserAuthCheck();

        $request ->validate([
            'specialite' => ['string', 'required'],
            'service' => ['string', 'required'],
            'telephone'=>['string','required'],
            'email'=>['string','email','required'],
            'status'=>['string','required'],
            'chef_service' => 'string','nullable|exists:personnel,personnel_id',

        ]);
           
        Service::create($request->all());
        return redirect()->back()->with('ServiceCreated','Le service a été crée avec succès');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $user = Auth ::user();

        $users = User::all();
        return view('service.edit-service',[
           'name' => $user->name,
            'prenom' => $user->prenom,
            'role' => $user->role,
            'departement' => $user->departement,
            'service'=>$service,
            'users' =>$users,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
          $user = Auth::user();
            $user = User::all();
             $request -> validate([
            'libelle'=>['string','required'],
            'email'=>['string','email','required'],
            'telephone'=>['string','required'],
            'status'=>['string','required'],
            'specialite'=>['string','required'],
            'chief_service_id' => 'nullable|exists:users,id',

        ]);

        $service->update($request->all());
        //dd($request->all());



    return redirect()->back()->with('ServiceUpdated','Informations mises à jour avec succès');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->back()->with('ServiceDeleted', 'Les informations du services ont été supprimées avec succès');
    }



    public function entitieIndex()
    {
        return view('entities.entitie-index');
    }

    public function entitieCreate()
    {
        $this->AdminAuthCheck();
        $this->UserAuthCheck();
        return view('entities.add-entitie');
    }

    public function entitieStore(Request $request)

    {
        $this->AdminAuthCheck();
        $this->UserAuthCheck();

        
        $validatedData = $request->validate([
           
            'nom_entite' => 'required|string|max:255',
            'directeur' => 'string','nullable|exists:personnel,personnel_id',
           
        ]);

    //    dd($validatedData);
            $inserted = DB::table('tbl_entite')->insert([
            'nom_entite' => $validatedData['nom_entite'],
            'directeur' => $validatedData['directeur'],
            'date_entite' => now(),
            'updated_at' => now(),
        ]);

   
        if ($inserted) {
            return redirect()->back()->with('success', 'Chambre ajoutée avec succès.');
        } else {
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de l\'ajout de la chambre.');
        }

    }

    public function entitieShowDirecteur($id, $nom, $prenom)
    {
        $this->AdminAuthCheck();
        $this->UserAuthCheck();
        {
            
            $directeur = DB::table('personnel')->where('id', $id)->first();
    
            if (!$directeur) {
                return redirect()->route('clinique.index')->with('error', 'Directeur introuvable.');
            }
    
            return view('staff.show-staff', compact('directeur'));
        }
    }

    public function centerIndex()
    {
        $this->AdminAuthCheck();
        $this->UserAuthCheck();
        return view('centers.center-index');
    }

    public function centerCreate()
    {
        $this->AdminAuthCheck();
        $this->UserAuthCheck();
        return view('centers.add-center');
    }

    public function centerStore(Request $request)

    {
        $this->AdminAuthCheck();
        $this->UserAuthCheck();

        
        $validatedData = $request->validate([
           
            'nom_centre' => 'required|string|max:255',
            'id_entite' => 'string','nullable|exists:tbl_entite,id_entite',
            'id_directeur' => 'string','nullable|exists:personnel,id',
           
        ]);

    //    dd($validatedData);
            $inserted = DB::table('tbl_centre')->insert([
            'nom_centre' => $validatedData['nom_centre'],
            'id_entite' => $validatedData['id_entite'],
            'id_directeur' => $validatedData['id_directeur'],
            'date_centre' => now(),
            'updated_at' => now(),
        ]);

   
        if ($inserted) {
            return redirect()->back()->with('success', 'Chambre ajoutée avec succès.');
        } else {
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de l\'ajout de la chambre.');
        }

    }
}