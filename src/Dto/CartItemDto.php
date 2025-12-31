<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use Illuminate\Support\Carbon;

final readonly class CartItemDto
{
    public function __construct(
        public string $cartItemToken,
        public int $quantity,
        public int $unitPriceGross,
        public int $unitPriceNet,
        public int $unitVat,
        public int $totalPriceGross,
        public int $totalPriceNet,
        public int $totalVat,
        public ?int $giftPackagingId,
        public BuyableDto $buyable,
        public Carbon $createdAt,
        public Carbon $updatedAt,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            cartItemToken: $data['cart_item_token'],
            quantity: (int) ($data['quantity'] ?? 0),
            unitPriceGross: (int) ($data['unit_price_gross'] ?? 0),
            unitPriceNet: (int) ($data['unit_price_net'] ?? 0),
            unitVat: (int) ($data['unit_vat'] ?? 0),
            totalPriceGross: (int) ($data['total_price_gross'] ?? 0),
            totalPriceNet: (int) ($data['total_price_net'] ?? 0),
            totalVat: (int) ($data['total_vat'] ?? 0),
            giftPackagingId: $data['gift_packaging_id'] ?? null,
            buyable: BuyableDto::fromArray($data['buyable']),
            createdAt: Carbon::parse($data['created_at']),
            updatedAt: Carbon::parse($data['updated_at']),
        );
    }
}
