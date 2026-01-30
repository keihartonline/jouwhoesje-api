<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use KeihartOnline\JouwHoesjeApi\Enums\PaymentAttemptStatus;

final readonly class PaymentAttemptDto
{
    public function __construct(
        public PaymentAttemptStatus $status,
        public ?string $redirectUrl,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            status: PaymentAttemptStatus::from($data['status']),
            redirectUrl: $data['redirect_url'],
        );
    }
}
