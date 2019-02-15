<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable  implements JWTSubject
{
    use Notifiable;

        protected $table =  'users';
        protected $fillable = array('username','password','name','email','branch_office','mobile_phone','landline','address','latitude_longitude_elevation'
        ,'rol_id','customer_id','branch_office_id','confirmed','confirmation_code','active');



        
    public function rol(){
        //return $this->hasOne('App\Rol');
        return $this->belongsTo(Rol::class); 
        
    }

    public function branch_office(){
        //return $this->hasOne('App\Rol');
        return $this->belongsTo(BranchOffice::class); 
        
    }

    public function customer(){
        //return $this->hasOne('App\Rol');
        return $this->belongsTo(Customer::class);
        
    }
	// public function rol_id()
	// {	$rol = new Rol();
    //     // if(isset($this->rol_id) && $this->rol_id != null){
    //         $rol = Rol::find($this->rol_id);
    //     // }        
        
	// 	// return !isset($rol)  && $this->rol_id == null ? null : $rol->nombre;
    //     return $rol->nombre;
    // }
    
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }


    }
