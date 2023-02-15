<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Maquina;
use App\Models\Instalacion;
use App\Models\Comunidad;
use App\Models\Servicio;
use App\Models\UsuarioComunidad;

class BdController extends Controller
{
    public function unirseacomunidad(){
       $sql='SELECT comunidades.id, comunidades.name, comunidades.description as descripcion, IFNULL(concat(sum(maquinas.energy_produced)," KWh" ),concat(0," KWh"))as energy_produced,count(usuarios_comunidades.id_user) as members FROM `usuarios_comunidades`
       right join comunidades on usuarios_comunidades.id_comunity=comunidades.id
       left join usuarios on usuarios.id=usuarios_comunidades.id_user
      left join instalaciones on instalaciones.id_user=usuarios.id
      left join maquinas on maquinas.id_instalation=instalaciones.id
       group by comunidades.id;';
       $comunidades=DB::select($sql);
    return $comunidades;

      // $unirse1= Comunidad::select('id','name','description')
      // ->groupBy('id')
      // ->get();
      // $unirse2= Comunidad::join('usuarios_comunidades','comunidades.id','=','usuarios_comunidades.id_comunity')
      // ->join('usuarios','usuarios.id','=','usuarios_comunidades.id_user')
      // ->join('instalaciones','usuarios.id','=','instalaciones.id_user')
      // ->join('maquinas','instalaciones.id','=','maquinas.id_instalation')
      // ->select(DB::raw('comunidades.id,comunidades.name,comunidades.description,sum(maquinas.energy_produced) as energy_produced, count(usuarios_comunidades.id_user) as members'))
      // ->groupBy('comunidades.id')
      // ->get();
      //https://www.w3schools.com/sql/func_mysql_if.asp
      // return $unirse2;
    }
    public function miscomunidades(){
     $sql='SELECT comunidades.id, comunidades.name, comunidades.token, comunidades.description, IFNULL(concat(sum(maquinas.carbono_ahorrado)," KWh" ),concat(0," KWh"))as carbono_ahorrado, IFNULL(concat(sum(maquinas.energy_produced)," KWh" ),concat(0," KWh"))as energy_produced FROM `usuarios_comunidades`
        right join comunidades on usuarios_comunidades.id_comunity=comunidades.id
        left join usuarios on usuarios.id=usuarios_comunidades.id_user
        left join instalaciones on instalaciones.id_user=usuarios.id
        left join maquinas on maquinas.id_instalation=instalaciones.id
      --   where usuarios.id=8
        group by comunidades.id';
        $comunidades=DB::select($sql);
     return $comunidades;
    }
    public function misusuarios(){
      
      $sql="SELECT usuarios.name as members, sum(maquinas.energy_produced)as energy_produced, sum(maquinas.carbono_ahorrado)as carbono_ahorrado FROM `usuarios` inner join instalaciones on instalaciones.id_user=usuarios.id inner join maquinas on maquinas.id_instalation=instalaciones.id inner join usuarios_comunidades on usuarios_comunidades.id_user=usuarios.id where usuarios_comunidades.id_comunity=10 group by usuarios.name";
      $comunidades=DB::select($sql);
      return $comunidades;
   //   SELECT usuarios.name as members, sum(maquinas.energy_produced)as energy_produced, sum(maquinas.carbono_ahorrado)as carbono_ahorrado FROM `usuarios` inner join instalaciones on instalaciones.id_user=usuarios.id inner join maquinas on maquinas.id_instalation=instalaciones.id group by maquinas.id_instalation;
     }
     public function totalPro(){
      
         $sql='SELECT usuarios.id, usuarios.name as member, IFNULL(concat(sum(maquinas.energy_produced)," KWh" ),concat(0," KWh")) as Total_Production, IFNULL(concat(sum(maquinas.carbono_ahorrado)," KWh" ),concat(0," KWh"))as Total_carbon_saved FROM `usuarios`
         inner join instalaciones on usuarios.id=instalaciones.id_user
         inner join maquinas on instalaciones.id=maquinas.id_instalation
         group by id
         order by sum(maquinas.energy_produced) desc, sum(maquinas.carbono_ahorrado) desc
         limit 10';
         $comunidades=DB::select($sql);
         return $comunidades;
      
        }

      public function insertarTablaIntermedia(){
          $user=Usuario::find(1);
          $comunity = Comunidad::find(2); 
          // $comunity = Comunidad::orderBy('id_comunity', 'desc')->first();
          $comunity->usuarios()->attach($user);
          // https://es.stackoverflow.com/questions/197051/como-insertar-una-tabla-intermedia-en-laravel
         }
      public function insertarTablaIntermedia2(Request $request)
         {
             $task = new UsuarioComunidad();
             $task->id_comunity = $request->id_comunity;
             $task->id_user = $request->id_user;
     
             $task->save();
             //Esta función guardará las tareas que enviaremos
             return response()->json([
                 "message" => "Tarea almacenada con éxito"
             ], 201);
         }



}
