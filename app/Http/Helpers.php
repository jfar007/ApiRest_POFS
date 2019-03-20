<?php
/**
 * Created by PhpStorm.
 * User: Anonimos
 * Date: 16/03/2019
 * Time: 22:59
 */

namespace App\Http;


use Session;

class Helpers
{

    public static function notifyMsg($type, $message)
    {
        Session::put($type, $message);

    }

}