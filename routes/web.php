<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usuario;
use App\Http\Controllers\LoggedUserController;
use App\Http\Controllers\Canales;
use App\Http\Controllers\ProgramaController;
use App\Http\Controllers\reviewController;








Route::middleware(['auth', 'can:solo-registrado'])->group(function (){
    
    Route::get('/reviews/nuevo/{id}', [reviewController::class, 'formularioCreacion']);

    Route::get('/reviews/modificar/{id}', function(){
        return view('/mensajeError')->with('mensaje', 'Recurso inaccesble');
    });

    Route::post('/reviews/modificar/{id}', [reviewController::class, 'formularioModificacion']);

    Route::post('/reviews', [reviewController::class, 'crear']);

    Route::get('/menuLogin/reviews/{id}', [reviewController::class, 'consultarTodasReviewsUsuario']);

    Route::get('/menuLogin/reviews/{id}/nuevo', [ProgramaController::class, 'obtenerLista']);

    Route::delete('/reviews/{id}', [reviewController::class, 'eliminar']);

    Route::patch('/reviews/{id}', [reviewController::class, 'actualizar']);
    
});

Route::middleware(['auth', 'can:solo-admin'])->group(function (){

    Route::get('/canales/nuevo', [Canales::class, 'formularioCreacion']);

    Route::delete('/canales/{id}', [Canales::class, 'eliminar']);

    Route::patch('/canales/{id}', [Canales::class, 'actualizar']);

    Route::get('/canales/{id}/programas/nuevo', [Canales::class, 'formularioCreacionPrograma']);

    Route::post('/canales/{id}/programas', [ProgramaController::class, 'crear']);

    Route::post('/programas/{id}/modificar', [ProgramaController::class, 'formularioModificacionPrograma']);

    Route::patch('/programas/{id}', [ProgramaController::class, 'actualizar']);

    Route::get('/usuarios/nuevo', [Usuario::class, 'formularioCreacion']);//

    Route::get('/usuarios/{id}', [Usuario::class, 'especificar']);

    Route::delete('/usuarios/{id}', [Usuario::class, 'eliminar']);

    Route::patch('/usuarios/{id}', [Usuario::class, 'actualizar']);

    Route::post('/usuarios', [Usuario::class, 'registrar']);

    Route::get('/usuarios', [Usuario::class, 'consultar']);

    Route::post('/canales', [Canales::class, 'crear']);
    
});


Route::get('/canales/{id}', [Canales::class, 'consultar']);

Route::get('/canales/{id}/programas', [Canales::class, 'consultarProgramas']);

Route::get('/reviews/{id}', function(){
        return view('/mensajeError')->with('mensaje', 'Recurso inaccesble');
});

Route::get('/reviews/programa/{id}', [reviewController::class, 'consultarTodasReviewsPrograma']);

Route::get('/', [ProgramaController::class, 'inicio'])->name('login');

//Rutas de usuario
Route::get('/usuario', function () {
    return view('crearUsuario');
});

Route::post('/login', [Usuario::class, 'Login']);

Route::get('/canales', [Canales::class, 'obtenerTodos']);

Route::get('/programas', [ProgramaController::class, 'consultarTodos']);

Route::get('/programas/{id}', [ProgramaController::class, 'consultar']);

Route::get('/guia', [ProgramaController::class, 'guia']);

Route::get('/menuLogin', [LoggedUserController::class, 'menuLogin']);

Route::post('/menuLogin/logout', [LoggedUserController::class, 'cerrarSesion'])->middleware('auth');
