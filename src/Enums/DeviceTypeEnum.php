<?php

namespace KeihartOnline\JouwHoesjeApi\Enums;

enum DeviceTypeEnum: string
{
    case IPAD = 'ipad';
    case MACBOOK = 'macbook';
    case PHONE = 'phone';

    case AIRPODS = 'airpods';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::IPAD => 'iPad',
            self::MACBOOK => 'MacBook',
            self::PHONE => 'telefoon',
            self::AIRPODS => 'AirPods',
        };
    }
}
