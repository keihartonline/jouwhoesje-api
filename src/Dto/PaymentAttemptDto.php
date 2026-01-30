<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class PaymentAttemptDto
{
    public function __construct(
        public string $redirectUrl,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            redirectUrl: $data['redirect_url'],
        );
    }
}
