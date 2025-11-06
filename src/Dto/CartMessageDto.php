<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use Illuminate\Support\Carbon;
use KeihartOnline\JouwHoesjeApi\Enums\CartMessageTypeEnum;
use KeihartOnline\JouwHoesjeApi\Enums\ProductTypeEnum;

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
            subject: $data['subject'],
        );
    }
}
