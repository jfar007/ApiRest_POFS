<?php
namespace App\Security;

use App\Enums\UserRegister;
use App\User;
use Auth;
use function GuzzleHttp\Psr7\str;
use Illuminate\Support\Str;


/**
 * Created by PhpStorm.
 * User: Anonimos
 * Date: 18/03/2019
 * Time: 15:50
 */
 class  Security
{

    private const LOGIN_ERROR = 'Usuario o password invalido';

    public static function login(array $data)
    {   //array $data

        $user = User::where('email', $data['email'])->first();
        //$user =  DB::table("users")->where(DB::raw("email"), $data['email'])->first();

        if ($user === NULL) {
            return LoginResult::INVALID_USER;
        }

        if (!$user->is_active) {
            return LoginResult::INVALID_USER;
        }

        if ($user->is_locked_out && date_diff(new DateTime($user->lock_start_date_time), new DateTime(date('Y-m-d H:i:s')))->i < 10) {
            return LoginResult::LOCKED_OUT;
        }

        $encodedPass = base64_encode($data['password']);

        if (!password_verify($encodedPass, $user->password)) {

            if ($user->fail_attempt_count <= 5) {
                User::where('id', $user->id)
                    ->update([
                        'is_locked_out' => false,
                        'lock_start_date_time' => null,
                        'fail_attempt_count' => ($user->fail_attempt_count + 1)
                    ]);

                return LoginResult::INVALID_PASSWORD;
            }

            User::where('id', $user->id)
                ->update([
                    'fail_attempt_count' => 0,
                    'is_locked_out' => true,
                    'lock_start_date_time' => date('Y-m-d H:i:s')
                ]);

            return LoginResult::LOCKED_OUT;
        }

        User::where('id', $user->id)
            ->update([
                'fail_attempt_count' => 0,
                'last_login_date' => date('Y-m-d H:i:s')
            ]);

        Auth::guard()->login($user);
        return LoginResult::SUCCESS;
    }

    Public static function credentialsTest($request)
    {

        if ($request->username) {
            if ($user = User::query()->where('username', $request->username)->first()) {
                return UserRegister::ALREADY_REGISTERED_USER;
            }
        }


        if ($request->email) {
            if ($user = User::query()->where('email', $request->email)->first()) {
                return UserRegister::ALREADY_REGISTERED_EMAIL;
            }
        }

        if (!strcmp($request->password, $request->confirm_password) == 0) {

                return UserRegister::PASSWORD_NOT_EQUAL;
        }


        return UserRegister::SUCCESS;

    }


    public static function sectionAdmin(){

        if (Auth::user()->rol_id == 1 || Auth::user()->rol_id == 2 && Auth::user()->confirmed == 0 && Auth::user()->active == 1 ){

            return true;
        }
        else {
            return false;
        }

    }

    public static function sectionClient(){

        if (Auth::user()->rol_id == 3 && Auth::user()->confirmed == 0 && Auth::user()->active == 1 ){

            return true;
        }
        else {
            return false;
        }

    }


}