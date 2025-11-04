<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use Illuminate\Support\Carbon;

final readonly class CartDto
{
    public function __construct(
        public string $cartToken,
        public int $quantity,
        public int $totalWeight,
        public int $totalPriceNet,
        public int $totalPriceGross,
        public int $vat,
        public Carbon $createdAt,
        public Carbon $updatedAt,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            cartToken: $data['cart_token'],
            quantity: (int) ($data['quantity'] ?? 0),
            totalWeight: (int) ($data['total_weight'] ?? 0),
            totalPriceNet: (int) ($data['total_price_net'] ?? 0),
            totalPriceGross: (int) ($data['total_price_gross'] ?? 0),
            vat: (int) ($data['vat'] ?? 0),
            createdAt: Carbon::parse($data['created_at']),
            updatedAt: Carbon::parse($data['updated_at']),
        );
    }
}