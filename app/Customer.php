<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    protected $table =  'customer';
    protected $fillable = array('name','main_phone','main_address','logo_url','profile_id','active');



    public function profile(){

        return $this->belongsTo(Profile::class); 
        
    }

    public function notificationsdays(){

        return $this->belongsTo(NotificationsDays::class); 
        
    }
}
