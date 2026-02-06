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
}
