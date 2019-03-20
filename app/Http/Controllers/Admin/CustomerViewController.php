<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\Http\Controllers\Controller;

use App\Http\Helpers;
use App\Profile;
use DB;
use HttpRequestException;
use Illuminate\Http\Request;

class CustomerViewController extends Controller
{
    public function customerView()
    {

        $profiles = Profile::query()->select('id', 'name')->get();

        $customers = Customer::query()->join('profile as A', 'customer.profile_id', '=', 'A.id')
            ->select('customer.id', 'customer.name', 'customer.main_phone', 'customer.main_address', 'customer.profile_id', 'customer.active', DB::raw('A.name as nameprofile'))
            ->get();

        return view('admin.customer', compact('profiles', 'customers'));
    }


    public function customerEdit($id)
    {

        $customer = Customer::query()->where('id' , '=', $id)->get();
        $profiles = Profile::query()->select('id', 'name')->get();

        return view('admin.update.updatecustomer', compact('customer', 'profiles'));
    }

    public function customerStore(Request $request)
    {

        try {

            Customer::query()->create($request->all());

            Helpers::notifyMsg('success', 'Se guardo el cliente correctamente');
            return redirect()->route('clientes');
        } catch (HttpRequestException $ex) {

            Helpers::notifyMsg('error', 'No se guardo el cliente correctamente');
            return redirect()->route('clientes');
        }

    }

    public function customerUpdate(Request $request, $id)
    {
        try {
            Customer::query()->find($id)->update($request->all());

            Helpers::notifyMsg('success', 'Se modifico el cliente correctamente');
            return redirect()->route('clientes');

        } catch (HttpRequestException $ex) {

            Helpers::notifyMsg('error', 'No se modifico el cliente correctamente');
            return redirect()->route('clientes');
        }

    }

    public function customerDelete($id)
    {

        try {
            Customer::query()->find($id)->delete();

            Helpers::notifyMsg('success', 'Se elimino el cliente correctamente');
            return redirect()->route('clientes');

        } catch (HttpRequestException $ex) {

            Helpers::notifyMsg('error', 'No se elimino el cliente correctamente');
            return redirect()->route('clientes');
        }

    }

}
