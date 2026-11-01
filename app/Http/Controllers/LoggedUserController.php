<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Programa;
use App\Models\Canal;


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
        }
        $mejoresProgramas = Programa::orderBy('puntuacion','desc')->take(5)->get();
            $mejorCadena = Canal::orderBy('Puntuacion_Global', 'desc')->first();
            return view('Welcome')
            ->with('mejoresProgramas',$mejoresProgramas)
            ->with('mejorCadena', $mejorCadena);
    }


   
}
