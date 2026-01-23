<?php

namespace KeihartOnline\JouwHoesjeApi\Enums;

enum VatNumberStatusEnum: string
{
    case SERVER_ERROR = 'server-error';
    case INCORRECT_FORMAT = 'incorrect-format';
    case INVALID = 'invalid';
    case VALID = 'valid';
}
