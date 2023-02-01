<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Machines;

class MachinesController extends Controller
{
    public function machineIndex(Request $request){
        //Objeto con los nombres de las maquinas
        $machines = Machines::all();
        return view('machines',['machines'=>$machines]);

    }
    public function addMachines(Request $request){

       // dd($request);
        $datos=request()->validate([
            'Nombre'=>'required|max:25',
            'Descripcion'=>'required']
        );

        Machines::create($datos);
        // $machines = new Machines();
        // $machines->Nombre = $request->Nombre;
        // $machines->Descripcion = $request->Descripcion; //Otras formas menos "limpias" de manejar los datos
        // $machines->save();
        // print_r($machines);

        // $machines->create($request->all());
        return back();
    }
    public function deleteMachines(Request $request){
        $machine = Machines::findOrFail($request->id);
        $machine->delete();
        return back();
    }

    public function editMachines($id){
        $machine = Machines::findOrFail($id);
        return view('editMachines', compact('machine'));
    }
    public function updateMachine(Request $request)
    {
        $validacion = $request->validate([
            'Nombre' => 'required|min:1',
            'Descripcion' => 'required',
        ]);
        Machines::whereId($request->id)->update($validacion); //otra opción


        // //otra forma de almacenar
        //  $datos = Machines::findOrFail($id);   //podremos utilizar findOrFail($id) para que en caso de no encontrar no falle
        //  $datos->nombre = $validacion['nombre'];
        //  $datos->descripcion = $validacion['descripcion'];

        //  $datos->update();
     

        return redirect()->route('machines');
}
}
