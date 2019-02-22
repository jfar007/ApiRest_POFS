<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralParametersController extends Controller
{


    public function access(array $auth, $user_id ){
        
        if(! isset($user_id)){
           return false;
        }else{
            $user = User::where('id', $user_id)->first();
        }

        if(env('ENABLE_SEC' == 1)){
            
        }else{
            return true;
        }
    
    }

    public function requiereauthsection($section){
        $sec = Section::where('name', $section);

        if(! $sec){
            return 0;
        }else{
            // return $sec-> == null; 
        }
    }


}
