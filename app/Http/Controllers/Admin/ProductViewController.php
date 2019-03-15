<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ProductViewController extends Controller
{
    public function productView(){
        return view('admin.product');
    }

    public function categoryView(){
        return view('admin.category');
    }

    public function unitView(){
        return view('admin.unit');
    }

}
