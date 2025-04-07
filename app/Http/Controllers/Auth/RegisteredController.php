<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect; 

class RegisteredController extends Controller
{
    public function create()
    {
        return view('signup');
    }

    public function store(Request $request)
    {

        $personnel=DB::table('personnel')
                ->where('email',$request->email)
                ->first();

        $user=DB::table('users')
                ->where('email',$request->email)
                ->first();

       

        if (!isset($personnel)) {
        Session::put('error', 'Echec d\'inscription : Ce personnel n\'existe pas');
         return back();
        }

        if($user){
        Session::put('error', 'Echec d\'inscription : Ce personnel est déjà inscrit');
         return back();
        }
    
        $user = new User();
        $user->email = $request->input('email');
        $user->password = md5($request->input('password'));
        $user->user_role_id = $request->input('user_role_id');
        $user->save();
       
        Session::put('succes','Le personnel a été inscris avec succès');
         return Redirect::to('/');
     
    }
}
