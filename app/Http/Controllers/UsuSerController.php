<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsuarioServicio;
class UsuSerController extends Controller
{
    public function index(Request $request)
    {
        $task = UsuarioServicio::all();
        return $task;
        //Esta función nos devolvera todas las tareas que tenemos en nuestra BD
    }

    public function store(Request $request)
    {
        $task = new UsuarioServicio();
        $task->id_service = $request->id_service;
        $task->id_user = $request->id_user;

        $task->save();
        //Esta función guardará las tareas que enviaremos
        return response()->json([
            "message" => "Tarea almacenada con éxito"
        ], 201);
    }
    public function show(Request $request)
    {
        $task = UsuarioServicio::findOrFail($request->id_user);
        return $task;
        //Esta función devolverá los datos de una tarea que hayamos seleccionado para cargar el formulario con sus datos
    }

    public function update(Request $request)
    {
        $task = UsuarioServicio::findOrFail($request->id_user);

        $task->id_service = $request->id_service;
        $task->id_user = $request->id_user;

        $task->save();
       
        return $task;
        //Esta función actualizará la tarea que hayamos seleccionado
       
    }

     public function destroy(Request $request)
    {
        $task = UsuarioServicio::destroy($request->id_user);  //task tienen el id que se ha borrado

        return response()->json([
            "message" => "Tarea con id =" . $task . " ha sido borrado con éxito"
        ], 201);
        //Esta función obtendra el id de la tarea que hayamos seleccionado y la borrará de nuestra BD
}
}
