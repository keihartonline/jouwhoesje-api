<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use Illuminate\Support\Carbon;

final readonly class CartItemDto
{
    public function __construct(
        public string $cartItemToken,
        public int $quantity,
        public int $priceGross,
        public int $priceNet,
        public int $totalPriceGross,
        public int $totalPriceNet,
        public int $totalVat,
        public array $media = [],
        public Carbon $createdAt,
        public Carbon $updatedAt,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            cartItemToken: $data['cart_item_token'],
            quantity: (int) ($data['quantity'] ?? 0),
            priceGross: (int) ($data['price_gross'] ?? 0),
            priceNet: (int) ($data['price_net'] ?? 0),
            totalPriceGross: (int) ($data['total_price_gross'] ?? 0),
            totalPriceNet: (int) ($data['total_price_net'] ?? 0),
            totalVat: (int) ($data['total_vat'] ?? 0),
            media: $data['media'] ?? [],
            createdAt: Carbon::parse($data['created_at']),
            updatedAt: Carbon::parse($data['updated_at']),
        );
    }
}
