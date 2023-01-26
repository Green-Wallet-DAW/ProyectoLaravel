<?php

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\serviceListController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComunidadController;
use App\Http\Controllers\AuthController;

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
Route::view('/serviceList', 'serviceList');


Route::view('/plantilla', 'plantilla');
Route::view('/plantillaUser', 'plantillaUser');




Route::view('/login', 'login')->name('logear');
Route::post('/login-usuario', [AuthController::class, 'login'])->name('login');
Route::view('/registrar', 'registrar');
Route::post('/registro', [AuthController::class, 'registro'])->name('registro');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'admin'], function(){
    Route::get('/usuarios', [UsuarioController::class, 'indexUsers'])->name('usuarios');
    Route::get('/showUser/{id}', [UsuarioController::class, 'showUser'])->name('showUser');
    Route::get('/editUser/{id}', [UsuarioController::class, 'editUser'])->name('editUser');
    Route::patch('/updateUser/{id}', [UsuarioController::class, 'updateUser'])->name('updateUser');
    Route::delete('/deleteUser/{id}', [UsuarioController::class,'deleteUser'])->name('deleteUser');
    Route::view('/createUser', 'createUser');
    Route::patch('/addUser', [UsuarioController::class, 'addUser'])->name('addUser');
});



Route::view('/facilities', 'facilities');



Route::get('/comunidadIndex', [ComunidadController::class, 'indexAdmin'])->name('comunidadIndex');
Route::post('/comunidadAlmacenar', [ComunidadController::class, 'almacenarAdmin'])->name('comunidadAlmacenar');
Route::get('/comunidadEditar/{id}', [ComunidadController::class,'editarAdmin'])->name('comunidadEditar');
Route::patch('/comunidadActualizar/{id}', [ComunidadController::class,'actualizarAdmin'])->name('comunidadActualizar');
Route::delete('/comunidadBorrar/{id}', [ComunidadController::class,'borrarAdmin'])->name('comunidadBorrar');
Route::view('/comunidadInsertar','comunidadInsertar')->name('comunidadInsertar');

