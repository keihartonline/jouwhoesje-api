<?php

namespace KeihartOnline\JouwHoesjeApi\Enums;

enum StockStatusEnum: string
{
    case IN_STOCK = 'in-stock';
    case LOW_STOCK = 'low-stock';
    case OUT_OF_STOCK = 'out-of-stock';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::IN_STOCK => 'Op voorraad',
            self::LOW_STOCK => 'Beperkte voorraad',
            self::OUT_OF_STOCK => 'Niet op voorraad',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(
            fn ($item) => [$item->value => self::getLabel($item)]
        )->toArray();
    }
}
