<?php

namespace KeihartOnline\JouwHoesjeApi\Enums;

enum PaymentAttemptStatus: string
{
    case CREATED = 'created';
    case PENDING = 'pending';
    case PAID = 'paid';
    case FAILED = 'failed';
    case CANCELLED = 'cancelled';
    case EXPIRED = 'expired';
    case ABANDONED = 'abandoned';
    case INITIAL_FAIL = 'initial-fail';

    public function isFinal(): bool
    {
        return in_array($this, [
            self::PAID,
            self::FAILED,
            self::CANCELLED,
            self::EXPIRED,
            self::ABANDONED,
            self::INITIAL_FAIL
        ]);
    }

    public function isFinalNegative(): bool
    {
        return in_array($this, [
            self::FAILED,
            self::CANCELLED,
            self::EXPIRED,
            self::ABANDONED,
            self::INITIAL_FAIL
        ]);
    }
}
