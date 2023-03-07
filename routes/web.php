<?php

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\serviceListController;
use Illuminate\Support\Facades\Route;

//Controlador de las maquinas disponibles
use App\Http\Controllers\MachinesController;


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


// Fin de las rutas


Route::view('/registrar', 'registrar')->name('registrar');
Route::patch('/registro', [AuthController::class, 'registro'])->name('registro');
Route::view('/login', 'login')->name('login');
Route::post('/login_usuario', [AuthController::class, 'login_usuario'])->name('login_usuario');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');




Route::group(['middleware' => 'admin'], function(){

    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('/prueba','prueba');
Route::view('/serviceList', 'serviceList')->name('serviceList');;

//Ruta de las mquinas disponibles
Route::get('/machines', [MachinesController::class, 'machineIndex'])->name('machines');
Route::patch('/addMachines', [MachinesController::class, 'addMachines'])->name('addMachines');
Route::get('/editMachines{id}', [MachinesController::class,'editMachines'])->name('editMachines');
Route::get('/updateMachine/{id}', [MachinesController::class,'updateMachine'])->name('updateMachine');
Route::delete('/deleteMachines/{id}', [MachinesController::class, 'deleteMachines'])->name('deleteMachines');

// Rutas de las vistas de los servicios
Route::view('/serviceList', 'serviceList');
Route::get('/serviceList', [serviceListController::class, 'showservices'])->name('serviceList');

Route::view('/createService', 'createService')->name('createService');;
Route::patch('/addService', [serviceListController:: class, 'addService'])->name('addService');

Route::get('/editServices{id}', [serviceListController::class, 'editServices'])->name('editServices');
Route::get('/updateService{id}', [serviceListController::class, 'updateService'])->name('updateService');
Route::get('/deleteServices{id}', [serviceListController::class, 'deleteService'])->name('deleteService');

Route::view('/plantilla', 'plantilla');
Route::view('/plantillaUser', 'plantillaUser');


    Route::get('/usuarios', [UsuarioController::class, 'indexUsers'])->name('usuarios');
    // Route::get('/usuarios', [UsuarioController::class, 'indexUsers'])->name('usuarios');
    // Route::get('/usuarios/list', [UsuarioController::class, 'getUsers'])->name('users.list');
    Route::get('/showUser/{id}', [UsuarioController::class, 'showUser'])->name('showUser');
    Route::get('/editUser/{id}', [UsuarioController::class, 'editUser'])->name('editUser'); //Formu
    Route::patch('/updateUser/{id}', [UsuarioController::class, 'updateUser'])->name('updateUser');
    Route::delete('/deleteUser/{id}', [UsuarioController::class,'deleteUser'])->name('deleteUser');
    Route::view('/createUser', 'createUser')->name('createUser');
    Route::patch('/addUser', [UsuarioController::class, 'addUser'])->name('addUser');

    Route::view('/facilities', 'facilities');



    Route::get('/comunidadIndex', [ComunidadController::class, 'comunidadIndex'])->name('comunidadIndex');
    Route::patch('/comunidadAlmacenar', [ComunidadController::class, 'almacenarAdmin'])->name('comunidadAlmacenar');
    Route::get('/comunidadEditar/{id}', [ComunidadController::class,'editarAdmin'])->name('comunidadEditar');
    Route::patch('/comunidadActualizar/{id}', [ComunidadController::class,'actualizarAdmin'])->name('comunidadActualizar');
    Route::delete('/comunidadBorrar/{id}', [ComunidadController::class,'borrarAdmin'])->name('comunidadBorrar');
    Route::view('/comunidadInsertar','comunidadInsertar')->name('comunidadInsertar');

    Route::get('/showCom/{id}', [ComunidadController::class, 'showCom'])->name('showCom');

});




