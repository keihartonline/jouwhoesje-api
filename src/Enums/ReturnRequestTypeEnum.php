<?php

namespace KeihartOnline\JouwHoesjeApi\Enums;

enum ReturnRequestTypeEnum: string
{
    case RETURN = 'return';
    case COULANCE = 'coulance';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::RETURN => 'Retouraanvraag',
            self::COULANCE => 'Coulanceverzoek',
        };
    }
}
