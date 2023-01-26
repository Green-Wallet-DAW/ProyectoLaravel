<?php

use App\Http\Controllers\serviceListController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComunidadController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('/prueba','prueba');
Route::view('/users','users');
Route::view('/serviceList', 'serviceList');
Route::view('/facilities', 'facilities');

Route::get('/comunidadIndex', [ComunidadController::class, 'indexAdmin'])->name('comunidadIndex');
Route::post('/comunidadAlmacenar', [ComunidadController::class, 'almacenarAdmin'])->name('comunidadAlmacenar');
Route::get('/comunidadEditar/{id}', [ComunidadController::class,'editarAdmin'])->name('comunidadEditar');
Route::patch('/comunidadActualizar/{id}', [ComunidadController::class,'actualizarAdmin'])->name('comunidadActualizar');
Route::delete('/comunidadBorrar/{id}', [ComunidadController::class,'borrarAdmin'])->name('comunidadBorrar');
Route::view('/comunidadInsertar','comunidadInsertar')->name('comunidadInsertar');