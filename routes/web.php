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

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('/prueba','prueba');
Route::view('/users','users');
Route::view('/serviceList', 'serviceList');
Route::get('/serviceList', [serviceListController::class, 'showservices'])->name('serviceList');
Route::get('/editServices/{id}', [serviceListController::class, 'editServices'])->name('editServices');
Route::get('/updateService{id}', [serviceListController::class, 'updateService'])->name('updateService');