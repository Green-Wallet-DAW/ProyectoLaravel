<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ComunidadController;
use App\Http\Controllers\InstalacionController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\MaquinaController;
use App\Http\Controllers\BdController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/usuarios', [UsuarioController::class, 'index']);
Route::put('/usuario/actualizar/{id}', [UsuarioController::class, 'update']);
Route::post('/usuario/guardar', [UsuarioController::class, 'store']);
Route::delete('/usuario/borrar/{id}', [UsuarioController::class, 'destroy']);
Route::get('/usuario/buscar/{id}', [UsuarioController::class, 'show']);


Route::get('/comunidades', [ComunidadController::class, 'index']);
Route::put('/comunidad/actualizar/{id}', [ComunidadController::class, 'update']);
Route::post('/comunidad/guardar', [ComunidadController::class, 'store']);
Route::delete('/comunidad/borrar/{id}', [ComunidadController::class, 'destroy']);
Route::get('/comunidad/buscar/{id}', [ComunidadController::class, 'show']);


Route::get('/servicios', [ServicioController::class, 'index']);
Route::put('/servicio/actualizar/{id}', [ServicioController::class, 'update']);
Route::post('/servicio/guardar', [ServicioController::class, 'store']);
Route::delete('/servicio/borrar/{id}', [ServicioController::class, 'destroy']);
Route::get('/servicio/buscar/{id}', [ServicioController::class, 'show']);


Route::get('/instalaciones', [InstalacionController::class, 'index']);
Route::put('/instalacion/actualizar/{id}', [InstalacionController::class, 'update']);
Route::post('/instalacion/guardar', [InstalacionController::class, 'store']);
Route::delete('/instalacion/borrar/{id}', [InstalacionController::class, 'destroy']);
Route::get('/instalacion/buscar/{id}', [InstalacionController::class, 'show']);


Route::get('/maquinas', [MaquinaController::class, 'index']);
Route::put('/maquina/actualizar/{id}', [MaquinaController::class, 'update']);
Route::post('/maquina/guardar', [MaquinaController::class, 'store']);
Route::delete('/maquina/borrar/{id}', [MaquinaController::class, 'destroy']);
Route::get('/maquina/buscar/{id}', [MaquinaController::class, 'show']);


Route::get('/unirseacomunidad', [BdController::class, 'unirseacomunidad']);
Route::get('/miscomunidades', [BdController::class, 'miscomunidades']);
