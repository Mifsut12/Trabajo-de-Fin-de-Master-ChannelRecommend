<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usuario;
use App\Http\Controllers\LoggedUserController;
use App\Http\Controllers\Canales;
use App\Http\Controllers\ProgramaController;
use App\Http\Controllers\reviewController;
Route::get('/', function () {
    return view('welcome');
});






//Rutas de usuario
Route::get('/usuario', function () {
    return view('crearUsuario');
});

Route::post('/login', [Usuario::class, 'Login']);

Route::get('/menuLogin', [LoggedUserController::class, 'menuLogin']);

Route::post('/menuLogin/logout', [LoggedUserController::class, 'cerrarSesion']);

Route::get('/usuarios/nuevo', [Usuario::class, 'formularioCreacion']);//PREGUNTAR POR ESTO

Route::post('/usuarios', [Usuario::class, 'registrar']);

Route::get('/usuarios', [Usuario::class, 'consultar']);

Route::get('/usuarios/{id}', [Usuario::class, 'especificar']);

Route::delete('/usuarios/{id}', [Usuario::class, 'eliminar']);

Route::patch('/usuarios/{id}', [Usuario::class, 'actualizar']);

// Rutas de canales 

Route::get('/canales/nuevo', [Canales::class, 'formularioCreacion']);

Route::post('/canales', [Canales::class, 'crear']);

Route::get('/canales', [Canales::class, 'obtenerTodos']);

Route::get('/canales/{id}', [Canales::class, 'consultar']);

Route::get('/canales/{id}/programas', [Canales::class, 'consultarProgramas']);

Route::delete('/canales/{id}', [Canales::class, 'eliminar']);

Route::patch('/canales/{id}', [Canales::class, 'actualizar']);

//Rutas de programas


Route::get('/canales/{id}/programas/nuevo', [Canales::class, 'formularioCreacionPrograma']);

Route::post('/canales/{id}/programas', [ProgramaController::class, 'crear']);

Route::get('/programas', [ProgramaController::class, 'consultarTodos']);

Route::post('/programas/{id}/modificar', [ProgramaController::class, 'formularioModificacionPrograma']);

Route::get('/programas/{id}', [ProgramaController::class, 'consultar']);

Route::patch('/programas/{id}', [ProgramaController::class, 'actualizar']);

Route::get('/guia', [ProgramaController::class, 'guia']);


//Rutas de reseña
Route::get('/reviews/nuevo/{id}', [reviewController::class, 'formularioCreacion']);

Route::post('/reviews/modificar/{id}', [reviewController::class, 'formularioModificacion']);

Route::post('/reviews', [reviewController::class, 'crear']);

Route::get('/reviews', [reviewController::class, 'obtenerTodos']);

Route::get('/menuLogin/reviews/{id}', [reviewController::class, 'consultarTodasReviewsUsuario']);

Route::get('/menuLogin/reviews/{id}/nuevo', [ProgramaController::class, 'obtenerLista']);

Route::get('/reviews/{id}', [reviewController::class, 'consultar']);

Route::delete('/reviews/{id}', [reviewController::class, 'eliminar']);

Route::patch('/reviews/{id}', [reviewController::class, 'actualizar']);

Route::get('/reviews/programa/{id}', [reviewController::class, 'consultarTodasReviewsPrograma']);