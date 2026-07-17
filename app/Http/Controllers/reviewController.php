<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\review;
use App\Models\Programa;
use Illuminate\Support\Facades\DB;
use App\Models\review_programa;
use App\Models\Canal;
use DateTime;

class reviewController extends Controller
{
    //Función para la creación de una reseña
    public function crear(Request $request){
            
        if(Auth::user()->Admin == 0){    
            //Obtener los parametros del formulario
            $contenido = $request->input('Contenido');
            $puntuacion = $request->input('Puntuacion');
            $nombrePrograma = $request->input('Programa');
            //Conectar a la base de datos y verificar que el canal existe
            $programa = Programa::where('name',$nombrePrograma)->first();
            if(!empty($programa) && (($puntuacion < 11) && $puntuacion >= 0)){
                $ID_review = DB::table('reviews')->insertGetId([
                    'Contenido' => $contenido,
                    'Puntuacion_Reseña' => $puntuacion,
                    'ID_Usuario' => Auth::user()->id
                    ]);
                DB::table('reviews-programa')->insert([
                    'ID_Programa' => $programa->id,
                    'ID_Review' => $ID_review,
                    ]);
                $listaReviewsPrograma = review_programa::where('ID_Programa' ,$programa->id)->pluck('ID_Review');
                $mediaPuntuacion = DB::table('reviews')->whereIn('id', $listaReviewsPrograma)->avg('Puntuacion_Reseña');
                $programa->puntuacion = $mediaPuntuacion;
                $programa->save();
                
                $canal = Canal::where('id', $programa->ID_Canal)->first();
                $mediaPuntuacionProgramas = DB::table('programa')->where('ID_Canal', $programa->ID_Canal)->avg('Puntuacion');
                $canal->Puntuacion_Global = $mediaPuntuacionProgramas;
                $canal->save();

                return view('mensajeExito')->with('mensaje','Operación realizada exitosamente');

            }else{
                    return view('mensajeError')->with('mensaje','Error en los parametros, la puntuación o el programa son invalidos');
            }
        }   
    }


    //Función para la creación de un programa
    public function consultarTodasReviews(){
            $review = review_programa::all();
            return view('verTodasReviews')->with('reviews',$reviews);
    }


    //Función para la creación de un programa
    public function consultarTodasReviewsUsuario(){
        if(!empty(Auth::user())){   
            $reviewsUsuario = review::where('ID_Usuario', Auth::user()->id)->get();
            return view('verReviewsUsuario')->with('reviews',$reviewsUsuario);
        }else{
            return view('mensajeError')->with('mensaje', 'Debe autenticarse');
        }
    }

    //Función para la creación de un programa
    public function consultarTodasReviewsPrograma(String $id){
        $reviewsPrograma = review_programa::where('ID_Programa', $id)->get();
        return view('verReviewsPrograma')->with('reviews',$reviewsPrograma);
    }

    //Función para obtener todas las reseñas de un usuario
    public function consultarReview(String $id){  
        $reviewsUsuario = review_programa::where('id', $id);
        return view('verTodasReviews')->with('reviews',$reviewsUsuario);
    }

