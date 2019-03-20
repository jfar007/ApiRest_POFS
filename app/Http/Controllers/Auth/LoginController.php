<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Helpers;
use App\Http\Requests\Authenticate;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Security;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        /*       $this->middleware('guest')->except('logout');*/
    }


    public function login(Authenticate $request)
    {

        $user = User::query()->where('username', '=', $request->username)->first();

        if (!$user) {

            return redirect()->route('login')->with('message', 'El usuario ingresado no existe, vuelva a intentarlo');
        }


        if ($user->confirmation_code) {
            return redirect()->route('login')->with('error', 'El usurio ingresado existe, verifique su cuenta en su email');
        }

        if ($user->confirmed == 1 && !isset($user->active)) {
            return redirect()->route('login')->with('error', 'El usurio ingresado, no esta activo');
        }


        /*  if(isset( $user->confirmation_code) && !$user->confirmation_code == null){

              return back()->with('message', 'usuario no confirmado');
          }*/


        if ($user->active == 1 && $user->confirmed == 1) {
            if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {

                return view('admin.newPassword');
            } else {
                return redirect()->route('login')->with('error', 'Credenciales incorrecta');
            }

        }


        if ($user->active == 1 && $user->confirmed == 0) {

            if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {


                if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2) {
                    return view('admin.dashboard');
                } else {

                    return view('admin.client.dashboardclient');
                }

            }
        }


        return redirect()->route('login');
    }


    public function changePassword(Request $request)
    {

        $user = User::query()->where('id', '=', Auth::user()->id)->first();

        $user->password = bcrypt($request->newPassword);
        $user->confirmed = 0;
        $user->save();

        if (Auth::user()->rol_id == 1 || Auth::user()->rol_id == 2) {

            return redirect()->route('dashboard');
        }

        if (Auth::user()->rol_id == 3) {

            return redirect()->route('dashboardClient');

        }

    }

}