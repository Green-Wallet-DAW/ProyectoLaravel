<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Machines;
use App\Models\Maquina;
use Illuminate\Support\Facades\DB;

class MachinesController extends Controller
{
    public function machineIndex(Request $request){
        $machines = Machines::all();

        return view('machines',['machines'=>$machines]);

    }
    public function addMachines(Request $request){
        $datos=request()->validate([
            'name'=>'required|max:25',
            'description'=>'required|max:100',
            ]
        );

        Machines::create($datos);
        return back();
    }
    public function deleteMachines(Request $request){
        $machine = Machines::findOrFail($request->id);
        $machine->delete();

    }

    public function editMachines($id){
        $machine = Machines::findOrFail($id);
        return view('editMachines', compact('machine'));
    }
    public function updateMachine(Request $request)
    {
        $validacion = $request->validate([
            'name' => 'required|min:1',
            'description' => 'required',
        ]);
        Machines::whereId($request->id)->update($validacion);
        return redirect()->route('machines');
    }

    //Mydevices methods
    public function globalDevicesOverview(Request $request, $id){
        //Esta funcion lista los dispositivos de una instalacion y sus valores generales
        $id = 3;
        $valores = [];


        $instalaciones = DB::table('instalaciones')
        ->select('id','facility_name','contractNumber','street_name')
        ->where('id_user', '=', $id)
        ->get();

        for ($i = 0; $i < count($instalaciones); $i++){

            $maquinas = DB::table('maquinas')
                ->select('id_instalation','type','components','fabricante','id','modelo')
                ->where('id_instalation', '=', $instalaciones[$i]->id)
                ->get();
            $energia_producida = 0;
            $carbono_ahorrado = 0;
            $tokens = 0;
            $valores_maquinas = [];


            for($y = 0; $y < count($maquinas); $y++){
                $datos = DB::table('datos_maquinas')
                ->select('id_maquina','energy_produced','carbono_ahorrado','tokens')
                ->where('id_maquina','=',$maquinas[$y]->id)
                ->get();

                for($z = 0; $z < count($datos); $z++){
                    $energia_producida += $datos[$z]->energy_produced;
                    $carbono_ahorrado += $datos[$z]->carbono_ahorrado;
                    $tokens += $datos[$z]->tokens;
                }

                array_push($valores_maquinas, array(//Se añade el array, para generarlo con ngFor en la vista
                    'id'=>$maquinas[$y]->id,//Doble ngFor -_-
                    'energy_produced'=>$energia_producida,
                    'carbono_ahorrado'=>$carbono_ahorrado,
                    'modelo'=>$maquinas[$y]->modelo,
                    'tokens'=>$tokens,

                ));
            }
            array_push($valores, array(//Se añade el array, para generarlo con ngFor en la vista
                 'faciliy_name'=>$instalaciones[$i]->facility_name,
            'contractNumber'=>$instalaciones[$i]->contractNumber,
            'street_name'=>$instalaciones[$i]->street_name,
                'maquinas'=>$valores_maquinas,
            ));
        }
        return $valores;
    }
    public function dailyDevicesOverview(Request $request, $id){
        //Esta funcion lista los dispositivos de una instalacion y sus valores DIARIOS
        $id = 3;
        $valores = [];

        $fecha = Carbon::now()->format('Y-m-d');//Fecha a actual año/mes/dia

        $instalaciones = DB::table('instalaciones')
        ->select('id','facility_name','contractNumber','street_name')
        ->where('id_user', '=', $id)
        ->get();

        for ($i = 0; $i < count($instalaciones); $i++){

            $maquinas = DB::table('maquinas')
                ->select('id_instalation','type','components','fabricante','id','modelo')
                ->where('id_instalation', '=', $instalaciones[$i]->id)
                ->get();
            $energia_producida = 0;
            $carbono_ahorrado = 0;
            $tokens = 0;
            $valores_maquinas = [];


            for($y = 0; $y < count($maquinas); $y++){
                $datos = DB::table('datos_maquinas')
                ->select('id_maquina','energy_produced','carbono_ahorrado','tokens')
                ->where('id_maquina','=',$maquinas[$y]->id)
                ->where('date','=', $fecha)
                ->get();

                for($z = 0; $z < count($datos); $z++){
                    $energia_producida += $datos[$z]->energy_produced;
                    $carbono_ahorrado += $datos[$z]->carbono_ahorrado;
                    $tokens += $datos[$z]->tokens;
                }

                array_push($valores_maquinas, array(//Se añade el array, para generarlo con ngFor en la vista
                    'id'=>$maquinas[$y]->id,//Doble ngFor -_-
                    'energy_produced'=>$energia_producida,
                    'carbono_ahorrado'=>$carbono_ahorrado,
                    'modelo'=>$maquinas[$y]->modelo,
                    'tokens'=>$tokens,

                ));
            }
            array_push($valores, array(//Se añade el array, para generarlo con ngFor en la vista
                 'faciliy_name'=>$instalaciones[$i]->facility_name,
            'contractNumber'=>$instalaciones[$i]->contractNumber,
            'street_name'=>$instalaciones[$i]->street_name,
                'maquinas'=>$valores_maquinas,
            ));

        }
        return $valores;
    }
    public function weeklyDevicesOverview(Request $request, $id){
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

    for ($i = 0; $i < count($instalaciones); $i++){

        $maquinas = DB::table('maquinas')
            ->select('id_instalation','type','components','fabricante','id','modelo')
            ->where('id_instalation', '=', $instalaciones[$i]->id)
            ->get();
        $energia_producida = 0;
        $carbono_ahorrado = 0;
        $tokens = 0;
        $valores_maquinas = [];


        for($y = 0; $y < count($maquinas); $y++){
            $datos = DB::table('datos_maquinas')
            ->select('id_maquina','energy_produced','carbono_ahorrado','tokens')
            ->where('id_maquina','=',$maquinas[$y]->id)
            ->whereBetween('date', [$start, $end])
            ->get();

            for($z = 0; $z < count($datos); $z++){
                $energia_producida += $datos[$z]->energy_produced;
                $carbono_ahorrado += $datos[$z]->carbono_ahorrado;
                $tokens += $datos[$z]->tokens;
            }

            array_push($valores_maquinas, array(//Se añade el array, para generarlo con ngFor en la vista
                'id'=>$maquinas[$y]->id,//Doble ngFor -_-
                'energy_produced'=>$energia_producida,
                'carbono_ahorrado'=>$carbono_ahorrado,
                'modelo'=>$maquinas[$y]->modelo,
                'tokens'=>$tokens,

            ));
        }
        array_push($valores, array(//Se añade el array, para generarlo con ngFor en la vista
             'faciliy_name'=>$instalaciones[$i]->facility_name,
        'contractNumber'=>$instalaciones[$i]->contractNumber,
        'street_name'=>$instalaciones[$i]->street_name,
            'maquinas'=>$valores_maquinas,
        ));

        }
    return $valores;
    }
    public function monthlyDevicesOverview(Request $request, $id){
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

    for ($i = 0; $i < count($instalaciones); $i++){

        $maquinas = DB::table('maquinas')
            ->select('id_instalation','type','components','fabricante','id','modelo')
            ->where('id_instalation', '=', $instalaciones[$i]->id)
            ->get();

        $energia_producida = 0;
        $carbono_ahorrado = 0;
        $tokens = 0;
        $valores_maquinas = [];


        for($y = 0; $y < count($maquinas); $y++){
            $datos = DB::table('datos_maquinas')
            ->select('id_maquina','energy_produced','carbono_ahorrado','tokens')
            ->where('id_maquina','=',$maquinas[$y]->id)
            ->whereMonth('date', $mes)
            ->whereYear('date', $año)
            ->get();

            for($z = 0; $z < count($datos); $z++){
                $energia_producida += $datos[$z]->energy_produced;
                $carbono_ahorrado += $datos[$z]->carbono_ahorrado;
                $tokens += $datos[$z]->tokens;
            }

            array_push($valores_maquinas, array(//Se añade el array, para generarlo con ngFor en la vista
                'id'=>$maquinas[$y]->id,//Doble ngFor -_-
                'energy_produced'=>$energia_producida,
                'carbono_ahorrado'=>$carbono_ahorrado,
                'modelo'=>$maquinas[$y]->modelo,
                'tokens'=>$tokens,

            ));
        }
        array_push($valores, array(//Se añade el array, para generarlo con ngFor en la vista
            'faciliy_name'=>$instalaciones[$i]->facility_name,
            'contractNumber'=>$instalaciones[$i]->contractNumber,
            'street_name'=>$instalaciones[$i]->street_name,
            'maquinas'=>$valores_maquinas,
        ));

        }
    return $valores;
    }
    public function yearlyDevicesOverview(Request $request, $id){
        //Esta funcion lista los dispositivos de una instalacion y sus valores ANUALES
    $id = 3;
    $valores = [];

    $fecha = Carbon::now();//Se extrae el año y mes actual
    $año = $fecha->format('Y');//Se extrae el año actual

    $instalaciones = DB::table('instalaciones')
    ->select('id','facility_name','contractNumber','street_name')
    ->where('id_user', '=', $id)
    ->get();

    for ($i = 0; $i < count($instalaciones); $i++){

        $maquinas = DB::table('maquinas')
            ->select('id_instalation','type','components','fabricante','id','modelo')
            ->where('id_instalation', '=', $instalaciones[$i]->id)
            ->get();

        $energia_producida = 0;
        $carbono_ahorrado = 0;
        $tokens = 0;
        $valores_maquinas = [];


        for($y = 0; $y < count($maquinas); $y++){
            $datos = DB::table('datos_maquinas')
            ->select('id_maquina','energy_produced','carbono_ahorrado','tokens')
            ->where('id_maquina','=',$maquinas[$y]->id)
            ->whereYear('date', $año)
            ->get();

            for($z = 0; $z < count($datos); $z++){
                $energia_producida += $datos[$z]->energy_produced;
                $carbono_ahorrado += $datos[$z]->carbono_ahorrado;
                $tokens += $datos[$z]->tokens;
            }

            array_push($valores_maquinas, array(//Se añade el array, para generarlo con ngFor en la vista
                'id'=>$maquinas[$y]->id,//Doble ngFor -_-
                'energy_produced'=>$energia_producida,
                'carbono_ahorrado'=>$carbono_ahorrado,
                'modelo'=>$maquinas[$y]->modelo,
                'tokens'=>$tokens,


            ));
        }
        array_push($valores, array(//Se añade el array, para generarlo con ngFor en la vista
        'faciliy_name'=>$instalaciones[$i]->facility_name,
        'contractNumber'=>$instalaciones[$i]->contractNumber,
        'street_name'=>$instalaciones[$i]->street_name,
        'maquinas'=>$valores_maquinas,
        ));

        }
    return $valores;
    }

    public function addmachine($id){
        $facilities = DB::table('instalaciones')
        ->select('facility_name','id')
        ->where('id_user', '=', $id)
        ->get();

        return $facilities;
    }

    public function storemachine(Request $request){

        //protected $fillable = ['number_machine', 'id_user','facility_name','street_name','contract_number'];
        $task = new Maquina();
        // $task->number_machine = $request->number_machine;
        // $task->id_user = $request->id_user;
        // $task->facility_name = $request->facility_name;
        // $task->street_name = $request->street;
        // $task->contract_number = $request->cnumber;

        $task->modelo = $request->modelo;
        $task->components = $request->components;
        $task->type = "solar";
        $task->fabricante = $request->fabricante;
        $task->id_instalation = $request->id_instalaton;
        $task->save();
    }
    public function deletemachine($id){
        $task = Maquina::destroy($id);
    }
}
