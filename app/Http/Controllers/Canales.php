<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Canal;
use App\Models\programa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Canales extends Controller
{
    //Función para la creación de un canal
    public function crear(Request $request){
        //Obtener los parametros del formulario
        $nombre = $request->input('nombre');
        //Si tienen algun valor se procedera a procesar los datos
        if($nombre != null){
            //Conectar a la base de datos y verificar que el correo es único
            if(DB::table('Canales')->where('name', $nombre)->exists()
            ){
                return view('mensajeError')->with('mensaje','Ya existe un canal con el nombre especificado');
            }else{
                //Insertar en la base de datos
                DB::table('Canales')->insert([
                    'name' => $nombre,
                    'Puntuacion_Global' => 0
                ]);

                return view('mensajeExito')->with('mensaje','Operacion realizada exitosamente');
            }   
        }
    }

   //Funcion para la obtención del formulario de creación de canales
    public function formularioCreacion(){
        return view('crearCanal');
    }
    //Funcion para la obtención de los datos,se pasa una variable indicando la operación a realizar
    public function obtenerTodos(){
        $canales = DB::table('Canales')->get();
        return view('verCanales')->with('canales', $canales);
    }
    
   
    //Función dedicada a la obtención de los datos de un canal, manda a la vista la operación a realizar
    public function consultar(string $id){
        $canal = DB::table('Canales')->where('id',$id)->first();
        if($canal){
            $proximasEmisiones = Programa::whereDate('Fecha_transmision', '>=', now())->orderByDesc('Fecha_transmision')->where('ID_Canal', $id)->get();
            $mejoresProgramas = Programa::where('ID_Canal', $id)
                ->whereDate('Fecha_transmision', '<', now())    
                ->orderBy('Puntuacion','desc')
                ->take(3)
                ->get();
            return view('datosCanales')->with('canal', $canal)
            ->with('proximasEmisiones', $proximasEmisiones)
            ->with('mejoresProgramas' ,$mejoresProgramas);
        }else{
            return view('mensajeError')->with('mensaje','El canal especificado no existe');

        }
        
    }


    //Función dedicada al borrado de un usuario
    public function eliminar (string $id){
            
        //Verificar que el usuario existe
        $canal = DB::table('Canales')->where('id',$id)->first();
        //En caso de que exista
        if($canal != null){
            //Borrar
            $canal = DB::table('Canales')->where('id',$id)->delete();

            return view('mensajeExito')->with('mensaje','Operacion realizada exitosamente');
        //caso contrario
        }else{
            return view('mensajeError')->with('mensaje','El usuario especificado no existe');
        }

        
    }

    public function actualizar (Request $request, string $id){
        $canal = Canal::where('id', $id)->first();
        //Comprobar de que el nombre no se repita salvo en el de la propia entidad
        $nombreRepetido = Canal::where('name', $request->input('nombre'))->where('id', '!=', $id) ->exists();
        //Caso de que el nombre sea el del usuario a modificar
        if($canal && !$nombreRepetido){
            $canal->name = $request->input('nombre');
            $canal->save();
            return view('mensajeExito')->with('mensaje','Operacion realizada exitosamente');
        }else{
            return view('mensajeError')->with('mensaje','El nombre ya esta seleccionado para otro canal');

        }
    }


    public function consultarProgramas(string $id){
        $canal = Canal::where('id', $id)->first();
        if($canal != null){
            $programas = programa::where('ID_Canal', $id)->orderBy('Puntuacion', 'asc')->get();
            return view('verProgramasCadena')->with('programas', $programas)->with('canal', $canal);
        }else{
            return view('mensajeError')->with('mensaje','El canal especificado no existe');
        }
    }

    public function formularioCreacionPrograma(String $id){
        $canal = Canal::where('id', $id)->first();
        if($canal != null){
            return view('crearPrograma')
            ->with('fecha', date("Y-m-d"))
            ->with('canal', $canal);
        }else{
            return view('mensajeError')->with('mensaje','No se puede crear un programa para una cadena inexistente');
        }
    }
}
