<?php

namespace KeihartOnline\JouwHoesjeApi\Enums;

enum ProductStatusEnum: string
{
    case ANNOUNCED = 'announced';
    case PRELAUNCHED = 'prelaunched';
    case LAUNCHED = 'launched';
    case SUNSETTED = 'sunsetted';
    case ENDED = 'ended';
    case ARCHIVED = 'archived';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::ANNOUNCED => 'Aangekondigd',
            self::PRELAUNCHED => 'Pre-bestelbaar',
            self::LAUNCHED => 'Live',
            self::SUNSETTED => 'Binnenkort offline',
            self::ENDED => 'Niet meer beschikbaar',
            self::ARCHIVED => 'Gearchiveerd',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(
            fn ($item) => [$item->value => self::getLabel($item)]
        )->toArray();
    }

    public static function presentableStatuses(): array
    {
        return [
            self::PRELAUNCHED,
            self::LAUNCHED,
            self::SUNSETTED,
        ];
    }

    public static function sellableStatuses(): array
    {
        return [
            self::LAUNCHED,
            self::SUNSETTED,
        ];
    }
}