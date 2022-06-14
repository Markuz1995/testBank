<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        //validacion de password de 4 cifras nomas
        $credentials = $request->validate([
            'id_card' => ['required'],
            'password' => ['required'],
        ],
        [
            'id_card.required' => 'El campo cedula es requerido',
            'password.required' => 'El campo contraseña es requerido',
        ]);
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
  
        return redirect("/")->with('invalid', 'Credenciales erroneas');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
