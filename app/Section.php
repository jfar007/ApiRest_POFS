<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table =  'section';
    protected $fillable = array('name','auth','active');
}
