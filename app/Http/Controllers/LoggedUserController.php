<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoggedUserController extends Controller
{
    public function menuLogin(){
        if (Auth::check()){
            return view('Login');
        }else{
            return view('mensajeError')->with('mensaje','Acceso denegado por falta de privilegios');
        }
    }


    public function cerrarSesion(Request $request){
        if (Auth::check()){
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return view('Welcome');
        }else{
            return view('mensajeError')->with('mensaje','Usted no ha iniciado sesión');
        }
    }


   
}
