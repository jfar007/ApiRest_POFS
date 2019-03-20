<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class SaveResult extends Enum
{
    public const SUCCESS = 0;
    public const DATES_ERROR = 1;
    public const INTERNAL_ERROR = 2;
    public const EXISTING_DATA = 3;
}
