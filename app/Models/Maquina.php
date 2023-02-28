<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maquina extends Model
{
    use HasFactory;
    protected $table = 'maquinas';
    protected $fillable = ['modelo','type', 'components','fabricante','id_instalation'];

       public function comunidades()
       {
           return $this->belongsToMany('App\Models\Comunidad');
       }
       public function instalaciones()
       {
           return $this->belongsToMany('App\Models\Instalacion');
       }
}
