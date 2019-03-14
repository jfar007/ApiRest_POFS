<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table =  'status';
    protected $fillable = array('name','description','active');
    public static $creado = 1;
    public static $no_confirmado=2;
    public static $generado=3;
    public static $alistamiento=4;
    public static $transito=5;
    public static $entregado=6;
}
