<?php

namespace KeihartOnline\JouwHoesjeApi\Enums;

enum ReturnRequestStatusEnum: string
{
    case PENDING = 'pending';
    case CANCELLED = 'cancelled';
    case REJECTED = 'rejected';
    case APPROVED = 'approved';
    case RECEIVED = 'received';
    case REFUNDED = 'refunded';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::PENDING => 'Aangemeld',
            self::CANCELLED => 'Geannuleerd',
            self::REJECTED => 'Afgewezen',
            self::APPROVED => 'Goedgekeurd',
            self::RECEIVED => 'Ontvangen',
            self::REFUNDED => 'Terugbetaald',
        };
    }
}
