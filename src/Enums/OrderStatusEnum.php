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

    public function isMinimal(self $other): bool
    {
        return $this->rank() >= $other->rank();
    }

    private function rank(): int
    {
        return match ($this) {
            self::NEW => 0,
            self::SUBMITTED => 1,
            self::PROCESSING => 2,
            self::SHIPPED => 3,
        };
    }
}
