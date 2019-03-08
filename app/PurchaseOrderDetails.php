<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDetails extends Model
{
 
    protected $table =  'purchase_order_details';
    protected $fillable = array('purchase_order_id','product_id','quantity','purchase_order_date');


        public function product(){
            return $this->belongsTo(Product::class);  
        }

        public function purchase_order(){
            return $this->belongsTo(PurchaseOrder::class);  
        }
}
