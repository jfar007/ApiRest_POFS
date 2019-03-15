<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderClientView extends Controller
{

    public function orderClientView()
    {

        return view('admin.client.orderclient');

    }

    public function lastOrderClientView()
    {
        return view('admin.client.lastorderclient');
    }

    public function statusCurrentOrderClientView()
    {

        return view('admin.client.statuscurrentorderclient');
    }

    public function productsuggestionClientView()
    {
        return view('admin.client.productsuggestion');
    }

    public function taskClientView()
    {
        return view('admin.client.taskclient');
    }
}
