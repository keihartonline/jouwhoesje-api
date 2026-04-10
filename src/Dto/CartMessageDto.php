<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use KeihartOnline\JouwHoesjeApi\Enums\CartMessageTypeEnum;

final readonly class CartMessageDto
{
    public function __construct(
        public CartMessageTypeEnum $cartMessageType,
        public ?string $subject,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            cartMessageType: CartMessageTypeEnum::from($data['cart_message_type']),
            subject: $data['subject'] ?? null,
        );
    }
}
