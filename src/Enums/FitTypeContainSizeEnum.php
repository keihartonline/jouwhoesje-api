<?php

namespace KeihartOnline\JouwHoesjeApi\Enums;

enum FitTypeContainSizeEnum: string
{
    case SMALL = 'small';
    case LARGER = 'larger';
    case LARGEST = 'largest';

    public function scale(): float
    {
        return match ($this) {
            self::SMALL => 0.6,
            self::LARGER => 0.8,
            self::LARGEST => 1,
        };
    }
}
