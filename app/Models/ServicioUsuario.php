<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicioUsuario extends Model
{
    use HasFactory;
    protected $table = 'servicio_usuario';
    protected $fillable = ['servicio_id', 'usuario_id'];
}
