<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ProductSuggestionViewController extends Controller
{
    public function productSuggestionView(){
        return view('admin.productsuggestion');
    }
}
