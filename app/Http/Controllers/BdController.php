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
use Faker\Core\Number;
use Ramsey\Uuid\Type\Integer;

class BdController extends Controller
{
    public function unirseacomunidad(){
       $sql='SELECT comunidades.id, comunidades.name, comunidades.description as descripcion, IFNULL(concat(sum(maquinas.energy_produced)," KWh" ),concat(0," KWh"))as energy_produced,count(comunidad_usuario.usuario_id) as members FROM `comunidad_usuario`
       right join comunidades on comunidad_usuario.comunidad_id=comunidades.id
       left join usuarios on usuarios.id=comunidad_usuario.usuario_id
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
    public function miscomunidades($request){
     $sql="SELECT comunidades.id, comunidades.name, comunidades.token, comunidades.description, IFNULL(concat(sum(maquinas.carbono_ahorrado),' KWh' ),concat(0,' KWh'))as carbono_ahorrado, IFNULL(concat(sum(maquinas.energy_produced),' KWh' ),concat(0,'KWh'))as energy_produced FROM `comunidad_usuario`
        right join comunidades on comunidad_usuario.comunidad_id=comunidades.id
        left join usuarios on usuarios.id=comunidad_usuario.usuario_id
        left join instalaciones on instalaciones.id_user=usuarios.id
        left join maquinas on maquinas.id_instalation=instalaciones.id
      where usuarios.id=$request
        group by comunidades.id";
        $comunidades=DB::select($sql);
     return $comunidades;
    }
    public function misusuarios($request){
     
      $sql="SELECT usuarios.name as members, IFNULL(concat(sum(maquinas.energy_produced),'KWh' ),concat(0, 'KWh'))as energy_produced, IFNULL(concat(sum(maquinas.carbono_ahorrado), 'KWh' ),concat(0, 'KWh'))as carbono_ahorrado FROM `usuarios` 
      left join instalaciones on instalaciones.id_user=usuarios.id 
      left join maquinas on maquinas.id_instalation=instalaciones.id 
      right join comunidad_usuario on comunidad_usuario.usuario_id=usuarios.id
      where comunidad_usuario.comunidad_id= $request group by usuarios.id";
      $comunidades=DB::select($sql);
      return $comunidades;

      // $comunidades2= Usuario::join('usuarios_comunidades','usuarios.id','=','usuarios_comunidades.id_user')
      // ->join('instalaciones','usuarios.id','=','instalaciones.id_user')
      // ->join('maquinas','instalaciones.id','=','maquinas.id_instalation')
      // ->select(DB::raw('usuarios.name as members,sum(maquinas.energy_produced)as energy_produced, sum(maquinas.carbono_ahorrado)as carbono_ahorrado'))
      // ->groupBy('usuarios.name')
      // ->get();

//       $comunidades2= Usuario::select('usuarios.name as members', DB::raw('sum(maquinas.energy_produced) as energy_produced,sum(maquinas.carbono_ahorrado) as carbono_ahorrado'))
// ->join('instalaciones','instalaciones.id_user','=','usuarios.id')
// ->join('maquinas','maquinas.id_instalation','=','instalaciones.id')
// ->join('usuarios_comunidades','usuarios_comunidades.id_user','=','usuarios.id')
// ->where('usuarios_comunidades.id_comunity','=',"DB::raw($request)")
// ->groupBy('usuarios.name')
// ->get();

// $comunidades2= Usuario::select('usuarios.name as members', DB::raw('sum(maquinas.energy_produced) as energy_produced,sum(maquinas.carbono_ahorrado) as carbono_ahorrado'))
// ->join('instalaciones','instalaciones.id_user','=','usuarios.id')
// ->join('maquinas','maquinas.id_instalation','=','instalaciones.id')
// ->join('usuarios_comunidades','usuarios_comunidades.id_user','=','usuarios.id')
// ->where('usuarios_comunidades.id_comunity','=', $request)
// ->groupBy('usuarios_comunidades.id_user')
// ->get();
//       return $comunidades2;



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


         public function abandonarCom($comunidades,$usuarios)
         {
            
            //   $usuario=Usuario::find($usuarios);
            //   $comunidad = Comunidad::find($comunidades);
            //  $comunidad->usuarios()->delete($usuario);

            $sql="DELETE from comunidad_usuario where comunidad_id=$comunidades and usuario_id=$usuarios";
            DB::select($sql);

             
         }
         public function store(Request $request)
         {
             $task = new Comunidad();
             $task->name = $request->name;
             $task->description = $request->description;
             $task->master = $request->master;
             $task->save();
            $usuario=Usuario::find($request->id_user);
              $comunidad = Comunidad::find($task->id);
             $comunidad->usuarios()->attach($usuario);
             //Esta función guardará las tareas que enviaremos
             return response()->json([
                 "message" => "Tarea almacenada con éxito"
             ], 201);
         }
         public function intermedio(Request $request)
         {
             $usuario=Usuario::find($request->usuario_id);
              $comunidad = Comunidad::find($request->comunidad_id);
             $comunidad->usuarios()->attach($usuario);
         }


}
// https://sql2builder.github.io/