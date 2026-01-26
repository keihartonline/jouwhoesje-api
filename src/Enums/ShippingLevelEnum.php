<?php

namespace KeihartOnline\JouwHoesjeApi\Enums;

enum ShippingLevelEnum: string
{
    case NORMAL = 'normal';
    case TRACKED = 'tracked';
    case PREMIUM = 'premium';

    public function hasTracking(): bool
    {
        return self::getHasTracking($this);
    }

    public static function getHasTracking(self $value): bool
    {
        return $value !== self::NORMAL;
    }
}
