<?php

namespace KeihartOnline\JouwHoesjeApi\Enums;

enum ReturnRequestStatusEnum: string
{
    case CREATED = 'created';
    case IN_TRANSIT = 'in-transit';
    case RECEIVED = 'received';
    case PROCESSED = 'processed';


    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::CREATED => 'Aangemaakt',
            self::IN_TRANSIT => 'Onderweg',
            self::RECEIVED => 'Ontvangen',
            self::PROCESSED => 'Verwerkt',
        };
    }
}
