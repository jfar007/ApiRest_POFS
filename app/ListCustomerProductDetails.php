<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListCustomerProductDetails extends Model
{
    protected $table =  'list_customer_product_details';
    protected $fillable = array('list_customer_product_id','product_id','suggest','priority','active');
  
    
    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function list_customer_product(){
        return $this->belongsTo(ListCustomerProduct::class);
    }
}
