<?php

namespace KeihartOnline\JouwHoesjeApi\Enums;

enum InvoiceTypeEnum: string
{
    case INVOICE = 'invoice';
    case CREDIT_NOTE = 'credit-note';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::INVOICE => 'Factuur',
            self::CREDIT_NOTE => 'Creditnota',
        };
    }
}
