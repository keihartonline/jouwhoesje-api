<?php

namespace KeihartOnline\JouwHoesjeApi\Enums;

enum PrintSideEnum: string
{
    case BACK_PRINTED = 'back-printed';
    case FRONT_PRINTED = 'front-printed';
    case FULLY_PRINTED = 'fully-printed';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::BACK_PRINTED => 'Achterkant bedrukt',
            self::FRONT_PRINTED => 'Voorkant bedrukt',
            self::FULLY_PRINTED => 'Volledig bedrukt',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(
            fn ($item) => [$item->value => self::getLabel($item)]
        )->toArray();
    }
}
