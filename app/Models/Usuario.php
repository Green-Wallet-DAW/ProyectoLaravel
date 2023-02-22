<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Laravel\Passport\HasApiTokens; 
use Illuminate\Notifications\Notifiable;

class Usuario extends Model implements Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, AuthenticableTrait;
    
    protected $table = 'usuarios';  //hacemos referencia a la tabla artículos
    protected $fillable = ['name', 'password', 'email', 'token', 'rol', 'cumn', 'phone_number', 'newsletter', 'number_comunities'];   
       //fillable para proteger los campos que desea que permitan la actualización a la hora de insertar en la base de datos por asignación masiva
       public function comunidades()
       {
           return $this->belongsToMany('App\Models\Comunidad');
       }
       public function servicios()
       {
           return $this->hasToMany('App\Models\Servicio');
       }
       public function instalacion()
       {
           return $this->hasMany('App\Models\Instalacion');
       }
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
