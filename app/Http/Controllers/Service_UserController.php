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


      // $subsctractedTokens = 0;

        
        $usuario=Usuario::find($user_id);


        
        $servicio= Servicio::find($serv_id);




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

             Usuario::find($user_id)->update(['token'=>$subsctractedTokens]);

             $servicio->usuarios()->attach($usuario);

           }else{
                return false;
             }

         }else{
             return false;
        }
        
     }

}
