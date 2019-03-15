<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class LoginResult extends Enum
{
    public const SUCCESS = 0;
    public const INVALID_PASSWORD = -1;
    public const INVALID_USER = -2;
    public const LOCKED_OUT = -3;
}
