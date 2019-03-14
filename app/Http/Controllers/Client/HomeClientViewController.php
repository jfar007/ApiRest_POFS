<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeClientViewController extends Controller
{

    public function dashboardClientView(){
        return view('admin.client.dashboardclient');
    }
}
