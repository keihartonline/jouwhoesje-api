<?php

namespace KeihartOnline\JouwHoesjeApi\Enums;

enum PrintSideEnum: string
{
    case BACK_PRINTED = 'back-printed';
    case FRONT_PRINTED = 'front-printed';
    case FULLY_PRINTED = 'fully-printed';
}
