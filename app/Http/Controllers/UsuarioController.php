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

    public function store(Request $request)
    {
        $task = new Usuario();
        $task->name = $request->name;
        $task->password = password_hash($request->password,PASSWORD_DEFAULT);
        $task->email = $request->email;
        $task->cumn = $request->cumn;
        $task->phone_number = $request->phone_number;
        $task->newsletter = $request->newsletter;

        $task->save();
        //Esta función guardará las tareas que enviaremos
        return response()->json([
            "message" => "Tarea almacenada con éxito"
        ], 201);
    }
    public function show(Request $request)
    {
        $task = Usuario::findOrFail($request->id);
        return $task;
        //Esta función devolverá los datos de una tarea que hayamos seleccionado para cargar el formulario con sus datos
    }

    public function update(Request $request)
    {
        $task = Usuario::findOrFail($request->id);

        $task->name = $request->name;
        $task->password = password_hash($request->password,PASSWORD_DEFAULT);
        $task->email = $request->email;
        $task->cumn = $request->cumn;
        $task->phone_number = $request->phone_number;
        $task->newsletter = $request->newsletter;

        $task->save();

        return $task;
        //Esta función actualizará la tarea que hayamos seleccionado

    }

     public function destroy(Request $request)
    {
        $task = Usuario::destroy($request->id);  //task tienen el id que se ha borrado

        return response()->json([
            "message" => "Tarea con id =" . $task . " ha sido borrado con éxito"
        ], 201);
        //Esta función obtendra el id de la tarea que hayamos seleccionado y la borrará de nuestra BD
    }


}
