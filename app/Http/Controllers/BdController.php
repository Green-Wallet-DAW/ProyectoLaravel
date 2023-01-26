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
       $sql='SELECT comunidades.name, count(usuarios_comunidades.id_user) as members FROM `usuarios_comunidades`
       inner join comunidades on usuarios_comunidades.id_comunity=comunidades.id
       group by comunidades.name;';
       $comunidades=DB::select($sql);
    return $comunidades;
    }
    public function miscomunidades(){
        $sql='SELECT comunidades.name, comunidades.token, comunidades.description, sum(maquinas.carbono_ahorrado)as carbono_ahorrado, sum(maquinas.energy_produced)as energy_produced FROM `usuarios_comunidades`
        inner join comunidades on usuarios_comunidades.id_comunity=comunidades.id
        inner join usuarios on usuarios.id=usuarios_comunidades.id_user
        inner join instalaciones on instalaciones.id_user=usuarios.id
        inner join maquinas on maquinas.id_instalation=instalaciones.id
        group by comunidades.id';
        $comunidades=DB::select($sql);
     return $comunidades;

     }





}
