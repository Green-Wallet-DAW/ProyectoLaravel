<?php

use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

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

Route::get('/usuarios', [UsuarioController::class, 'indexUsers'])->name('usuarios');
Route::get('/showUser/{id}', [UsuarioController::class, 'showUser'])->name('showUser');
Route::get('/editUser/{id}', [UsuarioController::class, 'editUser'])->name('editUser');
Route::patch('/updateUser/{id}', [UsuarioController::class, 'updateUser'])->name('updateUser');
Route::delete('/deleteUser/{id}', [UsuarioController::class,'deleteUser'])->name('deleteUser');
Route::view('/createUser', 'createUser');
Route::patch('/addUser', [UsuarioController::class, 'addUser'])->name('addUser');