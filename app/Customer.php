<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    protected $table =  'customer';
    protected $fillable = array('name','main_phone','main_address','profile_id','active');

}
