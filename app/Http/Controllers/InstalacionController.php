<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instalacion;
class InstalacionController extends Controller
{
    public function index(Request $request)
    {
        $task = Instalacion::all();
        return $task;
        //Esta función nos devolvera todas las tareas que tenemos en nuestra BD
    }

    public function store(Request $request)
    {
        $task = new Instalacion();
        $task->number_machine = $request->number_machine;
        $task->id_user = $request->id_user;

        $task->save();
        //Esta función guardará las tareas que enviaremos
        return response()->json([
            "message" => "Tarea almacenada con éxito"
        ], 201);
    }
    public function show(Request $request)
    {
        $task = Instalacion::findOrFail($request->id);
        return $task;
        //Esta función devolverá los datos de una tarea que hayamos seleccionado para cargar el formulario con sus datos
    }

    public function update(Request $request)
    {
        $task = Instalacion::findOrFail($request->id);

        $task->number_machine = $request->number_machine;
        $task->id_user = $request->id_user;

        $task->save();
       
        return $task;
        //Esta función actualizará la tarea que hayamos seleccionado
       
    }

     public function destroy(Request $request)
    {
        $task = Instalacion::destroy($request->id);  //task tienen el id que se ha borrado

        return response()->json([
            "message" => "Tarea con id =" . $task . " ha sido borrado con éxito"
        ], 201);
        //Esta función obtendra el id de la tarea que hayamos seleccionado y la borrará de nuestra BD
}
}
