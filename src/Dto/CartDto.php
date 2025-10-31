<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use Illuminate\Support\Carbon;

final readonly class CartDto
{
    public function __construct(
        public string $cartToken,
        public Carbon $createdAt,
        public Carbon $updatedAt,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            cartToken: $data['cart_token'],
            createdAt: Carbon::parse($data['created_at']),
            updatedAt: Carbon::parse($data['updated_at']),
        );
    }
}
