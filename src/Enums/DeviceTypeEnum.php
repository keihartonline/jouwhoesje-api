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

    /**
     * Share (in hundredths) of the free express shipping threshold of 100 that
     * one item of this device type contributes.
     */
    public function expressCredit(): int
    {
        return self::getExpressCredit($this);
    }

    public static function getExpressCredit(self $value): int
    {
        return match ($value) {
            self::PHONE => 33,
            self::IPAD => 49,
            self::MACBOOK => 99,
            self::AIRPODS => 33,
        };
    }
}
