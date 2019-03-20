<?php

namespace App\Http\Controllers;

use App\BL\UserAccess;
use App\Enums\UserRegister as UserValidate;
use App\Http\Helpers;
use App\Http\Requests\UserRegister;
use App\Security\Security;
use App\Security\SecurityHelper;
use Auth;
use HttpRequestException;
use Illuminate\Http\Request;
use App\User;
use App\Rol;
use App\BranchOffice;
use App\Customer;
use App\Mail\VerifyRegister;
use Mail;
use JWTAuth;
use \Symfony\Component\HttpFoundation\ParameterBag;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
Use Exception;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    private $section = 'user';


    public function usersView()

    {
        $users = User::all();
        return view('admin.users');

    }


    public function userStoreAdmin(Request $request)
    {

       $validate = Security::credentialsTest($request);

        if ($validate == \App\Enums\UserRegister::ALREADY_REGISTERED_USER) {

            Helpers::notifyMsg('error', "Hay  usuario con el mismo username, vuelva a intentarlo");
            return redirect()->route('usuarios');
        }


        if ($validate == \App\Enums\UserRegister::ALREADY_REGISTERED_EMAIL) {

            Helpers::notifyMsg('error', "Hay  usuario con el mismo email, vuelva a intentarlo");
            return redirect()->route('usuarios');
        }


        if ($validate == \App\Enums\UserRegister::PASSWORD_NOT_EQUAL) {

            Helpers::notifyMsg('error', "Las contraseña no son iguales, vuelva a intentarlo");
            return redirect()->route('usuarios');
        }


        if ($validate == \App\Enums\UserRegister::SUCCESS) {

            $user = new User();
            $user->username = $request->username;
            $user->password =  SecurityHelper::EncryptpassBcrypt( $request->password);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->branch_office = $request->branch_office;
            $user->mobile_phone = $request->mobile_phone;
            $user->landline = $request->landline;
            $user->address = $request->address;
            $user->latitude_longitude_elevation = $request->latitude_longitude_elevation;
            $user->rol_id = $request->rol_id;
            $user->customer_id = $request->customer_id;
            $user->branch_office_cf_id = $request->branch_office_cf_id;
            $user->confirmed = $request->confirmed;
            $user->active = $request->active;
            $user->save();

            Helpers::notifyMsg('success', "Usuario guardado correctamente");
            return redirect()->route('usuarios');
        }


        Helpers::notifyMsg('error', 'No se pudo completar el proceso');
      return redirect()->route('usuarios');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /*  try{
              $user = User::where('id', $id)->first();
              if (! $user){
                  $response['message'] = 'error';
                  $response['values'] = ['error details' => 'No exist'];
                  $response['user_id'] = null;
                  return response()->json($response,404);
              }

              $user->fill($request->all())->save();

          } catch (Exception $e) {
              $response['message'] = 'error';
              $response['values'] = ['error details' => $e->getMessage()];
              $response['user_id'] = 'PD';
              return response()->json($response,415);
          }


          $response['message'] = 'ok';
          $response['values'] = $user;
          $response['user_id'] = 'PD';
          return response()->json($response,200);*/
    }



}



