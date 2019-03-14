<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class UsersViewController extends Controller
{
    public function usersViewClient()
    {
        return view('admin.users');
    }

    public function rolViewClient(){
        return view('admin.rol');
    }

    public function profileViewClient(){

        return view('admin.profile');
    }
}
