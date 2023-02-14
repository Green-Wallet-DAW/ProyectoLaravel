<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instalacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
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
     //Esta funcion muestra la produccion global
    $id = 3;//Este valor sera $requiest->id, con la id del usuario logeado

    // //Esto funciona para 1
    // $id_facility = DB::table('instalaciones')->where('id_user', $id)->value('id');//Selecciona las instalaciones por la id del user
    //Esto funciona para 1
    // $id_users = DB::table('instalaciones')->pluck('id_user');
    // foreach ($id_users as $instalacion_id) {
    //     if($instalacion_id == $id){
    //         array_push($valores,$instalacion_id );
    //     }
    // }
    //Esto funciona para 1
    // DB::table('maquinas')->orderBy('id_instalation')->lazy()->each(function ($maquinas) {
    //     $valores = [];
    //     if(($maquinas->id_instalation)==3){
    //         $modelo =  $maquinas->modelo;
    //         array_push($valores, $modelo);
    //     }
    // });

    //Funciona para varias


    // $instalaciones = DB::table('instalaciones')
    //     ->where('id_user', '=', $id)
    //     ->select('id')
    //     ->get();
    // $maquinas = DB::table('maquinas')//Estas son las maquinas de las instalaciones
    //     ->where('id_instalation', '=', $id)
    //     ->get();

    // //Esto funciona
    // $maquinas = DB::table('maquinas')
    //     ->select('carbono_ahorrado','energy_produced')
    //     ->whereExists(function ($query) {
    //         $query->select()
    //             ->from('instalaciones')
    //             ->where('instalaciones.id', '3');
    //     })
    // ->get();


        $valores = [];

        $instalaciones = DB::table('instalaciones')
            ->select('id','facility_name','contractNumber','street_name')
            ->where('id_user', '=', $id)
            ->get();

            for ($i = 0; $i < count($instalaciones); $i++){

                $maquinas = DB::table('maquinas')
                    ->select('id_instalation','energy_produced','carbono_ahorrado','tokens')
                    ->where('id_instalation', '=', $instalaciones[$i]->id)
                    ->get();
                $energia_producida = 0;
                $carbono_ahorrado = 0;
                $tokens = 0;

                for($y = 0 ; $y < count($maquinas); $y++){//Esto se puede hacer con un SUM en la base de datos  son 2700 valores

                    $energia_producida += $maquinas[$y]->energy_produced;
                    $carbono_ahorrado += $maquinas[$y]->carbono_ahorrado;
                    $tokens += $maquinas[$y]->tokens;
                }
                array_push($valores, array(//Se añade el array, para generarlo con ngFor en la vista
                    'faciliy_name'=>$instalaciones[$i]->facility_name,
                    'energia_producida'=>$energia_producida,
                    'carbono_ahorrado'=>$carbono_ahorrado,
                    'contractNumber'=>$instalaciones[$i]->contractNumber,
                    'street_name'=>$instalaciones[$i]->street_name,
                    'tokens'=>$tokens,
            ));

        }
        return $valores;
    }

    public function dailyHomeOverview(){
        //Esta funcion muestra la produccion del ultimo dia
        $valores = [];
        $id = 3;

        $fecha = Carbon::now()->format('Y-m-d');//Fecha a actual año/mes/dia

        $instalaciones = DB::table('instalaciones')//Se almacenan las id de las instalaciones del usuario
            ->select('id','facility_name','contractNumber','street_name')
            ->where('id_user', '=', $id)
            ->get();

            for ($i = 0; $i < count($instalaciones); $i++){//Se recorre la id/s y se llama a las maquinas de la id

                $maquinas = DB::table('maquinas')
                ->select('id','id_instalation','energy_produced','carbono_ahorrado','tokens','date',)
                    ->where('id_instalation', '=', $instalaciones[$i]->id)
                    ->where('date','=', $fecha)
                    ->get();

                $energia_producida = 0;
                $carbono_ahorrado = 0;
                $tokens = 0;

                for($y = 0 ; $y < count($maquinas); $y++){//Esto se puede hacer con un SUM en la base de datos  son 2700 valores
                    $energia_producida += $maquinas[$y]->energy_produced;
                    $carbono_ahorrado += $maquinas[$y]->carbono_ahorrado;
                    $tokens += $maquinas[$y]->tokens;
                }

                array_push($valores, array(//Se añade el array, para generarlo con ngFor en la vista
                    'faciliy_name'=>$instalaciones[$i]->facility_name,
                    'energia_producida'=>$energia_producida,
                    'carbono_ahorrado'=>$carbono_ahorrado,
                    'contractNumber'=>$instalaciones[$i]->contractNumber,
                    'street_name'=>$instalaciones[$i]->street_name,
                    'tokens'=>$tokens,
                ));
        }
        return $valores;
    }
    public function monthHomeOverview(){
         //Esta funcion muestra la produccion del ultimo mes
        $valores = [];
        $id = 3;
        $fecha = Carbon::now();//Se extrae el año y mes actual
        $año = $fecha->format('Y');
        $mes = $fecha->format('m');

        $instalaciones = DB::table('instalaciones')//Se almacenan las id de las instalaciones del usuario
            ->select('id','facility_name','contractNumber','street_name')
            ->where('id_user', '=', $id)
            ->get();

            for ($i = 0; $i < count($instalaciones); $i++){//Se recorre la id/s y se llama a las maquinas de la id

                $maquinas = DB::table('maquinas')
                ->select('id','id_instalation','energy_produced','carbono_ahorrado','tokens','date',)
                    ->where('id_instalation', '=', $instalaciones[$i]->id)
                    ->whereMonth('date', $mes)
                    ->whereYear('date', $año)
                    ->get();


                $energia_producida = 0;
                $carbono_ahorrado = 0;
                $tokens = 0;

                for($y = 0 ; $y < count($maquinas); $y++){//Esto se puede hacer con un SUM en la base de datos  son 2700 valores
                $energia_producida += $maquinas[$y]->energy_produced;
                $carbono_ahorrado += $maquinas[$y]->carbono_ahorrado;
                $tokens += $maquinas[$y]->tokens;
                }


                array_push($valores, array(//Se añade el array, para generarlo con ngFor en la vista
                    'faciliy_name'=>$instalaciones[$i]->facility_name,
                    'energia_producida'=>$energia_producida,
                    'carbono_ahorrado'=>$carbono_ahorrado,
                    'contractNumber'=>$instalaciones[$i]->contractNumber,
                    'street_name'=>$instalaciones[$i]->street_name,
                    'tokens'=>$tokens,
                ));
        }
        return $valores;
    }

    public function yearHomeOverview(){
          //Esta funcion muestra la produccion del ultimo año
          $valores = [];
          $id = 3;
          $fecha = Carbon::now();
          $año = $fecha->format('Y');//Se extrae el año actual

          $instalaciones = DB::table('instalaciones')//Se almacenan las id de las instalaciones del usuario
              ->select('id','facility_name','contractNumber','street_name')
              ->where('id_user', '=', $id)
              ->get();

              for ($i = 0; $i < count($instalaciones); $i++){//Se recorre la id/s y se llama a las maquinas de la id

                  $maquinas = DB::table('maquinas')
                  ->select('id','id_instalation','energy_produced','carbono_ahorrado','tokens','date',)
                      ->where('id_instalation', '=', $instalaciones[$i]->id)
                      ->whereYear('date', $año)
                      ->get();


                  $energia_producida = 0;
                  $carbono_ahorrado = 0;
                  $tokens = 0;

                  for($y = 0 ; $y < count($maquinas); $y++){//Esto se puede hacer con un SUM en la base de datos  son 2700 valores
                  $energia_producida += $maquinas[$y]->energy_produced;
                  $carbono_ahorrado += $maquinas[$y]->carbono_ahorrado;
                  $tokens += $maquinas[$y]->tokens;
                  }


                  array_push($valores, array(//Se añade el array, para generarlo con ngFor en la vista
                      'faciliy_name'=>$instalaciones[$i]->facility_name,
                      'energia_producida'=>$energia_producida,
                      'carbono_ahorrado'=>$carbono_ahorrado,
                      'contractNumber'=>$instalaciones[$i]->contractNumber,
                      'street_name'=>$instalaciones[$i]->street_name,
                      'tokens'=>$tokens,
                  ));
          }
          return $valores;
    }
}
