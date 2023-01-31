<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Maquina;
use App\Models\Instalacion;
use App\Models\Comunidad;
use App\Models\Servicio;

class BdController extends Controller
{
    public function unirseacomunidad(){
   //     $sql='SELECT comunidades.id, comunidades.name, comunidades.description as descripcion, sum(maquinas.energy_produced)as energy_produced,count(usuarios_comunidades.id_user) as members FROM `usuarios_comunidades`
   //     inner join comunidades on usuarios_comunidades.id_comunity=comunidades.id
   //     inner join usuarios on usuarios.id=usuarios_comunidades.id_user
   //       inner join instalaciones on instalaciones.id_user=usuarios.id
   //      inner join maquinas on maquinas.id_instalation=instalaciones.id
   //     group by comunidades.id;';
   //     $comunidades=DB::select($sql);
   //  return $comunidades;

      // $unirse1= Comunidad::select('id','name','description')
      // ->groupBy('id')
      // ->get();
      $unirse2= Comunidad::join('usuarios_comunidades','comunidades.id','=','usuarios_comunidades.id_comunity')
      ->join('usuarios','usuarios.id','=','usuarios_comunidades.id_user')
      ->join('instalaciones','usuarios.id','=','instalaciones.id_user')
      ->join('maquinas','instalaciones.id','=','maquinas.id_instalation')
      ->select(DB::raw('comunidades.id,comunidades.name,comunidades.description,sum(maquinas.energy_produced) as energy_produced, count(usuarios_comunidades.id_user) as members'))
      ->groupBy('comunidades.id')
      ->get();
      //https://www.w3schools.com/sql/func_mysql_if.asp
      return $unirse2;
    }
    public function miscomunidades(){
        $sql='SELECT comunidades.id, comunidades.name, comunidades.token, comunidades.description, sum(maquinas.carbono_ahorrado)as carbono_ahorrado, sum(maquinas.energy_produced)as energy_produced FROM `usuarios_comunidades`
        inner join comunidades on usuarios_comunidades.id_comunity=comunidades.id
        inner join usuarios on usuarios.id=usuarios_comunidades.id_user
        inner join instalaciones on instalaciones.id_user=usuarios.id
        inner join maquinas on maquinas.id_instalation=instalaciones.id
        group by comunidades.id';
        $comunidades=DB::select($sql);
     return $comunidades;
    }
    public function misusuarios(){
      
   //    $sql="SELECT usuarios.name as members, sum(maquinas.energy_produced)as energy_produced, sum(maquinas.carbono_ahorrado)as carbono_ahorrado FROM `usuarios` inner join instalaciones on instalaciones.id_user=usuarios.id inner join maquinas on maquinas.id_instalation=instalaciones.id inner join usuarios_comunidades on usuarios_comunidades.id_user=usuarios.id where usuarios_comunidades.id_comunity=$num group by usuarios.name";
   //    $comunidades=DB::select($sql);
   //    return $comunidades;
   // //   SELECT usuarios.name as members, sum(maquinas.energy_produced)as energy_produced, sum(maquinas.carbono_ahorrado)as carbono_ahorrado FROM `usuarios` inner join instalaciones on instalaciones.id_user=usuarios.id inner join maquinas on maquinas.id_instalation=instalaciones.id group by maquinas.id_instalation;
     }
     public function totalPro(){
      
         $sql="SELECT name as member, sum(maquinas.energy_produced)as Total_Production, sum(maquinas.carbono_ahorrado)as Total_carbon_saved FROM `usuarios`
         inner join instalaciones on usuarios.id=instalaciones.id_user
         inner join maquinas on instalaciones.id=maquinas.id_instalation
         group by member
         order by Total_production desc";
         $comunidades=DB::select($sql);
         return $comunidades;
      
        }





}
