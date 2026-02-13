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
        if ($this === $enum) {
            return true;
        }

        $foundSelf = false;

        foreach (self::cases() as $case) {
            if ($case === $this) {
                $foundSelf = true;
            }

            if ($case === $enum) {
                break;
            }
        }

        return $foundSelf;
    }
}
