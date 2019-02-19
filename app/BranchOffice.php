<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BranchOffice extends Model
{
    //
    protected $table =  'branch_office';
    protected $fillable = array('name','main_phone','main_address','latitude_longitude_elevation','customer_id','active');


    
    public function customer(){

        return $this->belongsTo(Customer::class); 
        
    }
}
