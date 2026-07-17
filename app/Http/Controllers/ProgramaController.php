<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Programa;
use DateTime;


class ProgramaController extends Controller
{
    //Función para la creación de un programa
    public function crear(Request $request, string $id){
            
        if(Auth::user()->Admin == 1){    
            //Obtener los parametros del formulario
        
            $nombre = $request->input('Nombre');
            $fecha = $request->input('Fecha');
            $duracion = $request->input('Duracion');
            $hora = $request->input('Hora');
            $cadena = $request->input('Cadena');

            
            $diaTiempo = new DateTime($fecha. ' '. $hora);
            $diaTiempoActual = new DateTime();
        
            if($diaTiempo > $diaTiempoActual){
                
                //Conectar a la base de datos y verificar que el canal existe
                if(DB::table('Canales')->where('name', $cadena)->exists()
                ){
                    return view('mensajeError')->with('mensaje','La cadena especificada no existe');
                }else{
                    //Insertar en la base de datos
                    DB::table('programa')->insert([
                        'name' => $nombre,
                        'Fecha_transmision' => $fecha,
                        'Duracion' => $duracion,
                        'Hora_emision' => $hora,
                        'ID_Canal' => $id,
                        'Puntuacion' => 0
                    ]);

                    return view('mensajeExito')->with('mensaje','Operacion realizada exitosamente');
                }   
            }else{
                return view('mensajeError')->with('mensaje','Parametros erroneos');
            }
        }else{
            return view('mensajeError')->with('mensaje','Acceso no autorizado');
        }
    }


   
    public function consultarTodos(){
            
          
        $programas = DB::table('programa')->get();
        return view('verTodosProgramas')->with('programas',$programas);
        
    }

    public function guia(){
        
        $programas = Programa::whereDate('Fecha_transmision', '>=', now())->orderByDesc('Fecha_transmision')->get();

        return view('guia')->with('programas', $programas);
    }


    //Función para la creación de un programa
    public function consultar(String $id){
        $programa = Programa::where('id', $id)->first();
        if(!empty(Auth::user()) && Auth::user()->Admin == 1){
            return view('datosProgramas')->with('programas',$programa);
        }else{
            return view('datosProgramasPublico')->with('programas',$programa);
        }
        
    }





    //Función dedicada al borrado de un canal
    public function eliminar (string $id){
        //Comprobar permisos de usuario que ejecute la operacion.
        if(Auth::user()->Admin == 1){
            //Verificar que el usuario existe
            $programa = DB::table('programa')->where('id',$id)->first();
            //En caso de que exista
            if($programa != null){
                //Borrar
                $programa = DB::table('programa')->where('id',$id)->delete();

                return view('mensajeExito')->with('mensaje','Operacion realizada exitosamente');
            //caso contrario
            }else{
                return view('mensajeError')->with('mensaje','El programa especificado no existe');
            }
        }else{
            return view('mensajeError')->with('mensaje','Acceso no autorizado');
        }
    }


    //Función para la actualizacion de un programa
    public function actualizar(Request $request, string $id){
            
        if(Auth::user()->Admin == 1){    
            //Obtener los parametros del formulario
        
            $nombre = $request->input('Nombre');
            $fecha = $request->input('Fecha');
            $duracion = $request->input('Duracion');
            $hora = $request->input('Hora');
            $cadena = $request->input('Cadena');

            
            $diaTiempo = new DateTime($fecha. ' '. $hora);
            $diaTiempoActual = new DateTime();
        
            if($diaTiempo > $diaTiempoActual){
                $canal = DB::table('Canales')->where('name', $cadena)->first();
                //Conectar a la base de datos y verificar que el canal existe
                if(empty($canal)
                ){
                    return view('mensajeError')->with('mensaje','La cadena especificada no existe');
                }else{
                    $programa = Programa::where('id', $id)->first();

                    $programa->name = $nombre;
                    $programa->Fecha_Transmision = $fecha;
                    $programa->Duracion = $duracion;
                    $programa->Hora_Emision = $hora;
                    $programa->ID_Canal = $canal->id;
                    $programa->save();

                    return view('mensajeExito')->with('mensaje','Operacion realizada exitosamente');
                }   
            }else{
                return view('mensajeError')->with('mensaje','Parametros erroneos, la fecha es inferior a la actual');
            }
        }else{
            return view('mensajeError')->with('mensaje','Acceso no autorizado');
        }
    }
    


    public function formularioModificacionPrograma(String $id){
        if(Auth::user()->Admin == 1){
            
            $programa = Programa::where('id', $id)->first();
            if($programa != null){
                return view('modificarPrograma')
                ->with('fecha', date("Y-m-d"))
                ->with('programa', $programa);
            }else{
                return view('mensajeError')->with('mensaje','El programa especificado no existe');
            }
            
        }else{
            return view('mensajeError')->with('mensaje','Acceso no autorizado');
        }
    }


    public function obtenerLista(){
        if(!empty(Auth::user())){
            $programas = Programa::whereDate('Fecha_transmision', '<=', now())->orderByDesc('Fecha_transmision')->take(10)->get();

            return view('ListaCanales')->with('programas', $programas);
        }else{
            return view('mensajeError')->with('mensaje','Acceso no autorizado');
        }
    }
    
}
