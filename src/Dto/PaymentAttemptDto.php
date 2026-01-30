<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use KeihartOnline\JouwHoesjeApi\Enums\PaymentAttemptStatus;

final readonly class PaymentAttemptDto
{
    public function __construct(
        public string $redirectUrl,
        public PaymentAttemptStatus $status,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            redirectUrl: $data['redirect_url'],
            status: PaymentAttemptStatus::from($data['status']),
        );
    }
}
