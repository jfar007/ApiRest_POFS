<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderManagement extends Model 
{
    protected $table =  'order_management';
    protected $fillable = array('task_id','customer_id','from','name_of_day','hour_of_day','notify','initial_day_notify','notify_from','active');

    public function customer(){
        return $this->belongsTo(customer::class); 
    }

    public function task(){
        return $this->belongsTo(Task::class); 
    }
}
