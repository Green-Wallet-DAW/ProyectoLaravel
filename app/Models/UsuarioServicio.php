<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioServicio extends Model
{
    use HasFactory;
    protected $table = 'usuarios_servicios';  //hacemos referencia a la tabla artículos
    protected $fillable = ['id_service', 'id_user'];   
       //fillable para proteger los campos que desea que permitan la actualización a la hora de insertar en la base de datos por asignación masiva

    public function servicios(){
        return $this->belongsToMany('App\Models\Servicio');
    }
    public function usuarios(){
        return $this->belongsToMany('App\Models\Usuario');
    }
    }
//eliminar?