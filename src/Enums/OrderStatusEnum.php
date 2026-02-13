<?php

namespace KeihartOnline\JouwHoesjeApi\Enums;

enum OrderStatusEnum: string
{
    case NEW = 'new';
    case SUBMITTED = 'submitted';
    case PROCESSING = 'processing';
    case SHIPPED = 'shipped';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::NEW => 'Nieuw',
            self::SUBMITTED => 'Overgedragen',
            self::PROCESSING => 'In behandeling',
            self::SHIPPED => 'Verzonden',
        };
    }

    public function isMinimal(self $enum): bool
    {
        $cases = self::cases();

        $thisIndex = array_search($this, $cases, true);
        $enumIndex = array_search($enum, $cases, true);

        if ($thisIndex === false || $enumIndex === false) {
            return false;
        }

        return $thisIndex <= $enumIndex;
    }

}
