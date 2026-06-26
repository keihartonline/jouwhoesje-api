<?php

namespace KeihartOnline\JouwHoesjeApi\Enums;

enum DesignCollectionTypeEnum: string
{
    case SINGLE = 'single';
    case MULTIPLE = 'multiple';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::SINGLE => 'Enkelvoudig (1 design)',
            self::MULTIPLE => 'Meervoudig (meerdere designs)',
        };
    }
}
