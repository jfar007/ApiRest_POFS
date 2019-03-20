<?php

namespace App\Security;

use Hash;

class SecurityHelper
{

       public static function EncryptPasswordBase64($pass) {
        $encodedPass = base64_encode($pass);

        $opciones = [
            'cost' => 12
        ];

        return password_hash($encodedPass, PASSWORD_BCRYPT, $opciones);
    }


    public static function EncryptpassBcrypt($pass) {

        return bcrypt($pass);
    }


}