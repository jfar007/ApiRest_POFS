<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListCustomerProduct extends Model
{
    //
    protected $table =  'list_customer_product';
    protected $fillable = array('name','description','customer_id','users_lm_id','active');

}
