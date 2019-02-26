<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    //

    protected $table =  'purchase_order';
    protected $fillable = array('customer_id','branch_office_id','description','total_quantity','purchase_order_number','purchase_order_url'
    ,'cut_date','status_id','users_create_id','users_lm_id');
 
}
