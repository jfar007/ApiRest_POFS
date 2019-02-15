<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListCustomerProductDetails extends Model
{
    protected $table =  'list_customer_product_details';
    protected $fillable = array('list_customer_product_id','product_id','suggest','priority','active');
    
}
