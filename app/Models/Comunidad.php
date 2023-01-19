<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comunidad extends Model
{
    use HasFactory;
    protected $table = 'comunidades';  //hacemos referencia a la tabla artículos
    protected $fillable = ['name', 'token', 'description', 'master'];
    //fillable para proteger los campos que desea que permitan la actualización a la hora de insertar en la base de datos por asignación masiva
    public function usuarios()
    {
        return $this->belongsToMany('App\Models\Usuario');
    }
    public function servicios()
    {
        return $this->belongsToMany('App\Models\Servicio');
    }
}
