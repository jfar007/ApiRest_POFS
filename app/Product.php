<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table =  'product';
    protected $fillable = array('cod_fs','item','name','pronunciation_in_english','description','packsize','picture_url','category_id','unit_id','active');

    public function category(){
        return $this->belongsTo(Category::class);         
    }

    public function unit(){
        return $this->belongsTo(Unit::class);         
    }
}
