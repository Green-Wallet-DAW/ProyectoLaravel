<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maquina extends Model
{
    use HasFactory;
    protected $table = 'maquinas';  //hacemos referencia a la tabla artículos
    protected $fillable = ['modelo', 'energy_produced', 'carbono_ahorrado', 'type', 'components', 'fabricante', 'id_instalation'];
       //fillable para proteger los campos que desea que permitan la actualización a la hora de insertar en la base de datos por asignación masiva
       public function comunidades()
       {
           return $this->belongsToMany('App\Models\Comunidad');
       }
       public function instalaciones()
       {
           return $this->belongsToMany('App\Models\Instalacion');
       }
}
