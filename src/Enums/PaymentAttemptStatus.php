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
    case NEEDS_REVIEW = 'needs-review';

    public function isFinal(): bool
    {
        return in_array($this, [
            self::PAID,
            self::FAILED,
            self::CANCELLED,
            self::EXPIRED,
            self::ABANDONED,
            self::NEEDS_REVIEW
        ]);
    }

    public function shouldUnlockCart(): bool
    {
        return in_array($this, [
            self::FAILED,
            self::CANCELLED,
            self::EXPIRED,
            self::ABANDONED,
        ]);
    }
}
