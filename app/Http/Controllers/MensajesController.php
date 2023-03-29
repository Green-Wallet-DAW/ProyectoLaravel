<?php

namespace App\Http\Controllers;
use App\Models\Mensaje;
use Illuminate\Http\Request;
use App\Notifications\SendNotification;

class MensajesController extends Controller
{
    public function pruebaTelegram(){
        $message = new Mensaje();
        $message->name = "Primer mensaje guardado";
        $message->content = "Este es el contenido del mensaje.\nSalto de línea.\n\nLínea en blanco encima";
        $message->notify(new SendNotification());
        return "Mensaje enviado";
    }
}
