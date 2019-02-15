<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table =  'product';
    protected $fillable = array('cod_fs','item','name','pronunciation_in_english','description','packsize','picture_url','category_id','unit_id','active');

}
