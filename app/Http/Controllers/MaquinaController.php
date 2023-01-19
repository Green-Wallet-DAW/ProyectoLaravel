<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maquina;
class MaquinaController extends Controller
{
    public function index(Request $request)
    {
        $task = Maquina::all();
        return $task;
        //Esta función nos devolvera todas las tareas que tenemos en nuestra BD
    }

    public function store(Request $request)
    {
        $task = new Maquina();
        $task->modelo = $request->modelo;
        $task->type = $request->type;
        $task->components = $request->components;
        $task->fabricante = $request->fabricante;
        $task->id_instalation = $request->id_instalation;

        $task->save();
        //Esta función guardará las tareas que enviaremos
        return response()->json([
            "message" => "Tarea almacenada con éxito"
        ], 201);
    }
    public function show(Request $request)
    {
        $task = Maquina::findOrFail($request->modelo);
        return $task;
        //Esta función devolverá los datos de una tarea que hayamos seleccionado para cargar el formulario con sus datos
    }

    public function update(Request $request)
    {
        $task = Maquina::findOrFail($request->modelo);

        $task->modelo = $request->modelo;
        $task->type = $request->type;
        $task->components = $request->components;
        $task->fabricante = $request->fabricante;
        $task->id_instalation = $request->id_instalation;

        $task->save();
       
        return $task;
        //Esta función actualizará la tarea que hayamos seleccionado
       
    }

     public function destroy(Request $request)
    {
        $task = Maquina::destroy($request->modelo);  //task tienen el id que se ha borrado

        return response()->json([
            "message" => "Tarea con id =" . $task . " ha sido borrado con éxito"
        ], 201);
        //Esta función obtendra el id de la tarea que hayamos seleccionado y la borrará de nuestra BD
}
}
