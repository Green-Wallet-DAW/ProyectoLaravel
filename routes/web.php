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
Route::patch('/addMachines', [MachinesController::class, 'addMachines'])->name('addMachines');
Route::get('/editMachines{id}', [MachinesController::class,'editMachines'])->name('editMachines');
Route::get('/updateMachine/{id}', [MachinesController::class,'updateMachine'])->name('updateMachine');
Route::delete('/deleteMachines/{id}', [MachinesController::class, 'deleteMachines'])->name('deleteMachines');
