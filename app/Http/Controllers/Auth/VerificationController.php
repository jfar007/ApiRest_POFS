<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use HttpRequestException;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
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
 /*      $this->middleware('auth')->except('veify');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');*/
    }


    public function verify($code)
    {

        try {
            $user = User::query()->where('confirmation_code','=', $code)->first();

            if (!$user) {
                return redirect('https://foodsolutionsmarket.com/'.$code);
            }

            $user->confirmed = 1;
            $user->confirmation_code = null;
            $user->save();

            return view('admin.confirmation');

        } catch (HttpRequestException $e) {

            return "error interno";
        }

        return redirect('https://foodsolutionsmarket.com/');
    }

}
