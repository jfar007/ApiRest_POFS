<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{

    protected $table =  'rol';
    protected $fillable = array('name','active');
    public static $administrador = 1;
    public static $distribuidor = 2;
    public static $sucursal = 3;
    

    public function users(){
        return $this->hasMany(User::class);
    }

}
