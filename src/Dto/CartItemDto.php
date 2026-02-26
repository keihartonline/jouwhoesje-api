<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use Illuminate\Support\Carbon;

final readonly class CartItemDto
{
    public function __construct(
        public string $cartItemToken,
        public int $quantity,
        public int $unitPriceGross,
        public int $lineTotalGross,
        public int $lineTotalNet,
        public int $lineTotalVat,
        public ?int $giftPackagingId,
        public int $giftPackagingTotalGross,
        public int $giftPackagingTotalNet,
        public int $giftPackagingTotalVat,
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
            lineTotalGross: (int) ($data['line_total_gross'] ?? 0),
            lineTotalNet: (int) ($data['line_total_net'] ?? 0),
            lineTotalVat: (int) ($data['line_total_vat'] ?? 0),
            giftPackagingId: $data['gift_packaging_id'] ?? null,
            giftPackagingTotalGross: (int) ($data['gift_packaging_total_gross'] ?? 0),
            giftPackagingTotalNet: (int) ($data['gift_packaging_total_net'] ?? 0),
            giftPackagingTotalVat: (int) ($data['gift_packaging_total_vat'] ?? 0),
            buyable: BuyableDto::fromArray($data['buyable']),
            createdAt: Carbon::parse($data['created_at']),
            updatedAt: Carbon::parse($data['updated_at']),
        );
    }
}
