<?php

namespace KeihartOnline\JouwHoesjeApi\Enums;

enum ShippingLevelEnum: string
{
    case NORMAL = 'normal';
    case TRACKED = 'tracked';
    case PARCEL = 'parcel';
    case PREMIUM = 'premium';

    public function hasTracking(): bool
    {
        return self::getHasTracking($this);
    }

    public static function getHasTracking(self $value): bool
    {
        return $value !== self::NORMAL;
    }

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::NORMAL => 'Standaard briefpost',
            self::TRACKED => 'Bezorgd via brievenbus',
            self::PARCEL => 'Pakketpost aan de deur',
            self::PREMIUM => 'Express pakketdienst',
        };
    }

    public function trackingLabel(): string
    {
        return self::getTrackingLabel($this);
    }

    public static function getTrackingLabel(self $value): string
    {
        return match ($value) {
            self::NORMAL => 'Geen track & trace',
            self::TRACKED => 'Track & trace',
            self::PARCEL => 'Track & trace',
            self::PREMIUM => 'Volledige track & trace',
        };
    }
}
