<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machines extends Model
{
    use HasFactory;
    protected $table = 'maquinas_disponibles';  //LLamada a la tabla maquinas_disponibles
    protected $fillable = ['Nombre', 'Descripcion'];

}
