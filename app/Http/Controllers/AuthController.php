<?php

namespace App\Http\Controllers;

use session;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login_Vue(){
        return view('Authentifiaction.login');
    }
    public function login_traitement(AuthRequest $request){
        // dd($request);
        if(Auth::attempt($request->only(['email', 'password'])))
        {
            $request->session()->regenerate();
            return redirect()->intended(route('panel'));
       }else{
            return redirect()->back()->with('error_msg', 'Paremetre de ressources non reconnue');
        }
    }
    public function logout(){
        Auth::logout();
        return to_route('login');
    }
}
