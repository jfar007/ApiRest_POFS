<?php

namespace App\Http\Controllers\Admin;
use App\BranchOffice;
use App\Customer;
use App\Http\Controllers\Controller;

use App\Http\Helpers;
use HttpRequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Nexmo\Message\Query;

class BranchOfficeControllerView extends Controller
{

    public function branchOfficeView(){

        $customers = Customer::query()->select('id', 'name', 'main_phone')->get();

        $braches = DB::table('branch_office as A')->join('customer as B','A.customer_id','=','B.id')
        ->select('A.id', 'A.name', 'A.main_phone' , 'A.main_address', 'A.latitude_longitude_elevation', 'A.customer_id', 'A.active', DB::raw(DB::raw('CONCAT(B.name,"-"," teléfono:",A.main_phone) AS customer_full_name')) )->get();

        return view('admin.branchoffice', compact('customers', 'braches'));
    }

    public  function branchOfficeEdit($id){

        $branches = DB::table('branch_office as A')->join('customer as B','A.customer_id','=','B.id')
            ->select('A.id', 'A.name', 'A.main_phone' , 'A.main_address', 'A.latitude_longitude_elevation', 'A.customer_id', 'A.active', DB::raw(DB::raw('CONCAT(B.name,"-"," teléfono:",A.main_phone) AS customer_full_name')) )
            ->where('A.id','=',$id)
            ->get();


        $customers = Customer::query()->select('id', 'name', 'main_phone')->get();
        return view('admin.update.updatebranch',compact('branches','customers'));
    }


    public  function branchOfficeStore(Request $request){


        try{

            $branch = BranchOffice::query()->create($request->all());
            Helpers::notifyMsg('success', 'Sucursal guardada correctamente');
            return redirect()->route('sucursales');

        }catch (HttpRequestException $ex){

            Helpers::notifyMsg('error', 'La sucursal no se guardo correctamente');
            return redirect()->route('sucursales');
        }

    }


    public  function branchOfficeUpdate(Request $request, $id){

        try{

            $branch = BranchOffice::query()->find($id)->update($request->all());

            Helpers::notifyMsg('success', 'Sucursal modificada correctamente');
            return redirect()->route('sucursales');

        }catch (HttpRequestException $ex){

            Helpers::notifyMsg('error', 'La sucursal no se modifico correctamente');
            return redirect()->route('sucursales');
        }
    }


    public  function branchOfficeDelete($id){

        try{

            $branch = BranchOffice::query()->find($id)->delete();

            Helpers::notifyMsg('success', 'Sucursal eliminada correctamente');
            return redirect()->route('sucursales');

        }catch (HttpRequestException $ex){

            Helpers::notifyMsg('error', 'La sucursal no se elimino');
            return redirect()->route('sucursales');
        }
    }
}
