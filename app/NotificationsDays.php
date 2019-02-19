<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationsDays extends Model
{
    protected $table =  'notificationdays';
    protected $fillable = array('day','until_this_time','send_notification','customer_id','active');

}
