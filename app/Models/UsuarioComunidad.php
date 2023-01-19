<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioComunidad extends Model
{
    use HasFactory;
    protected $table = 'usuarios_comunidades';  //hacemos referencia a la tabla artículos
    protected $fillable = ['id_comunity', 'id_user'];   
       //fillable para proteger los campos que desea que permitan la actualización a la hora de insertar en la base de datos por asignación masiva
}
//eliminar?
