<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Rol;
use App\BranchOffice;
use App\Customer;
use App\Mail\VerifyRegister;
use Mail;
use JWTAuth; 
use Tymon\JWTAut\Exceptions\JWTException; 
use \Symfony\Component\HttpFoundation\ParameterBag;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
Use Exception;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    private $section = 'user'; 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $Users=User::all();

        foreach ($Users as $user)
        {
            $user= $this->valideRelations($user);
        }
   
        // LogController::write_log('ConsultUsers');
        // return response()->json(compact('Users'),200);
        $response['message'] = 'ok';
        $response['values'] = $Users;
        $response['user_id'] = 'PD';
       return response()->json($response,201);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
    try{

        $userpr = new ParameterBag($request->toArray()); 
        $passtemp = str_random(10);
        $name = $request['name'];
        $x = true;
        while($x) {
                $username = 'fs'. substr($name, 0, 2) . str_random(4);      
                $username = strtolower($username);      
                $user = User::where('username', $username)->first();
                if (!$user)
                    $x = false;       
        }
        $parameters =  ['username' =>  $username,
                        'password' =>$passtemp ,
                        'confirmation_code' => str_random(25)];
        $userpr->add($parameters);
        $user =  User::create($userpr->all());

        $register = 1;
         Mail::to($user->email)->send(new VerifyRegister($user, $register));
       
        $user->password=bcrypt($passtemp);
        $user->save();

        $user = $this->valideRelations( $user);

    } catch (Exception $e) {
        $response['message'] = 'error';
        $response['values'] = ['error details' => $e->getMessage()];
        $response['user_id'] = 'PD';
        return response()->json($response,415);
    }
   
         $response['message'] = 'ok';
         $response['values'] = $user;
         $response['user_id'] = 'PD';
         return response()->json($response,201);


    }



    public function verify($code){

        try{
        $user = User::where('confirmation_code', $code)->first();

        if (! $user){
            $response['message'] = 'error';
            $response['values'] = ['error details' => 'No exist'];
            $response['user_id'] = null;
            return response()->json($response,404);
        }
      
        $user->confirmation_code = null;
        $user->save();
    
        // return redirect('/')->with('notification', 'Has confirmado correctamente tu correo!');
        // return $user;
        } catch (Exception $e) {
            $response['message'] = 'error';
            $response['values'] = ['error details' => $e->getMessage()];
            $response['user_id'] = 'PD';
            return response()->json($response,415);
        }

        return redirect(env('APP_PAG'));
    }

    public function resetpassword(Request $request){
        try{
            $user = User::where('email', $request['email'])->first();

            if (! $user){
                $response['message'] = 'error';
                $response['values'] = ['error details' => 'No exist'];
                $response['user_id'] = null;
                return response()->json($response,404);
            }
    
            $register = 0;
            $passtemp = str_random(10);

            $user->password= $passtemp;        
            Mail::to($user->email)->send(new VerifyRegister($user, $register));
            
            $user->password=bcrypt($passtemp);
            $user->confirmed = false;   
            $user->save();
        } catch (Exception $e) {
            $response['message'] = 'error';
            $response['values'] = ['error details' => $e->getMessage()];
            $response['user_id'] = 'PD';
            return response()->json($response,415);
        }
        // return redirect('/')->with('notification', 'Has confirmado correctamente tu correo!');
        // return $user;
        
        $response['message'] = 'ok';
        $response['values'] = $user;
        $response['user_id'] = 'PD';
        return response()->json($response,200);
    }
                     
    public function  authenticate(Request $request){
        

        try{
            $user = User::where('username', $request['username'])->first();

            if (! $user){
                $response['message'] = 'error';
                $response['values'] = ['error details' => 'No exist'];
                $response['user_id'] = null;
                return response()->json($response,404);
            }
                
                
            $credentials = $request->only('username','password');
        
            try{
                if(!$tocken = JWTAuth::attempt($credentials)){
                    $response['message'] = 'error';
                    $response['values'] = ['error details' => 'invalid credentials','user' => $user];
                    $response['user_id'] = $user->id;
                    return response()->json($response,422);                
                }
            } catch (JWTExceptions $e){
                $response['message'] = 'error';
                $response['values'] = ['error details' => 'invalid credentials','user' => $user];
                $response['user_id'] = $user->id;
                return response()->json($response,500);                 
            }
            
            if ($user->confirmed==false && !isset( $user->confirmation_code) && ($request['password_new'] == null ||  !isset($request['password_new']) )){
                $response['message'] = 'error';
                $response['values'] = ['error details' => 'Exist but requiere password_new','user' => $user];
                $response['user_id'] = $user->id;
                return response()->json($response,403);
            
            }elseif($user->confirmed==false && !isset( $user->confirmation_code)){
                $user->password=bcrypt($request['password_new']);            
                $user->confirmed = true;   
                $user->save();
                $response['message'] = 'ok';
                $response['values'] = $user;
                $response['user_id'] = $user->id;
                return response()->json($response,200);
            }
                
            if(isset( $user->confirmation_code) && !$user->confirmation_code == null){
                $response['message'] = 'error';
                $response['values'] = ['details' => 'User no confirmed code','user' => $user];
                $response['user_id'] = $user->id;
                return response()->json($response,403);
            }      

       
            $userrsp = JWTAuth::user();
        
        } catch (Exception $e) {
            $response['message'] = 'error';
            $response['values'] = ['error details' => $e->getMessage()];
            $response['user_id'] = 'PD';
            return response()->json($response,415);
        }
        // $response = compact('tocken');
        // $response['user'] = $userrsp;
        $request->session()->put('user', $user);
        $response['message'] = 'ok';
        $response['values'] = $user;
        $response['user_id'] = 'PD';
        $response['tocken'] = $tocken;
        return response()->json($response,200);

        // return  response()->json(['message' => 
        // 'Successfully ' ,'user' => $request->all() , 'userfn' => $user,'afi' => ($user->confirmed==false) ,'afi2' => !isset( $user->confirmation_code), 'userlg' => $request['username']] );

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $user = User::where('id', $id)->first();
    //     if (! $user){
    //         $response['message'] = 'error';
    //         $response['values'] = ['error details' => 'No exist'];
    //         $response['user_id'] = null;
    //         return response()->json($response,404);
    //     }

    //     $user = $this->valideRelations($user);
    //     $response['message'] = 'ok';
    //     $response['values'] = $user;
    //     $response['user_id'] = 'PD';
    //     return response()->json($response,200);
    //     return $user;

    // }

    public function show(Request $request,$id)
    {
        Log::info('show!'. json_encode( $request->session()));
        //  $value = $request->session()->get('user');
        // $user = User::where('email', $value->email)->first();
        Log::info('show! Class UserController' . json_encode( $request->session()->all()) );
        $user = $request->session()->get('user');
        $userjs =  $user->email;
        Log::info('show! Class UserController' . $userjs );
        return response()->json(  $request->user() );
    }


    public function valideRelations(User $user){
        if(isset($user['rol_id']) && !$user['rol_id'] == null) {
            $rol = Rol::find($user->rol_id);
            $user->rol()->associate($rol);
        } 

        
        if(isset($user['branch_office_cf_id']) && !$user['branch_office_cf_id'] == null) {
            $branch_office = BranchOffice::find($user->branch_office_cf_id);
            $user->branch_office_cf()->associate($branch_office);
        } 

        if(isset($user['customer_id']) && !$user['customer_id'] == null) {
            $customer = Customer::find($user->customer_id);
            $user->customer()->associate($customer);
        } 
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        try{
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
        return response()->json($response,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->first();
        if (! $user){
            $response['message'] = 'error';
            $response['values'] = ['error details' => 'No exist'];
            $response['user_id'] = null;
            return response()->json($response,404);
        }
            
        $user->delete();

        $response['message'] = 'ok';
        $response['values'] = $user;
        $response['user_id'] = 'PD';
        return response()->json($response,200);
    }


    
    public function getAuthenticatedUser()
    {
            try {

                    if (! $user = JWTAuth::parseToken()->authenticate()) {
                            return response()->json(['user_not_found'], 404);
                    }

            } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

                    return response()->json(['token_expired'], $e->getStatusCode());

            } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

                    return response()->json(['token_invalid'], $e->getStatusCode());

            } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

                    return response()->json(['token_absent'], $e->getStatusCode());

            }

            return response()->json(compact('user'));
    }


    
    public function getAuthenticatedUserpl(Request $request )
    {
           
        try {

            //JWTAuth::setToken('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTkyLjE2OC4yMzAuMTI4L2Zvb2Rzb2x1dGlvbnNscnYvcHVibGljL2FwaS91L2xnIiwiaWF0IjoxNTUwNjc5OTI2LCJleHAiOjE1NTA2ODM1MjYsIm5iZiI6MTU1MDY3OTkyNiwianRpIjoiRjVDUXYzYndBUkJ1bVNqMiIsInN1YiI6MywicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.f1LUwCGqFIDp086uAcEHxathCEbwMhk_hFBzXZIDjm8');
            $payload =JWTAuth::getPayload();
            return response()->json(
                [
                    compact('payload')
                 ,'request' => $request
                ]);

                    if (! $user = JWTAuth::parseToken()->authenticate()) {
                            return response()->json(['user_not_found'], 404);
                    }

            } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

                    return response()->json(['token_expired'], $e->getStatusCode());

            } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

                    return response()->json(['token_invalid'], $e->getStatusCode());

            } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

                    return response()->json(['token_absent'], $e->getStatusCode());

            }
            
            return response()->json('msg');
    }


   

       
    public function getAuthenticatedUserInfo(Request $request)
    {
           
        try {

            $userrsp = JWTAuth::user();
            return response()->json(compact('userrsp'));

                    if (! $user = JWTAuth::parseToken()->authenticate()) {
                            return response()->json(['user_not_found'], 404);
                    }

            } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

                    return response()->json(['token_expired'], $e->getStatusCode());

            } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

                    return response()->json(['token_invalid'], $e->getStatusCode());

            } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

                    return response()->json(['token_absent'], $e->getStatusCode());

            }
            
            return response()->json('msg');
    }

}
