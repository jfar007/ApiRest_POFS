<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class UserRegister extends Enum
{
    public const SUCCESS = 0;
    public const ALREADY_REGISTERED_USER = 1;
    public const ALREADY_REGISTERED_EMAIL = 2;
    public const PASSWORD_NOT_EQUAL = 3;
    public const NO_DATA = 4;
    public const INTERNAL_ERROR = 5;
}
