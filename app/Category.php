<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table =  'category';
    protected $fillable = array('name','short_name','active');

}
