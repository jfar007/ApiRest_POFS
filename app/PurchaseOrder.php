<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $table =  'purchase_order';
    protected $fillable = array('customer_id','branch_office_id','description','total_quantity','purchase_order_number','purchase_order_url'
    ,'cut_date','status_id', 'users_create_id','users_lm_id');
 
    
    public function customer(){
        return $this->belongsTo(Customer::class); 
    }

    
    public function branch_office(){
        return $this->belongsTo(BranchOffice::class); 
    }

    public function users_lm(){
        return $this->belongsTo(User::class);
    }

    public function status(){
        return $this->belongsTo(status::class);
    }

    public function users_create(){
        return $this->belongsTo(User::class);
    }
}
