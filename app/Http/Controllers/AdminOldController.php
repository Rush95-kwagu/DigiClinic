<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    public function index()
    {
       $user = Auth::user();

        return view ('admin/index', [
        'name' => $user->name,
        'prenom' => $user->prenom,
        'role' => $user->role,
        'departement' => $user->departement,
    ]);
    }

    public function create()
    {
        return view('signup');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
             'password' => Hash::make($request->password),
             'role' => $request->role, // Optionnel, selon la logique d'application
            'departement' => $request->departement, // Option
        ]);


        Auth::login($user);

        return redirect()->back()->with('Compte créé avec succès'); // Modifier selon la route appropriée après l'inscription
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}