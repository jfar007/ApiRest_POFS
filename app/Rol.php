<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{

    protected $table =  'rol';
    protected $fillable = array('name','active');

    public function users(){
        return $this->hasMany(User::class);
    }

}
