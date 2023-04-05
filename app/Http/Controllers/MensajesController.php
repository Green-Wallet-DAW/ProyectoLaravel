<?php

namespace App\Http\Controllers;
use App\Models\Mensaje;
use Illuminate\Http\Request;
use App\Notifications\SendNotification;

class MensajesController extends Controller
{
    public function pruebaTelegram(){
        $message = new Mensaje();
        $message->name = "Mensaje de prueba";
        $message->content = "Este es el contenido del mensaje.\nSalto de línea.\n\nLínea en blanco encima.\n\nFin del mensaje.";
        $message->notify(new SendNotification());
        return "Mensaje enviado";
    }

    public function indexTelegram()
    {
        $telegram = Mensaje::all();
        return view('telegram',['telegram'=>$telegram]);
    }

    public function sendTelegram(Request $request){
        $message = Mensaje::findOrFail($request->id);
        $toSend = new Mensaje();
        $toSend->name = "";
        $toSend->content = $message->content;
        $toSend->notify(new SendNotification());
        return redirect()->route('telegram');

    }

    public function saveTelegram(Request $request){
        $message = new Mensaje();
        $message->name = $request->name;
        $message->content = $request->content;
        $message->save();
        return redirect()->route('telegram');
    }

    public function saveSendTelegram(Request $request){
        $message = new Mensaje();
        $message->name = $request->name;
        $message->content = $request->content;
        $message->save();
        $toSend = new Mensaje();
        $toSend->name = "";
        $toSend->content = $message->content;
        $toSend->notify(new SendNotification());
        return redirect()->route('telegram');
    }

    public function deleteTelegram(Request $request){
        $telegram = Mensaje::findOrFail($request->id);
        $telegram->delete();

        return redirect()->route('telegram');
    }

    public function editTelegram($id){
        $telegram = $telegram = Mensaje::findOrFail($id);
        return view('editTelegram',['telegram'=>$telegram]);
    }
}
