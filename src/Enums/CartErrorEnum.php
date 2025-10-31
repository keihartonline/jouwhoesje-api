<?php

namespace KeihartOnline\JouwHoesjeApi\Enums;

enum CartErrorEnum: string
{
    case PRODUCT_NOT_FOUND = 'product_not_found';
    case FILTER = 'filter';
}
