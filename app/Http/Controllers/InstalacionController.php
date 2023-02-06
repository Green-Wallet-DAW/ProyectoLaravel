<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instalacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
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
   //Funcion para la api
   public function globalHomeOverview(Request $request){
    $id = 3;//Este valor sera $requiest->id, con la id del usuario logeado

    // //Esto funciona para 1
    // $id_facility = DB::table('instalaciones')->where('id_user', $id)->value('id');//Selecciona las instalaciones por la id del user
    //Esto funciona para 1
    // $id_users = DB::table('instalaciones')->pluck('id_user');
    // foreach ($id_users as $instalacion_id) {
    //     if($instalacion_id == $id){
    //         array_push($caja,$instalacion_id );
    //     }
    // }
    //Esto funciona para 1
    // DB::table('maquinas')->orderBy('id_instalation')->lazy()->each(function ($maquinas) {
    //     $caja = [];
    //     if(($maquinas->id_instalation)==3){
    //         $modelo =  $maquinas->modelo;
    //         array_push($caja, $modelo);
    //     }
    // });

    //Funciona para varias
        $caja = [];

    // $instalaciones = DB::table('instalaciones')
    //     ->where('id_user', '=', $id)
    //     ->select('id')
    //     ->get();
    // $maquinas = DB::table('maquinas')//Estas son las maquinas de las instalaciones
    //     ->where('id_instalation', '=', $id)
    //     ->get();

    //Esto funciona
    // $maquinas = DB::table('maquinas')
    //     ->select('carbono_ahorrado','energy_produced')
    //     ->whereExists(function ($query) {
    //         $query->select()
    //             ->from('instalaciones')
    //             ->whereColumn('instalaciones.id', 'maquinas.id_instalation');
    //     })

    // ->get();

        $valores = DB::table('maquinas')
        ->sum('energy_produced')
        ->where('id_instalation',3)
        ->get();


        dd($valores);
        return $valores;
    }
}
