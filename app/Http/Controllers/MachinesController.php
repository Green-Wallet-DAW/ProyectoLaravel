<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
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
        $valores = [];
        $instalaciones = DB::table('instalaciones')
        ->select('id','facility_name','contractNumber','street_name')
        ->where('id_user', '=', $id)
        ->get();

        for($i = 0 ; $i < count($instalaciones) ; $i++){//Esto llama a las maquinas de las instalaciones
            $maquinas = DB::table('maquinas')
            ->select('id','energy_produced','carbono_ahorrado','tokens')
            ->where('id_instalation', '=', $instalaciones[$i]->id)
            ->get();


        array_push($valores, array(//Se añade el array, para generarlo con ngFor en la vista
            'faciliy_name'=>$instalaciones[$i]->facility_name,
            'contractNumber'=>$instalaciones[$i]->contractNumber,
            'street_name'=>$instalaciones[$i]->street_name,
            'maquinas'=>$maquinas,//Doble ngFor -_-
        ));

        }
        return $valores;
    }
    public function dailyDevicesOverview(Request $request){
        //Esta funcion lista los dispositivos de una instalacion y sus valores DIARIOS
        $id = 3;
        $valores = [];

        $fecha = Carbon::now()->format('Y-m-d');//Fecha a actual año/mes/dia

        $instalaciones = DB::table('instalaciones')
        ->select('id','facility_name','contractNumber','street_name')
        ->where('id_user', '=', $id)
        ->get();

        for($i = 0 ; $i < count($instalaciones) ; $i++){//Esto llama a las maquinas de las instalaciones
            $maquinas = DB::table('maquinas')
            ->select('id','energy_produced','carbono_ahorrado','tokens')
            ->where('id_instalation', '=', $instalaciones[$i]->id)
            ->where('date','=', $fecha)
            ->get();


        array_push($valores, array(//Se añade el array, para generarlo con ngFor en la vista
            'faciliy_name'=>$instalaciones[$i]->facility_name,
            'contractNumber'=>$instalaciones[$i]->contractNumber,
            'street_name'=>$instalaciones[$i]->street_name,
            'maquinas'=>$maquinas,//Doble ngFor -_-
        ));

        }
        return $valores;
    }
    public function weeklyDevicesOverview(Request $request){
         //Esta funcion lista los dispositivos de una instalacion y sus valores SEMANALMENTE
        $id = 3;
        $valores = [];

        $start = Carbon::now();
        $end = Carbon::now();
        $weekStart = $start->startOfWeek();
        $weekEnd = $end->endOfWeek();
        $weekStart = $weekStart->format('Y-m-d');
        $weekEnd = $weekEnd->format('Y-m-d');

        $instalaciones = DB::table('instalaciones')
    ->select('id','facility_name','contractNumber','street_name')
    ->where('id_user', '=', $id)
    ->get();

    for($i = 0 ; $i < count($instalaciones) ; $i++){//Esto llama a las maquinas de las instalaciones
        $maquinas = DB::table('maquinas')
        ->select('id','energy_produced','carbono_ahorrado','tokens','date')
        ->where('id_instalation', '=', $instalaciones[$i]->id)
        ->whereBetween('date', [$start, $end])
        ->get();


        array_push($valores, array(//Se añade el array, para generarlo con ngFor en la vista
        'faciliy_name'=>$instalaciones[$i]->facility_name,
        'contractNumber'=>$instalaciones[$i]->contractNumber,
        'street_name'=>$instalaciones[$i]->street_name,
        'maquinas'=>$maquinas,//Doble ngFor -_-
        ));

        }
    return $valores;
    }
    public function monthlyDevicesOverview(Request $request){
    //Esta funcion lista los dispositivos de una instalacion y sus valores MENSUALES
    $id = 3;
    $valores = [];

    $fecha = Carbon::now();//Se extrae el año y mes actual
    $año = $fecha->format('Y');
    $mes = $fecha->format('m');

    $instalaciones = DB::table('instalaciones')
    ->select('id','facility_name','contractNumber','street_name')
    ->where('id_user', '=', $id)
    ->get();

    for($i = 0 ; $i < count($instalaciones) ; $i++){//Esto llama a las maquinas de las instalaciones
        $maquinas = DB::table('maquinas')
        ->select('id','energy_produced','carbono_ahorrado','tokens')
        ->where('id_instalation', '=', $instalaciones[$i]->id)
        ->whereMonth('date', $mes)
        ->whereYear('date', $año)
        ->get();


        array_push($valores, array(//Se añade el array, para generarlo con ngFor en la vista
        'faciliy_name'=>$instalaciones[$i]->facility_name,
        'contractNumber'=>$instalaciones[$i]->contractNumber,
        'street_name'=>$instalaciones[$i]->street_name,
        'maquinas'=>$maquinas,//Doble ngFor -_-
        ));

        }
    return $valores;
    }
    public function yearlyDevicesOverview(Request $request){
        //Esta funcion lista los dispositivos de una instalacion y sus valores ANUALES
    $id = 3;
    $valores = [];

    $fecha = Carbon::now();//Se extrae el año y mes actual
    $año = $fecha->format('Y');//Se extrae el año actual

    $instalaciones = DB::table('instalaciones')
    ->select('id','facility_name','contractNumber','street_name')
    ->where('id_user', '=', $id)
    ->get();

    for($i = 0 ; $i < count($instalaciones) ; $i++){//Esto llama a las maquinas de las instalaciones
        $maquinas = DB::table('maquinas')
        ->select('id','energy_produced','carbono_ahorrado','tokens','date')
        ->where('id_instalation', '=', $instalaciones[$i]->id)
        ->whereYear('date', $año)
        ->get();


        array_push($valores, array(//Se añade el array, para generarlo con ngFor en la vista
        'faciliy_name'=>$instalaciones[$i]->facility_name,
        'contractNumber'=>$instalaciones[$i]->contractNumber,
        'street_name'=>$instalaciones[$i]->street_name,
        'maquinas'=>$maquinas,//Doble ngFor -_-
        ));

        }
    return $valores;
    }
}
