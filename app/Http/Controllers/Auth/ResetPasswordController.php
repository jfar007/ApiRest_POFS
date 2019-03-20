<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyRegister;
use App\User;
use Hash;
use HttpRequestException;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Mail;
use App\Security;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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




    public function resetpassword(Request $request)
    {
        try {

            $user = User::query()->where('email', '=', $request->email)->first();

            if (!$user) {

                return back()->with(['error' => 'El email no es valido']);

            }

            $register = 0;
            $passtemp = str_random(10);

            $user->password = $passtemp;
            Mail::to($user->email)->send(new VerifyRegister($user, $register));

            $user->password = Hash::make($passtemp);
            $user->confirmed = 1;
            $user->save();

            return back()->with('success', 'Password reseteado');
        } catch (HttpRequestException $e) {
            return back()->with('message', 'No se completo el proceso');
        }


    }


}
