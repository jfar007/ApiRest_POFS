<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectionsRol extends Model
{
    protected $table =  'section_rol';
    protected $fillable = array('rol_id','section_id','active');

}
