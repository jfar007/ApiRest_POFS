<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class CustomerViewController extends Controller
{
    public function customerView(){

        return view('admin.customer');
    }
}
