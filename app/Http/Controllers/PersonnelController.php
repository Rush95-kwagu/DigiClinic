<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Personnel;
use App\Rules\UniqueEmail;
use App\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DepartementGenerale;
use App\Models\DepartementSpeciale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class PersonnelController extends Controller
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
        $this->AdminAuthCheck();
        
        return view ('staff.staff');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->UserAuthCheck();
        $this->AdminAuthCheck();
        
       return view('staff.add-staff');
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
        'nom' => ['string','required'],
        'prenom'=> ['string','required'],
        'birthdate'=> ['string','required'],
        'qualification'=> ['string','required'],
        'ville'=> ['string','required'],
        'email'=> ['required', 'email'],
        'adresse'=> ['string','required'],
        'service_id'=> ['string','nullable'],
        
        'telephone'=> ['string','required'],
        'departement'=> ['string','required'],
        'sexe'=> ['string','required'],
        ]);

        // dd($request->all());
        Personnel::create($request->all());

        return redirect()->back()->with('PersonnalAdded', 'Informations sauvegardées avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}