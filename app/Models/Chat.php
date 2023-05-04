<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $table = 'chats';
    protected $fillable = ['tipo', 'sender', 'receiver', 'message'];
    public function usuarios()
    {
        return $this->belongsToMany('App\Models\Usuario');
    }
}
