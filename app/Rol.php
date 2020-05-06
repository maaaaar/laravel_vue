<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'rols';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    public function usuaris()
    {
        return $this->hasMany('App\Usuari', 'id_rol');
    }
}