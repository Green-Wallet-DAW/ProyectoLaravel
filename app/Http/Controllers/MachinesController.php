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
        // $machines->Descripcion = $request->Descripcion;
        // $machines->save();
        // print_r($machines);
        // $machines->create($request->all());
        return back();
    }
}
