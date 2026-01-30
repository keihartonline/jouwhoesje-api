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
}