    //Función dedicada al borrado de una reseña
    public function eliminar (String $id){
        //Comprobar permisos de usuario que ejecute la operacion.
        if(Auth::user()){
            $reviewUsuario = review::where('id', $id)->first();
            
            $reviewPrograma = review_programa::where('ID_Review', $reviewUsuario->id)->first();
            $id = $reviewPrograma->ID_Programa;
            if($reviewUsuario && (($reviewUsuario->ID_Usuario == Auth::user()->id) || Auth::user()->Admin == 1)){
                $reviewUsuario = DB::table('reviews')->where('id',$reviewUsuario->id)->delete();

                //Calcular la media de nuevo
                $listaReviewsPrograma = review_programa::where('ID_Programa' ,$id)->pluck('ID_Review');
                
                $mediaPuntuacion = DB::table('reviews')->whereIn('id', $listaReviewsPrograma)->avg('Puntuacion_Reseña');
                $programa = Programa::where('id', $reviewPrograma->ID_Programa)->first();
                if($mediaPuntuacion != null){
                    
                    $programa->Puntuacion = $mediaPuntuacion;
                    
                }else{
                    $programa->Puntuacion = 0;
                }

                $programa->save();
                
                $canal = Canal::where('id', $programa->ID_Canal)->first();
                $mediaPuntuacionProgramas = DB::table('programa')->where('ID_Canal', $programa->ID_Canal)->avg('Puntuacion');
                $canal->Puntuacion_Global = $mediaPuntuacionProgramas;
                $canal->save();
                return view('mensajeExito')->with('mensaje','Operacion realizada exitosamente');
            }else{
                return view('mensajeError')->with('mensaje','Acceso no autorizado');
            }
        }
    }


    //Función para la actualizacion de un programa
    public function actualizar(Request $request, string $id){
        if(Auth::user()){
            $review = review::where('id', $id)->first();
            $reviewPrograma = review_programa::where('ID_Review', $review->id)->first();
            if($review && (($review->ID_Usuario == Auth::user()->id) || Auth::user()->Admin == 1)){    
                
            
                $contenido = $request->input('Contenido');
                $puntuacion = $request->input('Puntuacion');

                if($puntuacion <= 10 && $puntuacion >= 0){
                    $review->Contenido = $contenido;
                    $review->Puntuacion_Reseña = $puntuacion;
                    $review->save();
                    

                    //Calcular la media de nuevo
                    $listaReviewsPrograma = review_programa::where('ID_Programa' ,$reviewPrograma->ID_Programa)->pluck('ID_Review');
                    $mediaPuntuacion = DB::table('reviews')->whereIn('id', $listaReviewsPrograma)->avg('Puntuacion_Reseña');


                    $programa = Programa::where('id', $reviewPrograma->ID_Programa)->first();
                    $programa->puntuacion = $mediaPuntuacion;
                    $programa->save();

                    $canal = Canal::where('id', $programa->ID_Canal)->first();
                    $mediaPuntuacionProgramas = DB::table('programa')->where('ID_Canal', $programa->ID_Canal)->avg('Puntuacion');
                    $canal->Puntuacion_Global = $mediaPuntuacionProgramas;
                    $canal->save();



                    return view('mensajeExito')->with('mensaje','Operacion realizada exitosamente');
                }else{
                    return view('mensajeError')->with('mensaje','Valor de puntuación invalido');
                }            
            }else{
                return view('mensajeError')->with('mensaje','Acceso no autorizado al no ser dueño de la reseña');
            }   
        }else{
            return view('mensajeError')->with('mensaje','Acceso no autorizado,requiere de verificación por parte del usuario');
        } 
    }
    


    public function formularioModificacion(String $id){
        if(Auth::user()){
            $review = review::where('id', $id)->first();
           
            if($review != null && $review->ID_Usuario == Auth::user()->id){
                return view('modificarReview')
                ->with('review', $review);
            }else{
                return view('mensajeError')->with('mensaje','El programa especificado no existe');
            }
        }else{
            return view('mensajeError')->with('mensaje','Acceso no autorizado');
        }
    }


    public function formularioCreacion(String $id){
        if(!empty(Auth::user())){   
            $programa = Programa::where('id', $id)->first();
            $diaTiempo = new DateTime($programa->Fecha_transmision. ' '. $programa->Hora_emision);
            $diaTiempoActual = new DateTime();
            if($programa != null && $diaTiempo <= $diaTiempoActual){
                return view('crearReview')->with('programa',$programa);
            }else{
            return view('mensajeError')->with('mensaje','No es posible hacer una reseña del programa especificado, esto no existe o no ha sido retransmitido aún.');
            }
        }else{
            return view('mensajeError')->with('mensaje', 'Debe autenticarse');
        }
    }
}
