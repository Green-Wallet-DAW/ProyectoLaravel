<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comunidad;

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
    public function show(Request $request)
    {
        $task = Comunidad::findOrFail($request->id);
        return $task;
        //Esta función devolverá los datos de una tarea que hayamos seleccionado para cargar el formulario con sus datos
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

    public function indexAdmin()
    {

        $comunidades = Comunidad::all();

        return view('comunidadIndex', ['comunidades' => $comunidades]);  //view('index',compact('datos');
    }

    public function almacenarAdmin(Request $request)
    {

        //LA MEJOR FORMA DE INSERTAR DATOS ya que se hace la comprobación de los campos obligatorios para que no hagan inyeccion y luego inserta.
        $comunidades = request()->validate(
            [
                'name' => 'required|max:25',
                'token' => 'required',
                'description' => 'required',
                'master' => 'required'
            ]
        );

        Comunidad::create($comunidades);

        return redirect()->route('comunidadIndex');
        //return back(); //te redirecciona a la misma página
    }
    public function editarAdmin($id)
    {

        $comunidad = Comunidad::findOrFail($id);  //como no está el dato si nos equivocamos de id nos muestra la página de error 404, podemos crear uno personalizado en la view->errors->404.blade.php , creamos carpeta "errors"
        return view('comunidadEditar', compact('comunidad'));
    }


    public function actualizarAdmin(Request $request)
    {
        $validacion = $request->validate([
            'name' => 'required|max:25',
            'token' => 'required',
            'description' => 'required',
            'master' => 'required'
        ]);

        Comunidad::whereId($request->id)->update($validacion); //otra opción

        /*  //otra forma de almacenar
         $datos = Dato::find($id);   //podremos utilizar findOrFail($id) para que en caso de no encontrar no falle
         $datos->nombre = $validacion['nombre'];
         $datos->descripcion = $validacion['descripcion'];
         $datos->update();*/

        return redirect()->route('comunidadIndex');
    }

    // formar de recuperar datos de un formulario. $request->get('nombre'); $request->nombre;  $request->input('nombre');

    public function borrarAdmin($id)
    {

        $comunidad = Comunidad::findOrFail($id);
        $comunidad->delete();
        return redirect()->route('comunidadIndex');
    }
}
