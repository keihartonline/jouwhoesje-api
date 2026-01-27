<?php

namespace KeihartOnline\JouwHoesjeApi\Enums;

enum CartErrorEnum: string
{
    case INCORRECT_EMAIL = 'incorrect-email';
    case MISSING_COMPANY_NAME = 'missing-company-name';
    case MISSING_SHIPPING_ADDRESS = 'missing-shipping-address';
    case INCORRECT_INVOICE_ADDRESS = 'incorrect-invoice-address';
    case INCORRECT_SHIPPING_ADDRESS = 'incorrect-shipping-address';
    case INCORRECT_SHIPPING_METHOD = 'incorrect-shipping-method';
}
