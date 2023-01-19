<?php

use App\Http\Controllers\serviceListController;
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
Route::view('/usuarios','usuarios');
Route::view('/serviceList', 'serviceList');
// Route::get('/usuarios', [serviceListController::class, 'usuarios']);
