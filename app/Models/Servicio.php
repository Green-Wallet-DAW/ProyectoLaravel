<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;
    protected $table = 'servicios';  //hacemos referencia a la tabla artículos
    protected $fillable = ['name', 'description', 'link', 'tokens', 'precio', 'rol_service'];   
    //    fillable para proteger los campos que desea que permitan la actualización a la hora de insertar en la base de datos por asignación masiva
       public function usuarios()
       {
           return $this->belongsToMany('App\Models\Usuario');
       }
       public function comunidades()
       {
           return $this->belongsToMany('App\Models\Comunidad');
       }
}
