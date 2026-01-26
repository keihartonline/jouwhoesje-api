<?php

namespace KeihartOnline\JouwHoesjeApi\Enums;

enum CartMessageTypeEnum: string
{
    case DELETED_UNSELLABLE = 'deleted-unsellable';
    case DELETED_NO_STOCK = 'deleted-no-stock';
    case UPDATED_STOCK = 'updated-stock';
    case UPDATED_PRICE = 'updated-price';
    case GIFT_PACKAGING_NOT_AVAILABLE = 'gift-packaging-not-available';
    case VAT_NUMBER_NOT_MATCHING_COUNTRY = 'vat-number-not-matching-country';
}
