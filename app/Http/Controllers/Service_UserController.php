<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use App\Models\ServicioUsuario;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Service_UserController extends Controller
{
  // Esta funcion ayuda a contratar un servicio
  // This functions allows the user to hire a service


  // API PROYECTO
  // ESTA FUNCION DEVUELVE TODOS LOS SERVICIOS A LOS QUE SE HA SUSCRITO UN USUARIO
  public function showUserServices($user_id){

    $services = [];
    $servusers = DB::table('servicio_usuario')->select()->where('usuario_id', $user_id)->get();

    foreach($servusers as $servuser){
      $service = Servicio::findOrFail($servuser->servicio_id);
      //dd($servuser->created_at);
      $service->created_at = $servuser->created_at;
      $service->updated_at = $servuser->updated_at;
      $services[] = $service;

    }
    if(empty($services)){
      return "This user is yet to purchase any service";
    }else{
      return $services;
    }

  }

  public function showUserService($serv_id, $user_id){

    $services = [];
    $servusers = DB::table('servicio_usuario')->select()->where('usuario_id', $user_id)->get();

    $prueba = new Servicio();

    foreach($servusers as $servuser){
      $service = Servicio::findOrFail($servuser->servicio_id);
      $service->created_at = $servuser->created_at;
      $service->updated_at = $servuser->updated_at;
      $services[] = $service;
      if($service->id == $serv_id){
        $prueba = $service;
      }

    }

    return $prueba;

  }

  
  public function hireService($user_id, $serv_id){
    
    $userTokens = Usuario::select('token')->where('id', "=" ,$user_id)->get();
    $servicePrice = Servicio::select('precio')->where('id', "=" ,$serv_id)->get();
    
        $userTokens = $userTokens[0]->token;
        $servicePrice = $servicePrice[0]->precio;
        
        
        // Se comprueba si el usuario tiene mas de 0 Tokens
        // We check that the user has more than 0 tokens
        
          if ($userTokens >= 0) {
            
            // Se comprueba que los tokens del usuario sean igual o mayor que el precio de los tokens del servicio
            // We check that the tokens of set user are equal or more than the price needed
            
            if ($userTokens >= $servicePrice) {
              
              // Se resta el precio del servicio
              // We substract the price of the service
              $subsctractedTokens = $userTokens - $servicePrice;
              
              Usuario::find($user_id)->update(['token'=>$subsctractedTokens]);
              
              $task = new ServicioUsuario();
              $task->servicio_id = $serv_id;
              $task->usuario_id = $user_id;
              $task->save();
             //dd("funciona");
            
            }else{
              return false;
            }
          }else{
            return false;
          }
        
     }

}
