<?php

namespace KeihartOnline\JouwHoesjeApi\Enums;

enum PaymentAttemptPhase: string
{
    case VERIFYING = 'verifying';
    case OPEN = 'open';
    case PROCESSING = 'processing';
}
