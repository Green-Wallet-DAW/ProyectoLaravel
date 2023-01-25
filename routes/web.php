<?php

use Illuminate\Support\Facades\Route;

//Controlador de las maquinas disponibles
use App\Http\Controllers\MachinesController;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::view('/prueba','prueba');
Route::view('/users','users');
Route::view('/serviceList', 'serviceList');

//Ruta de las mquinas disponibles
Route::get('/machines', [MachinesController::class, 'machineIndex'])->name('machines');
Route::post('/addMachines', [MachinesController::class, 'addMachines'])->name('addMachines');
