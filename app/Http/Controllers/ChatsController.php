<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use App\Models\Chat;
use App\Models\Usuario;

class ChatsController extends Controller
{
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
}
