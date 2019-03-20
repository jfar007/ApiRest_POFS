<?php

namespace App\Http\Controllers\Admin;

use App\BranchOffice;
use App\Customer;
use App\Enums\UserRegister;
use App\Http\Controllers\Controller;
use App\Http\Helpers;
use App\Mail\VerifyRegister;
use App\Profile;
use App\Rol;
use App\Security\Security;
use Auth;
use DB;
use Mail;
use App\User;
use HttpRequestException;
use Illuminate\Http\Request;
use SecurityHelper;
use Symfony\Component\HttpFoundation\ParameterBag;

class UsersViewController extends Controller
{
    public function usersViewClient()
    {
        $roles = Rol::query()->select('id', 'name')->get();
        $customers = Customer::query()->select('id', 'name', 'main_phone')->get();
        $branches = BranchOffice::query()->select('id', 'name', 'main_phone')->get();

        $users = User::query()->select('id', 'username','password', 'name', 'email', 'branch_office', 'mobile_phone', 'landline', 'address',
                'latitude_longitude_elevation', 'rol_id', 'customer_id','branch_office_cf_id', 'confirmed', 'active' )
        ->get();



        /*$users = DB::table('users as A')->join('rol as B','A.rol_id','=','B.id')
            ->join('customer as C','A.customer_id','=', 'C.id')
            ->join('branch_office as D','A.branch_office_cf_id', '=', 'D.id')
            ->select('A.id', 'A.username','A.password', 'A.name', 'A.email', 'A.branch_office', 'A.mobile_phone', 'A.landline', 'A.address',
                'A.latitude_longitude_elevation', 'A.rol_id', 'A.customer_id','A.branch_office_cf_id', 'A.confirmed', 'A.active', DB::raw('B.name as nameRol'), DB::raw('C.name as nameCustomer'), DB::raw('D.name as nameBranch') )
        ->get();*/




        return view('admin.users', compact('roles', 'customers', 'branches', 'users'));
    }


    public function usersEditClient()
    {
        return view('admin.users');
    }

    public function usersStoreClient(Request $request)
    {

        try {

            $result = Security::credentialsTest($request);

            switch ($result) {
                case UserRegister::SUCCESS:
                    switch (Auth::user()->role_id) {
                        case (1):

                            $user = new User();

                            $user->name = $request->name;
                            $user->username = $request->username;
                            $user->password = $request->password;
                            $user->confirmation_code = str_random(25);

                            $register = 1;
                            Mail::to($user->email)->send(new VerifyRegister($user, $register));


                            $user->password = SecurityHelper::EncryptPassword($request->password);
                            $user->email = $request->email;
                            $user->mobile_phone = $request->mobile_phone;
                            $user->landline = $request->landline;
                            $user->address = $request->address;
                            $user->rol_id = $request->rol_id;
                            $user->customer_id = $request->customer_id;
                            $user->branch_office_cf_id = $request->branch_office_cf_id;

                            $user->save();
                            Helpers::notifyMsg('success', "Usuario guardado correctamente");
                            return redirect()->route('usuarios');

                         break;

                        default:
                            Helpers::notifyMsg('error', "Usted no es super usuario");
                            return redirect()->route('usuarios');
                    }
                    break;





                case UserRegister::ALREADY_REGISTERED:

                   Helpers::notifyMsg('error', "El usuario ya exsite");
                   return redirect()->route('usuarios');
                    break;
            }


        } catch (HttpRequestException $e) {
            Helpers::notifyMsg('error', "No se pudo completar el proceso");
             return redirect()->route('usuarios');
        }

        Helpers::notifyMsg('error', "No se pudo completar el proceso");
        return redirect()->route('usuarios');

    }

    public function usersUpdateClient()
    {
        return view('admin.users');
    }


    public function usersDeleteClient()
    {
        return view('admin.users');
    }







    public function rolViewClient()
    {
        $roles = Rol::query()->select( 'name','active')->get();
        return view('admin.rol',compact('roles'));
    }

    public function profileViewClient()
    {
        $profiles = Profile::query()->select('name', 'active')->get();
        return view('admin.profile',compact('profiles'));
    }
}
