<?php

namespace KeihartOnline\JouwHoesjeApi\Enums;

enum CustomDesignWarningTextEnum: string
{
    case HAS_BLEED_EDGES = 'has-bleed-edges';
    case HAS_MAGNETIC_CLASP = 'has-magnettic-clasp';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::HAS_BLEED_EDGES => 'Ontwerp gaat over de randen',
            self::HAS_MAGNETIC_CLASP => 'Ontwerp gaat over de magneetsluiting',
        };
    }
}
