<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ComunidadController;
use App\Http\Controllers\InstalacionController;
use App\Http\Controllers\serviceListController;
use App\Http\Controllers\MaquinaController;
use App\Http\Controllers\MachinesController;
use App\Http\Controllers\BdController;
use App\Http\Controllers\Service_UserController;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Community_ServicesController;

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
Route::group(['middleware' => 'cors'], function(){
    Route::get('/forgotPass/{email}', [AuthController::class, 'forgotPass']);
    Route::post('loginU', [AuthController::class,'loginU']);
    Route::post('registerU', [AuthController::class,'registerU']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::put('updateU', [AuthController::class, 'updateU']);
        Route::put('updatePass', [AuthController::class, 'updatePass']);
        Route::get('detailsU', [AuthController::class,'detailsU']);
        Route::get('logoutU', [AuthController::class,'logoutU']);


Route::get('/comunidades', [ComunidadController::class, 'index']);
Route::put('/comunidad/actualizar/{id}', [ComunidadController::class, 'update']);
// Route::post('/comunidad/guardar', [ComunidadController::class, 'store']);
Route::delete('/comunidad/borrar/{id}', [ComunidadController::class, 'destroy']);
Route::get('/comunidad/buscar/{id}', [ComunidadController::class, 'show']);

// Rutas de las API para que muestre los servicios
Route::get('/serviceList', [serviceListController::class, 'showAllServices']);
Route::get('/serviceList/user', [serviceListController::class, 'showUserServices']);
Route::get('/serviceList/community', [serviceListController::class, 'showCommunityServices']);
Route::get('/serviceList/search/{id}', [serviceListController::class, 'showServicesById']);
Route::get('/serviceList/hire/{user_id}/{serv_id}', [Service_UserController::class, 'hireService']);
Route::get('/serviceList/hireComm/{comm_id}/{serv_id}' , [Community_ServicesController::class, 'hireCommunityService']);
Route::get('/serviceList/checkServices/{user_id}', [Service_UserController::class, 'checkHiredServices']);
Route::get('/serviceList/checkCommunityServices/{comm_id}', [Community_ServicesController::class, 'checkCommunityHIredServices']);

// Fin Rutas Servicios

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

//Rutas generalView
Route::get('/instalaciontokens/{id}', [InstalacionController::class, 'instalaciontokens']);
Route::get('/generalview/{id}', [InstalacionController::class, 'globalHomeOverview']);
Route::get('/generalviewdaily/{id}', [InstalacionController::class, 'dailyHomeOverview']);
Route::get('/generalviewweekly/{id}', [InstalacionController::class, 'weeklyHomeOverview']);
Route::get('/generalviewmonth/{id}', [InstalacionController::class, 'monthHomeOverview']);
Route::get('/generalviewyear/{id}', [InstalacionController::class, 'yearHomeOverview']);
Route::get('/addfacility{id}', [InstalacionController::class, 'addfacility']);

//Rutas mydevices
Route::get('/mydevices/{id}', [MachinesController::class, 'globalDevicesOverview']);
Route::get('/mydevicesdaily/{id}', [MachinesController::class, 'dailyDevicesOverview']);
Route::get('/mydevicesweekly/{id}', [MachinesController::class, 'weeklyDevicesOverview']);
Route::get('/mydevicesmontly/{id}', [MachinesController::class, 'monthlyDevicesOverview']);
Route::get('/mydevicesyearly/{id}', [MachinesController::class, 'yearlyDevicesOverview']);


//Rutas generalView
Route::get('/generalview', [InstalacionController::class, 'globalHomeOverview']);
Route::get('/generalviewdaily', [InstalacionController::class, 'dailyHomeOverview']);
Route::get('/generalviewweekly', [InstalacionController::class, 'weeklyHomeOverview']);
Route::get('/generalviewmonth', [InstalacionController::class, 'monthHomeOverview']);
Route::get('/generalviewyear', [InstalacionController::class, 'yearHomeOverview']);

//Rutas mydevices
Route::get('/mydevices', [MachinesController::class, 'globalDevicesOverview']);
Route::get('/mydevicesdaily', [MachinesController::class, 'dailyDevicesOverview']);
Route::get('/mydevicesweekly', [MachinesController::class, 'weeklyDevicesOverview']);
Route::get('/mydevicesmontly', [MachinesController::class, 'monthlyDevicesOverview']);
Route::get('/mydevicesyearly', [MachinesController::class, 'yearlyDevicesOverview']);

Route::get('/unirseacomunidad', [BdController::class, 'unirseacomunidad']);
Route::get('/miscomunidades/{id}', [BdController::class, 'miscomunidades']);
Route::get('/misusuarios/{id}', [BdController::class, 'misusuarios']);
Route::get('/globalcoms', [BdController::class, 'totalPro']);
Route::delete('/eliminarusucom/{com}/{usu}', [BdController::class, 'abandonarCom']);
Route::post('/comunidad/guardar', [BdController::class, 'store']);
Route::get('/intermedio', [BdController::class, 'insertarTablaIntermedia']);


    });
});

Route::get('/miscomunidades/{id}', [BdController::class, 'miscomunidades']);
Route::get('/misusuarios/{id}', [BdController::class, 'misusuarios']);
Route::get('/unirseacomunidad', [BdController::class, 'unirseacomunidad']);
Route::get('/globalcoms', [BdController::class, 'totalPro']);
