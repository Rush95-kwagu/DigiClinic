<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
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

        
        return view('room.index');
    }
    public function allottedRoom()
    {
        $this->UserAuthCheck();

        return view('room.allotted-room');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Room.add-room');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->AdminAuthCheck();
        $this->UserAuthCheck();

        
        $validatedData = $request->validate([
            'libelle_chambre' => 'required|integer|unique:tbl_chambre,libelle_chambre',
            'type_chambre' => 'required|string|max:255',
            'etat_chambre' => 'required|string|max:50',
            'is_vip' => 'required|string|max:50',
            'id_centre' => 'required|string|max:50',
            'id_services' => 'required|string|max:50',
        ]);

       
        $inserted = DB::table('tbl_chambre')->insert([
            'libelle_chambre' => $validatedData['libelle_chambre'],
            'type_chambre' => $validatedData['type_chambre'],
            'etat_chambre' => $validatedData['etat_chambre'],
            'is_vip' => $validatedData['is_vip'],
            'id_centre' => $validatedData['id_centre'],
            'id_services' => $validatedData['id_services'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

   
        if ($inserted) {
            return redirect()->back()->with('success', 'Chambre ajoutée avec succès.');
        } else {
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de l\'ajout de la chambre.');
        }
    }

        
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function available()
    {
        return view('room.available-room');
    }

    public function allotted()
    {
        return view('room.allotted-room');
    }
}