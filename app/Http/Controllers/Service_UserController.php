<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use App\Models\Usuario;
use App\Models\UsuarioServicio;
use Illuminate\Http\Request;

class Service_UserController extends Controller
{
    // Esta funcion ayuda a contratar un servicio
    // This functions allows the user to hire a service

    public function hireService($user_id, $serv_id){
        
        // Variables que se van a usar
        // Variables that we're going to use
      $subsctractedTokens = 0;
        $newHiring = new UsuarioServicio();
      
        $userTokens = Usuario::select('token')->where('id', "=" ,$user_id)->get();
        $servicePrice = Servicio::select('precio')->where('id', "=" ,$serv_id)->get();
        
        $userTokens = $userTokens[0]->token;
        $servicePrice = $servicePrice[0]->precio;


        // Se comprueba si el usuario tiene mas de 0 Tokens
        // We check that the user has more than 0 tokens

      // if($this->checkHiring($user_id, $serv_id)== true){
         
      // }
      
         if ($userTokens > 0) {

           // Se comprueba que los tokens del usuario sean igual o mayor que el precio de los tokens del servicio
            // We check that the tokens of set user are equal or more than the price needed

         if ($userTokens >= $servicePrice) {

               // Se resta el precio del servicio
               // We substract the price of the service

            $subsctractedTokens = $userTokens - $servicePrice;

             Usuario::where('id', "=" ,$user_id)->update(['token'=>$subsctractedTokens]);

        // Se guarda las ids del usuario y del servicio
        //  We save the id of both user and service

        $newHiring->id_service = $serv_id;
        $newHiring->id_user = $user_id;
        $newHiring->save();
           }else{
                return false;
             }

         }else{
             return false;
        }
        
     }


     
     public function checkHiring($user_id, $serv_id){
      $checkHiring = UsuarioServicio::where("id_service", "=", $serv_id)->get();

      if($checkHiring->id_user != $user_id){
         // $this->hireService($user_id, $serv_id);
         return true;
      }else{
         return false;
      }

     }
     public function checkHiredServices($user_id){
      $checkHired = UsuarioServicio::where("id_user", '=', $user_id)->get('id_service');
      // dd($checkHired)->toArray();
      

         $id_serv = $checkHired[0]->id_service;
         // dd($id_serv);
         $findServices = Servicio::all()->where('id', '=', $id_serv);
         return $findServices;
      


      

     }
}
