<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRegister;
use App\Mail\VerifyRegister;
use App\Security\Security;
use App\Security\SecurityHelper;
use App\User;
use App\Http\Controllers\Controller;
use HttpRequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
/*    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }*/

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
/*    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }*/


    public  function createUser(Request $request)
    {

        try {
            $result = Security::credentialsTest($request);

            if ($result== UserRegister::ALREADY_REGISTERED_EMAIL){

                return back()->with('error', 'Email no disponible, ingrese uno diferente');
            }

            if ($result== UserRegister::SUCCESS)
            {
                // $userpr = new ParameterBag($request->toArray());
                $name = $request->name;
                $passtemp = str_random(10);
                $username = '';

                $x = true;
                while ($x) {
                    $username = 'fs' . substr($name, 0, 2) . str_random(4);
                    $username = strtolower($username);
                    $user = User::query()->where('username','=', $username)->first();
                    if (!$user)
                        $x = false;
                }


                $user = new User();

                $user->name = $name;
                $user->username = $username;
                $user->password = $passtemp;
                $user->email = $request->email;
                $user->confirmation_code = str_random(50);

                $register = 1;
                Mail::to($user->email)->send(new VerifyRegister($user, $register));

                $user->branch_office = $request->branch_office;
                $user->address = $request->address;
                $user->mobile_phone = $request->mobile_phone;
                $user->landline = $request->landline;
                $user->password = SecurityHelper::EncryptpassBcrypt($passtemp);

                $user->save();

//                return view('auth.confirmation_register') ;
                return 'ok';
           }


        } catch (HttpRequestException $ex) {
            return back()->with('error', 'No se termino el proceso');
        }


    }



}
