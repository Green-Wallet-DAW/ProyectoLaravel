<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    protected $table = 'usuarios';  //hacemos referencia a la tabla artículos
    protected $fillable = ['name', 'password', 'email', 'token', 'rol', 'cumn', 'phone_number', 'newsletter', 'number_comunities'];   
       //fillable para proteger los campos que desea que permitan la actualización a la hora de insertar en la base de datos por asignación masiva
       public function comunidades()
       {
           return $this->belongsToMany('App\Models\Comunidad');
       }
       public function servicios()
       {
           return $this->belongsToMany('App\Models\Servicio');
       }
       public function instalacion()
       {
           return $this->hasMany('App\Models\Instalacion');
       }
}
