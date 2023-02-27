<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instalacion extends Model
{
    use HasFactory;
    protected $table = 'instalaciones';  //hacemos referencia a la tabla artículos
    protected $fillable = ['number_machine', 'id_user','facility_name','street_name','contractNumber'];
       //fillable para proteger los campos que desea que permitan la actualización a la hora de insertar en la base de datos por asignación masiva
       public function usuarios()
    {
        return $this->belongsTo('App\Models\Usuario');
    }
    public function maquina()
       {
           return $this->hasMany('App\Models\Maquina');
       }
}
