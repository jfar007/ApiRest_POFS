<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class OrderViewController extends Controller
{
    //
    public function purchaseView(){

        return view('admin.purchaseorder');
    }

   public function calendarView(){
        return view('admin.calendar');
   }

}
