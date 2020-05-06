<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuari extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuaris';
    public $timestamps = false;

    public function rol()
    {
        return $this->belongsTo('App\Rol', 'id_rol');
    }
}