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
        ,'rol_id','customer_id','branch_office_cf_id','confirmed','confirmation_code','active');



        
    public function rol(){
        return $this->belongsTo(Rol::class);
        
    }

    public function branch_office_cf(){
        return $this->belongsTo(BranchOffice::class); 
        
    }

    public function customer(){
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


    public function getRememberToken()
    {
        return '';
    }

    public function setRememberToken($value)
    {
    }

    public function getRememberTokenName()
    {
        // just anything that's not actually on the model
        return 'trash_attribute';
    }

    /**
     * Fake attribute setter so that Guard doesn't complain about
     * a property not existing that it tries to set.
     *
     * Does nothing, obviously.
     */
    public function setTrashAttributeAttribute($value)
    {
    }
    
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }


    }
