<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class CreatedCustomDesignDto
{
    public function __construct(
        public string $cartToken,
        public string $customDesignToken,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            cartToken: $data['cart_token'],
            customDesignToken: $data['custom_design_token'],
        );
    }
}
