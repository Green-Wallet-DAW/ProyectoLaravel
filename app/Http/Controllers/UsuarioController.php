<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function indexUsers(Request $request)
    {
        $usuarios = Usuario::all();
        return view('usuarios',['usuarios'=>$usuarios]);
        //Esta función nos devolvera todas las tareas que tenemos en nuestra BD
    }

    public function addUser(Request $request)
    {

        $request->validate([
            'name'=>'required|max:40|min:5',
            'password'=>'required|max:255|min:10',
            'email'=>'required|max:100',
            'phone_number'=>'required'
        ]);

        $task = new Usuario();
        $task->name = $request->name;
        $task->password = password_hash($request->password,PASSWORD_DEFAULT);
        $task->email = $request->email;
        $task->cumn = $request->cumn;
        $task->phone_number = $request->phone_number;
        $task->rol = $request->role;
        if($request->has('news')){
            $task->newsletter = 1;
        }else{
            $task->newsletter = 0;
        };

        $task->save();
        return redirect()->route('usuarios');
    }
    public function showUser(Request $request)
    {
        $task = Usuario::findOrFail($request->id);
        return view('showUser',['task'=>$task]);
        //Esta función devolverá los datos de una tarea que hayamos seleccionado para cargar el formulario con sus datos
    }

    public function editUser($id)
    {
        $task = $task = Usuario::findOrFail($id);
        return view('editUser',['task'=>$task]);
    }

    public function updateUser(Request $request)
    {

        $request->validate([
            'name'=>'required|max:40|min:5',
            'email'=>'required|max:100',
            'phone_number'=>'required'
        ]);

        $task = Usuario::findOrFail($request->id);

        $task->name = $request->name;
        $task->email = $request->email;
        $task->cumn = $request->cumn;
        $task->phone_number = $request->phone_number;
        $task->rol = $request->role;
        if($request->has('news')){
            $task->newsletter = 1;
        }else{
            $task->newsletter = 0;
        };
        $task->update();
       
        return redirect()->route('usuarios');
        //Esta función actualizará la tarea que hayamos seleccionado
       
    }

     public function deleteUser(Request $request)
    {
        $task = Usuario::findOrFail($request->id);
        $task->delete(); 

        return redirect()->route('usuarios');
}
}
