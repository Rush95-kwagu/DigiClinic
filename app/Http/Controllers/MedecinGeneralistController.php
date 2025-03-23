<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedecinGeneralistController extends Controller
{
      public function index()
   {
        $user = Auth::user();
        return view('Doctor.index', [
            'name' => $user->name,
            'prenom' => $user->prenom,
            'role' => $user->role,
            'departement' => $user->departement,
        ]);
   }
   public function patient()
   {
    $user = Auth::user();
    return view('patient.index', [
            'name' => $user->name,
            'prenom' => $user->prenom,
            'role' => $user->role,
            'departement' => $user->departement,
        ]);
   }

   public function profil()
   {
    $user = Auth::user();
    return view('doctor.doctors-profile', [
            'name' => $user->name,
            'prenom' => $user->prenom,
            'role' => $user->role,
            'departement' => $user->departement,
        ]);
   }
   public function ListePatient()
   {
    $user = Auth::user();
    return view('patient.patients-list', [
            'name' => $user->name,
            'prenom' => $user->prenom,
            'role' => $user->role,
            'departement' => $user->departement,
        ]);
   }

   public function WaitingPatient()
   {
    $user = Auth::user();
    return view('appointment.appointments-list', [
            'name' => $user->name,
            'prenom' => $user->prenom,
            'role' => $user->role,
            'departement' => $user->departement,
        ]);
   }



}