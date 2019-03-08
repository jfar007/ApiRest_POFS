<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListCustomerProduct extends Model
{
    //
    protected $table =  'list_customer_product';
    protected $fillable = array('name','description','customer_id','users_lm_id','active');


    public function customer(){
        return $this->belongsTo(Customer::class); 
    }

    public function users_lm(){
        return $this->belongsTo(User::class);
    }
}
