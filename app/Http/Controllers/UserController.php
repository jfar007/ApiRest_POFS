<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Rol;
use App\Mail\VerifyRegister;
use Mail;
use JWTAuth; 
use Tymon\JWTAut\Exceptions\JWTException; 
use \Symfony\Component\HttpFoundation\ParameterBag;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Users=User::all();

        foreach ($Users as $user)
        {

            $user= $this->valideRelations($user);
    
            $user->save();
        }
  
        return $Users;
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
        $userpr = new ParameterBag($request->toArray()); 

        $passtemp = str_random(10);
        $name = $request['name'];
        $x = true;
        while($x) {
                $username = 'FS'. substr($name, 0, 2) . str_random(4);            
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

   
       if(isset($user['rol_id']) && !$user['rol_id'] == null) {
            $rol = Rol::find($user->rol_id);
            $user->rol()->associate($rol);
        } 
   

       return $user; 
   

    }


    public function verify($code){
        $user = User::where('confirmation_code', $code)->first();

        if (! $user)
            return abort(403, 'Unauthorized action.');
    
        $user->confirmed = true;
        $user->confirmation_code = null;
        $user->save();
    
        // return redirect('/')->with('notification', 'Has confirmado correctamente tu correo!');
        // return $user;

        return redirect('/');
    }

    public function resetpassword(Request $request){
        $user = User::where('email', $request['email'])->first();

        if (! $user)
            return abort(403, 'Unauthorized action.');
   
        $register = 0;
        $passtemp = str_random(10);

        $user->password= $passtemp;        
        Mail::to($user->email)->send(new VerifyRegister($user, $register));
        
        $user->password=bcrypt($passtemp);
        $user->confirmed = false;   
        $user->confirmation_code = null;
        $user->save();

        // return redirect('/')->with('notification', 'Has confirmado correctamente tu correo!');
        // return $user;

        return $user;
    }

    public function  authenticate(Request $request){
        
        $user = User::where('username', $request['username'])->first();

        if (! $user)
            return abort(403, 'Unauthorized action.');
        
        $credentials = $request->only('username','password');
    
        try{
            if(!$tocken = JWTAuth::attempt($credentials)){
                return response()->json(['error' => 'credenciales invalidas'], 422);                
            }
        } catch (JWTExceptions $e){
            return response()->json(['error' => 'credenciales invalidas'],  500); 
        }
        
        if ($user->confirmed==false && !isset( $user->confirmation_code))
            $user->password=bcrypt($request['password_new']);
            $user->confirmed = true;   
            $user->save();


        $userrsp = Auth::user();
    
        if(isset($userrsp->rol_id) && $userrsp->rol_id != null) {
            $rol = Rol::find($userrsp->rol_id);
            $userrsp->rol()->associate($rol);
        } 
            
    
        $response = compact('tocken');
        $response['user'] = $userrsp;
        return $response;
        // return  response()->json(['message' => 
        // 'Successfully ' ,'user' => $request->all() , 'userfn' => $user,'afi' => ($user->confirmed==false) ,'afi2' => !isset( $user->confirmation_code), 'userlg' => $request['username']] );
;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->first();
        
        $user = valideRelations($user);
   

        return $user;
    }

    public function valideRelations(User $user){
        if(isset($user['rol_id']) && !$user['rol_id'] == null) {
            $rol = Rol::find($user->rol_id);
            $user->rol()->associate($rol);
        } 

        
        if(isset($user['branch_office_id']) && !$user['branch_office_id'] == null) {
            $branch_office = BranchOffice::find($user->branch_office_id);
            $user->branch_office()->associate($branch_office);
        } 

        if(isset($user['customer_id']) && !$user['customer_id'] == null) {
            $customer = BranchOffice::find($user->customer_id);
            $user->customer()->associate($customer_id);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
