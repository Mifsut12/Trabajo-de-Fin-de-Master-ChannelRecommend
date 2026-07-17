<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoggedUserController;
class Usuario extends Controller
{
    //Función para la creación de un usuario
    public function registrar(Request $request){
        if(Auth::user()->Admin == 1){
            //Obtener los parametros del formulario
            $correo = $request->input('email');
            $password = $request->input('password');
            $nombre = $request->input('nombre');
            //Si tienen algun valor se procedera a procesar los datos
            if($correo != null || $password != null || $nombre != null){
                //Conectar a la base de datos y verificar que el correo es único
                if(DB::table('usuarios')->where('email', $correo)->exists()
                ){
                    return view('mensajeError')->with('mensaje','El correo ya esta escogido');
                }else{
                    //Insertar en la base de datos
                    DB::table('usuarios')->insert([
                        'name' => $nombre,
                        'email' => $correo,
                        'password' => Hash::make($request->input('password')),
                        'admin' => 0
                    ]);

                    return view('mensajeExito')->with('mensaje','Operacion realizada exitosamente');
                }   
            }
        }else{
            return view('mensajeError')->with('mensaje','Acceso no autorizado');
        }
    }

    //Funcion para la obtención del formulario de creación de usuarios
    public function formularioCreacion(){
            
        if(Auth::user()->Admin == 1){
            return view('crearUsuario');
        }else{
            return view('mensajeError')->with('mensaje','Acceso no autorizado');
        }
    }
   
    //Funcion para la obtención de los datos.
    public function consultar(){
        if(Auth::user()->Admin == 1){
            $usuarios = DB::table('usuarios')->orderBy('name')->get();
            return view('verUsuarios')->with('usuarios', $usuarios);
        }else{
            return view('mensajeError')->with('mensaje','Acceso no autorizado');
        }
        
    }
    
   
    //Función dedicada a la obtención de los datos de un usuario
    public function especificar(string $id){
        if(Auth::user()->Admin == 1){
            $user = DB::table('usuarios')->where('id',$id)->first();
            return view('datosUsuario')-> with('user', $user)->with('operacion');
        }else{
            return view('mensajeError')->with('mensaje','Acceso no autorizado');
        }
    }


    //Función dedicada al borrado de un usuario
    public function eliminar (string $id){
        //Comprobar permisos de usuario que ejecute la operacion.
        if(Auth::user()->Admin == 1){
            //Verificar que el usuario existe
            $user = DB::table('usuarios')->where('id',$id)->first();
            //En caso de que exista
            if($user != null){
                //Borrar
                $user = DB::table('usuarios')->where('id',$id)->delete();

                return view('mensajeExito')->with('mensaje','Operacion realizada exitosamente');
            //caso contrario
            }else{
                return view('mensajeError')->with('mensaje','El usuario especificado no existe');
            }
        }else{
            return view('mensajeError')->with('mensaje','Acceso no autorizado');
        }
            
    }

    public function actualizar (Request $request, string $id){
        
        if(Auth::user()->Admin == 1){
            $user = User::where('id', $id)->first();

            
            $correoRepetido = User::where('email', $request->input('email'))->where('id', '!=', $id) ->exists();
            //Caso de que el correo sea el del usuario a modificar
            if($user && !$correoRepetido){
                $user->name = $request->input('nombre');
                $user->email = $request->input('email');
                $user->password = $request->input('password');

                $user->save();
                return view('mensajeExito')->with('mensaje','Operacion realizada exitosamente');
            }else{
                return view('mensajeError')->with('mensaje','El correo ya esta seleccionado para otro usuario');

            }
        }else{
            return view('mensajeError')->with('mensaje','Acceso no autorizado');
        }
    }


    //Función dedicada al login, registra al usuario
    public function login(Request $request){
        $user = User::where('email', $request->input('email'))->first();

        if($user && Hash::check($request->input('password'), $user->password)){
            //Guardar los datos para que laravel se garantice de que el usuario ha iniciado sesión.
            Auth::login($user);
                
            return redirect()->action([LoggedUserController::class, 'menuLogin']);
        }else{
            return view('mensajeError')->with('mensaje','El usuario especificado no existe');
        }
    }
}
