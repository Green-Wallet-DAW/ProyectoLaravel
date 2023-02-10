<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Machines;
use Illuminate\Support\Facades\DB;

class MachinesController extends Controller
{
    public function machineIndex(Request $request){
        $machines = Machines::all();
        return view('machines',['machines'=>$machines]);

    }
    public function addMachines(Request $request){
        $datos=request()->validate([
            'Nombre'=>'required|max:25',
            'Descripcion'=>'required']
        );

        Machines::create($datos);
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
        Machines::whereId($request->id)->update($validacion);
        return redirect()->route('machines');
    }

    //Mydevices methods
    public function globalDevicesOverview(Request $request){
        //Esta funcion lista los dispositivos de una instalacion y sus valores generales
        $id = 3;

        $instalaciones = DB::table('instalaciones')
        ->where('id_user', '=', $id)
        ->get();

        for($i = 0 ; $i < count($instalaciones) ; $i++){
            $maquinas = DB::table('maquinas')
            ->get();
        }

    }

}
