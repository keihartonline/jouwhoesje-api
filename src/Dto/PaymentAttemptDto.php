<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use KeihartOnline\JouwHoesjeApi\Enums\PaymentAttemptStatus;

final readonly class PaymentAttemptDto
{
    public function __construct(
        public string $uuid,
        public PaymentAttemptStatus $status,
        public ?string $redirectUrl,
        public bool $canRetry,
        public int $retryInSeconds,
        public bool $hasOrder,
        public ?string $orderNumber,
        public ?string $email,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            uuid: $data['uuid'],
            status: PaymentAttemptStatus::from($data['status']),
            redirectUrl: $data['redirect_url'],
            canRetry: $data['can_retry'],
            retryInSeconds: $data['retry_in_seconds'],
            hasOrder: $data['has_order'],
            orderNumber: $data['order_number'] ?? null,
            email: $data['email'] ?? null,
        );
    }
}
