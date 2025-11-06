<?php

namespace KeihartOnline\JouwHoesjeApi\Enums;

enum CartMessageTypeEnum: string
{
    case DELETED_UNSELLABLE = 'deleted-unsellable';
    case DELETED_NO_STOCK = 'deleted-no-stock';
    case UPDATED_STOCK = 'updated-stock';
    case UPDATED_PRICE = 'updated-price';
}