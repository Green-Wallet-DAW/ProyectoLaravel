<?php

namespace App\Http\Controllers;


use App\Models\ComunidadServicio;
use App\Models\Comunidad;
use App\Models\Servicio;


class Community_ServicesController extends Controller
{
    public function hireCommunityService($comm_id, $serv_id){
        
        // Variables que se van a usar
        // Variables that we're going to use
      $subsctractedTokens = 0;
        // $newHiring = new ComunidadServicio();
        $comm = Comunidad::find($comm_id);
        $serv = Servicio::find($serv_id);

        $communityTokens = Comunidad::select('token')->where('id', "=" ,$comm_id)->get();
        $servicePrice = Servicio::select('precio')->where('id', "=" ,$serv_id)->get();
        
        $communityTokens = $communityTokens[0]->token;
        $servicePrice = $servicePrice[0]->precio;


        // Se comprueba si el usuario tiene mas de 0 Tokens
        // We check that the user has more than 0 tokens

         if ($communityTokens > 0) {

           // Se comprueba que los tokens del usuario sean igual o mayor que el precio de los tokens del servicio
            // We check that the tokens of set user are equal or more than the price needed

         if ($communityTokens >= $servicePrice) {

               // Se resta el precio del servicio
               // We substract the price of the service

            $subsctractedTokens = $communityTokens - $servicePrice;

            Comunidad::where('id', "=" ,$comm_id)->update(['token'=>$subsctractedTokens]);

        // Se guarda las ids del usuario y del servicio
        //  We save the id of both user and service
          $serv->comunidades()->attach($comm);

           }else{
                echo "You don't have enough tokens";
             }

         }else{
             echo "You don't have enough tokens";
        }
        
     }


}
