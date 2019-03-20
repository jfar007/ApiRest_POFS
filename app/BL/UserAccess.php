<?php
/**
 * Created by PhpStorm.
 * User: Anonimos
 * Date: 19/03/2019
 * Time: 1:34
 */

namespace App\BL;


use App\Enums\UserRegister;
use App\Mail\VerifyRegister;
use App\Security\SecurityHelper;
use App\User;
use HttpRequestException;
use Mail;
use App\Security;
use Symfony\Component\HttpFoundation\ParameterBag;

class UserAccess
{


    public static function createUser($request)
    {

        try {

            // $userpr = new ParameterBag($request->toArray());
            $name = $request->name;
            $passtemp = str_random(10);
            $username = '';

            $x = true;
            while ($x) {
                $username = 'fs' . substr($name, 0, 2) . str_random(4);
                $username = strtolower($username);
                $user = User::query()->where('username', $username)->first();
                if (!$user)
                    $x = false;
            }


            $user = new User();

            $user->name = $name;
            $user->username = $username;
            $user->password = $passtemp;
            $user->confirmation_code = str_random(25);

            $register = 1;
            Mail::to($user->email)->send(new VerifyRegister($user, $register));

            $user->password = SecurityHelper::EncryptPassword($request->password);

            $user->save();

            return UserRegister::SUCCESS;

        } catch (HttpRequestException $ex) {
            return UserRegister::INTERNAL_ERROR;
        }


       /* $user = User::query()-> where('username', $request['username'])->first();

        if (! $user){

            return redirect()->route('login')->with('message','El usuario ingresado no existe, vuelva a intentarlo');
        }


        if ($user->confirmed==false && !isset( $user->confirmation_code) && ($request['password_new'] == null ||  !isset($request['password_new']) )){
            return  redirect()->route() ->with('message','El usurio ingresado existe, pero requiere nuevo password');
        }

        if($user->confirmed==false && !isset( $user->confirmation_code)){
            $user->password=bcrypt($request['password_new']);
            $user->confirmed = true;
            $user->save();
        }


        if(isset( $user->confirmation_code) && !$user->confirmation_code == null){

            return back()->with('message', 'usuario no confirmado');
        }


        if ($user->active == 1)
        {
            if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {


                if (   Auth::user()->role_id == 1 || Auth::user()->role_id == 2 ){
                    return  view('admin.dashboard');
                }else{

                    return  view('admin.client.dashboardclient');
                }

            }

        }else{

            return back()->with('message', 'usuario no activado');
        }

        */


    }

}