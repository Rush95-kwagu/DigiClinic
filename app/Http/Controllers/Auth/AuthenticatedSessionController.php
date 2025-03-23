<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect; 
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('login');
    }

    public function store(Request $request)
    {
    
    $email=$request->email;
    $password=md5($request->password);

    $infos=DB::table('personnel')
                ->where('email',$email)
                ->first(); 

    $acces=DB::table('users')
                ->where('email',$email)
                ->where('password',$password)
                ->first();

            if ($acces) {
               Session::put('user_id',$acces->user_id);
               Session::put('email',$acces->email);
               Session::put('user_role_id',$acces->user_role_id);
               Session::put('nom',$infos->nom);
               Session::put('prenom',$infos->prenom);
               Session::put('centre_id',$infos->id_centre);
               Session::put('qualification',$infos->qualification);
               $design=DB::table('user_roles')
                        ->where('user_role_id',$acces->user_role_id)
                        ->first(); 
               Session::put('role',$design->designation);
              
               return Redirect::to('/dashboard');
               
            }
               else
            { 
                Session::put('error','Email ou Mot de passe Invalide');
                return Redirect::to('/');
            }
    }

    public function destroy(Request $request)
    {
        Session::flush();
        Session::put('warn','Déconnexion effectuée');
        return Redirect::to('/');
    }
}