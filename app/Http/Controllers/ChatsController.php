<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use App\Models\Chat;
use App\Models\Usuario;
use Validator;

class ChatsController extends Controller
{

    public $successStatus = 200;

    public function getMessages(){

        $record = '';
        $chatsCif = array();
        $id = auth()->user()->id;
        $chats = Chat::where('sender', $id)->orWhere('receiver', $id)->get();
        
        foreach($chats as $chat){
            if($chat->sender != $id){
                $task = Usuario::findOrFail($chat->sender);
                $record = $task->name;
            }else if($chat->receiver != $id){
                $task = Usuario::findOrFail($chat->receiver);
                $record = $task->name;
            }
            $chat['record'] = $record;
            $chatsCif[$record][] = $chat;
        }
        //dd($chatsCif);
        return view('chats',['chats'=>$chatsCif]);
    }

    public function sendMessage(Request $request){

        //dd($request);

        $id = auth()->user()->id;
        $chat = new Chat();
        $chat->tipo = $request->tipo;
        $chat->sender = $id;
        $chat->receiver = $request->receiver;
        $chat->message = $request->message;
        $chat->save();
        return redirect()->route('chats');
    }

    public function sendMessageU(Request $request){

        $id = auth()->user()->id;
        $validator = Validator::make($request->all(), [
            'tipo'=>'required',
            'message'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $message = new Chat();
        $message->tipo = $request->tipo;
        $message->sender = $id;
        $message->receiver = 1;
        $message->message = $request->message;

        $message->save();

        return response()->json([
            "message" => "Tarea almacenada con éxito"
        ], 201);
    }

    public function getMessagesU(){


        $id = auth()->user()->id;
        $chats = Chat::where('sender', $id)->orWhere('receiver', $id)->get();
        
        return $chats;
    }
}
