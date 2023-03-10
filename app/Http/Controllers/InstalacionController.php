<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instalacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

use App\Models\Usuario;


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

     public function destroy($id)
    {
        $task = Instalacion::destroy($id);  //task tienen el id que se ha borrado

        return response()->json([
            "message" => "Tarea con id =" . $task . " ha sido borrado con éxito"
        ], 201);

    }
   //Funcion para la api
   public function instalaciontokens($id){

        $dinero = 0;
        $tokens = DB::table('instalaciones')
        ->select('tokens')
        ->where('id_user', '=', $id)
        ->get();

        for($i=0;$i<count($tokens);$i++){
            $dinero += $tokens[$i]->tokens;
        }

        $task = Usuario::findOrFail($id);


        $task->token = $dinero;

        $task->update();

    return $dinero;
   }
   public function globalHomeOverview(Request $request, $id){
    //Esta funcion muestra la produccion global
    //Este valor sera $requiest->id, con la id del usuario logeado
    // $id = 3;
    //  ->where('date','=', $fecha)
    $valores = [];

        $instalaciones = DB::table('instalaciones')
            ->select('id','facility_name','contractNumber','street_name')
            ->where('id_user', '=', $id)
            ->get();

            for ($i = 0; $i < count($instalaciones); $i++){

                $maquinas = DB::table('maquinas')
                    ->select('id_instalation','type','components','fabricante','id')
                    ->where('id_instalation', '=', $instalaciones[$i]->id)
                    ->get();
                $energia_producida = 0;
                $carbono_ahorrado = 0;
                $tokens = 0;

                for($y = 0; $y < count($maquinas); $y++){
                    $datos = DB::table('datos_maquinas')
                    ->select('energy_produced','carbono_ahorrado','tokens','id_maquina')
                    ->where('id_maquina','=',$maquinas[$y]->id)
                    ->get();

                    for($z = 0; $z < count($datos); $z++){
                        $energia_producida += $datos[$z]->energy_produced;
                        $carbono_ahorrado += $datos[$z]->carbono_ahorrado;
                        $tokens += $datos[$z]->tokens;
                    }
                }

                array_push($valores, array(//Se añade el array, para generarlo con ngFor en la vista
                    'id_instalation'=>$instalaciones[$i]->id,
                    'faciliy_name'=>$instalaciones[$i]->facility_name,
                    'energia_producida'=>$energia_producida,
                    'carbono_ahorrado'=>$carbono_ahorrado,
                    'contractNumber'=>$instalaciones[$i]->contractNumber,
                    'street_name'=>$instalaciones[$i]->street_name,
                    'tokens'=>$tokens,
                )
            );
        }

        return $valores;
    }

    public function dailyHomeOverview(Request $request, $id){
        //Esta funcion muestra la produccion del ultimo dia
        $valores = [];
        // $id = 3;

        $fecha = Carbon::now()->format('Y-m-d');//Fecha a actual año/mes/dia

        $instalaciones = DB::table('instalaciones')//Se almacenan las id de las instalaciones del usuario
            ->select('id','facility_name','contractNumber','street_name')
            ->where('id_user', '=', $id)
            ->get();

            for ($i = 0; $i < count($instalaciones); $i++){

                $maquinas = DB::table('maquinas')
                    ->select('id_instalation','type','components','fabricante','id')
                    ->where('id_instalation', '=', $instalaciones[$i]->id)
                    ->get();
                $energia_producida = 0;
                $carbono_ahorrado = 0;
                $tokens = 0;

                for($y = 0; $y < count($maquinas); $y++){
                    $datos = DB::table('datos_maquinas')
                    ->select('energy_produced','carbono_ahorrado','tokens','id_maquina')
                    ->where('id_maquina','=',$maquinas[$y]->id)
                    ->where('date','=', $fecha)
                    ->get();

                    for($z = 0; $z < count($datos); $z++){
                        $energia_producida += $datos[$z]->energy_produced;
                        $carbono_ahorrado += $datos[$z]->carbono_ahorrado;
                        $tokens += $datos[$z]->tokens;
                    }
                }

                array_push($valores, array(//Se añade el array, para generarlo con ngFor en la vista
                    'id_instalation'=>$instalaciones[$i]->id,
                    'faciliy_name'=>$instalaciones[$i]->facility_name,
                    'energia_producida'=>$energia_producida,
                    'carbono_ahorrado'=>$carbono_ahorrado,
                    'contractNumber'=>$instalaciones[$i]->contractNumber,
                    'street_name'=>$instalaciones[$i]->street_name,
                    'tokens'=>$tokens,
                )
            );
        }
        return $valores;
    }

    public function weeklyHomeOverview(Request $request, $id){
        //Esta funcion muestra la produccion del ultimo mes
       $valores = [];
        // $id = 3;

       $start = Carbon::now();
       $end = Carbon::now();
       $weekStart = $start->startOfWeek();
       $weekEnd = $end->endOfWeek();

       $instalaciones = DB::table('instalaciones')//Se almacenan las id de las instalaciones del usuario
           ->select('id','facility_name','contractNumber','street_name')
           ->where('id_user', '=', $id)
           ->get();

           for ($i = 0; $i < count($instalaciones); $i++){

            $maquinas = DB::table('maquinas')
                ->select('id_instalation','type','components','fabricante','id')
                ->where('id_instalation', '=', $instalaciones[$i]->id)
                ->get();
            $energia_producida = 0;
            $carbono_ahorrado = 0;
            $tokens = 0;

            for($y = 0; $y < count($maquinas); $y++){
                $datos = DB::table('datos_maquinas')
                ->select('energy_produced','carbono_ahorrado','tokens','id_maquina')
                ->where('id_maquina','=',$maquinas[$y]->id)
                ->whereBetween('date', [$start, $end])
                ->get();

                for($z = 0; $z < count($datos); $z++){
                    $energia_producida += $datos[$z]->energy_produced;
                    $carbono_ahorrado += $datos[$z]->carbono_ahorrado;
                    $tokens += $datos[$z]->tokens;
                }
            }

            array_push($valores, array(//Se añade el array, para generarlo con ngFor en la vista
                'id_instalation'=>$instalaciones[$i]->id,
                    'faciliy_name'=>$instalaciones[$i]->facility_name,
                'energia_producida'=>$energia_producida,
                'carbono_ahorrado'=>$carbono_ahorrado,
                'contractNumber'=>$instalaciones[$i]->contractNumber,
                'street_name'=>$instalaciones[$i]->street_name,
                'tokens'=>$tokens,
            )
        );
       }
       return $valores;
   }

    public function monthHomeOverview(Request $request, $id){
         //Esta funcion muestra la produccion del ultimo mes
        $valores = [];
         // $id = 3;
        $fecha = Carbon::now();//Se extrae el año y mes actual
        $año = $fecha->format('Y');
        $mes = $fecha->format('m');

        $instalaciones = DB::table('instalaciones')//Se almacenan las id de las instalaciones del usuario
            ->select('id','facility_name','contractNumber','street_name')
            ->where('id_user', '=', $id)
            ->get();

            for ($i = 0; $i < count($instalaciones); $i++){

                $maquinas = DB::table('maquinas')
                    ->select('id_instalation','type','components','fabricante','id')
                    ->where('id_instalation', '=', $instalaciones[$i]->id)
                    ->get();
                $energia_producida = 0;
                $carbono_ahorrado = 0;
                $tokens = 0;

                for($y = 0; $y < count($maquinas); $y++){
                    $datos = DB::table('datos_maquinas')
                    ->select('energy_produced','carbono_ahorrado','tokens','id_maquina')
                    ->where('id_maquina','=',$maquinas[$y]->id)
                    ->whereMonth('date', $mes)
                    ->whereYear('date', $año)
                    ->get();

                    for($z = 0; $z < count($datos); $z++){
                        $energia_producida += $datos[$z]->energy_produced;
                        $carbono_ahorrado += $datos[$z]->carbono_ahorrado;
                        $tokens += $datos[$z]->tokens;
                    }
                }

                array_push($valores, array(//Se añade el array, para generarlo con ngFor en la vista
                    'id_instalation'=>$instalaciones[$i]->id,
                    'faciliy_name'=>$instalaciones[$i]->facility_name,
                    'energia_producida'=>$energia_producida,
                    'carbono_ahorrado'=>$carbono_ahorrado,
                    'contractNumber'=>$instalaciones[$i]->contractNumber,
                    'street_name'=>$instalaciones[$i]->street_name,
                    'tokens'=>$tokens,
                )
            );
        }
        return $valores;
    }

    public function yearHomeOverview(Request $request, $id){
          //Esta funcion muestra la produccion del ultimo año
          $valores = [];
           // $id = 3;
          $fecha = Carbon::now();
          $año = $fecha->format('Y');//Se extrae el año actual

          $instalaciones = DB::table('instalaciones')//Se almacenan las id de las instalaciones del usuario
              ->select('id','facility_name','contractNumber','street_name')
              ->where('id_user', '=', $id)
              ->get();

              for ($i = 0; $i < count($instalaciones); $i++){

                $maquinas = DB::table('maquinas')
                    ->select('id_instalation','type','components','fabricante','id')
                    ->where('id_instalation', '=', $instalaciones[$i]->id)
                    ->get();
                $energia_producida = 0;
                $carbono_ahorrado = 0;
                $tokens = 0;

                for($y = 0; $y < count($maquinas); $y++){
                    $datos = DB::table('datos_maquinas')
                    ->select('energy_produced','carbono_ahorrado','tokens','id_maquina')
                    ->where('id_maquina','=',$maquinas[$y]->id)
                    ->whereYear('date', $año)
                    ->get();

                    for($z = 0; $z < count($datos); $z++){
                        $energia_producida += $datos[$z]->energy_produced;
                        $carbono_ahorrado += $datos[$z]->carbono_ahorrado;
                        $tokens += $datos[$z]->tokens;
                    }
                }

                array_push($valores, array(//Se añade el array, para generarlo con ngFor en la vista
                    'id_instalation'=>$instalaciones[$i]->id,
                    'faciliy_name'=>$instalaciones[$i]->facility_name,
                    'energia_producida'=>$energia_producida,
                    'carbono_ahorrado'=>$carbono_ahorrado,
                    'contractNumber'=>$instalaciones[$i]->contractNumber,
                    'street_name'=>$instalaciones[$i]->street_name,
                    'tokens'=>$tokens,
                )
            );
          }
          return $valores;
    }


    public function addfacility(Request $request){
        //protected $fillable = ['number_machine', 'id_user','facility_name','street_name','contractNumber'];

        $task = new Instalacion();
        $task->number_machine = $request->number_machine;
        $task->id_user = $request->user_id;
        $task->facility_name = $request->facility_name;
        $task->street_name = $request->street_name;
        $task->contractNumber = $request->contract_number;

        // $task->number_machine =1234;
        // $task->id_user = 3;
        // $task->facility_name = 'facility_prueba';
        // $task->street_name = 'street_name_prueba';
        // $task->contractNumber =4321;

        $task->save();
    }
}
