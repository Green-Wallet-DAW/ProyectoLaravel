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

    public function hireService(Request $request){
        
        // Variables que se van a usar
        // Variables that we're going to use

        $newHiring = new UsuarioServicio();
        $userTokens = Usuario::findOrFail($request->token);
        $hiringUser = Usuario::findOrFail($request->id);
        $hiredService = Servicio::findOrFail($request->id);
        $servicePrice = Servicio::findOrFail($request->precio);

        // Se comprueba si el usuario tiene mas de 0 Tokens
        // We check that the user has more than 0 tokens

        if ($userTokens > 0) {

            // Se comprueba que los tokens del usuario sean igual o mayor que el precio de los tokens del servicio
            // We check that the tokens of set user are equal or more than the price needed

            if ($userTokens >= $servicePrice) {

                // Se resta el precio del servicio
                // We substract the price of the service

                $userTokens -= $servicePrice;

                // Se guarda las ids del usuario y del servicio
                // We save the id of both user and service

                $newHiring->id_service = $hiredService;
                $newHiring->id_user = $hiringUser;
                $newHiring->save();
            }

        }else{
            echo "NO";
        }

    }
}
