<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comunidad;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use App\Models\UsuarioComunidad;


class ComunidadController extends Controller
{
    public function index(Request $request)
    {
        $task = Comunidad::all();
        return $task;
        //Esta función nos devolvera todas las tareas que tenemos en nuestra BD
    }

    public function store(Request $request)
    {
        $task = new Comunidad();
        $task->name = $request->name;
        $task->description = $request->description;
        $task->master = $request->master;


        $task->save();
        //Esta función guardará las tareas que enviaremos
        return response()->json([
            "message" => "Tarea almacenada con éxito"
        ], 201);
    }

    public function showCom(Request $request)
    {
        $task = Comunidad::findOrFail($request->id);
        $user = Usuario::findOrFail($task->master);
        $task->master = $user->name;

        $idu = UsuarioComunidad::all()->where('id', $request->id);
        $array['com'] = $task;
        $i = 0;
        foreach($idu as $user){
            $prueba = Usuario::findOrFail($user->id_user);
            $array['user'][$i] = $prueba->name;
            $i++;
        }
        
        return view('showCom',['array'=>$array]); // Si no hay usuarios en la comunidad se valida en la vista

    }

    public function update(Request $request)
    {
        $task = Comunidad::findOrFail($request->id);

        $task->name = $request->name;
        $task->description = $request->description;
        $task->master = $request->master;

        $task->save();

        return $task;
        //Esta función actualizará la tarea que hayamos seleccionado

    }

    public function destroy(Request $request)
    {
        $task = Comunidad::destroy($request->id);  //task tienen el id que se ha borrado

        return response()->json([
            "message" => "Tarea con id =" . $task . " ha sido borrado con éxito"
        ], 201);
        //Esta función obtendra el id de la tarea que hayamos seleccionado y la borrará de nuestra BD
    }

    public function comunidadIndex()
    {

        $comunidades = Comunidad::all();
        foreach ($comunidades as $comunidad){
            $user = Usuario::findOrFail($comunidad->master);
            $comunidad->master = $user->name;
        }

        return view('comunidadIndex', ['comunidades' => $comunidades]);  //view('index',compact('datos');
    }

    public function almacenarAdmin(Request $request)
    {

        //LA MEJOR FORMA DE INSERTAR DATOS ya que se hace la comprobación de los campos obligatorios para que no hagan inyeccion y luego inserta.
        // dd($request->name);
        $request->validate(
            [
                'name' => 'required|max:50|unique:comunidades,name',
                'description' => 'required',
                'master' => 'required'
            ]
        );
        
        $user = DB::table('usuarios')->select('id')->where('name', $request->master)->get();
        // dd($request->token);
        if(isset($user[0])){
            $task = new Comunidad();
            $task->name = $request->name;
            if($request->token == null){
                $task->token = 0;
            }else{
                $task->token = $request->token;
            }
            $task->description = $request->description;
            $task->master = $user[0]->id;
            $task->save();

            return redirect()->route('comunidadIndex');
        }else{
            return redirect()->back();
        }

        
        //return back(); //te redirecciona a la misma página
    }
    
    public function editarAdmin($id)
    {

        $comunidad = Comunidad::findOrFail($id);
        $user = Usuario::findOrFail($comunidad->master);
        $comunidad->master = $user->name;
        return view('comunidadEditar', compact('comunidad'));
    }


    public function actualizarAdmin(Request $request)
    {
        $validacion = $request->validate([
            'name' => 'required|max:50',
            'description' => 'required',
            'master' => 'required'
        ]);

        $user = DB::table('usuarios')->select('id')->where('name', $validacion['master'])->get();

        if(isset($user[0])){
            $task = Comunidad::findOrFail($request->id);
            $task->name = $validacion['name'];
            $task->token = $validacion['token'];
            $task->description = $validacion['description'];
            $task->master = $user[0]->id;
            $task->update();

            $task2 = new UsuarioComunidad();
            $task2->id = $request->id;
            $task2->id_user = $task->master;

            $task3 = UsuarioComunidad::findOrFail($task2->id);
            $task3->id = $task2->id;
            $task3->id_user = $task2->id_user;
            $task3->save();

            return redirect()->route('comunidadIndex');
        }else{
            return redirect()->back();
        }

        // try{

        // }catch(\Illuminate\Database\QueryException $ex){
        //     return $errors;
        // }
        
        // Comunidad::whereId($request->id)->update($task); //otra opción

        /*  //otra forma de almacenar
         $datos = Dato::find($id);   //podremos utilizar findOrFail($id) para que en caso de no encontrar no falle
         $datos->nombre = $validacion['nombre'];
         $datos->descripcion = $validacion['descripcion'];
         $datos->update();*/

    }

    // formar de recuperar datos de un formulario. $request->get('nombre'); $request->nombre;  $request->input('nombre');

    public function borrarAdmin($id)
    {

        $comunidad = Comunidad::findOrFail($id);
        $comunidad->delete();
        return redirect()->route('comunidadIndex');
    }
}
