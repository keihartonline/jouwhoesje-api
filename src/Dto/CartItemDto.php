<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use Illuminate\Support\Carbon;
use KeihartOnline\JouwHoesjeApi\Enums\ProductTypeEnum;

final readonly class CartItemDto
{
    public function __construct(
        public string $cartItemToken,
        public int $quantity,
        public ProductTypeEnum $productType,
        public int $priceGross,
        public int $priceNet,
        public int $totalPriceGross,
        public int $totalPriceNet,
        public int $totalVat,
        public BuyableDto $buyable,
        public Carbon $createdAt,
        public Carbon $updatedAt,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            cartItemToken: $data['cart_item_token'],
            quantity: (int) ($data['quantity'] ?? 0),
            productType: ProductTypeEnum::from($data['product_type']),
            priceGross: (int) ($data['price_gross'] ?? 0),
            priceNet: (int) ($data['price_net'] ?? 0),
            totalPriceGross: (int) ($data['total_price_gross'] ?? 0),
            totalPriceNet: (int) ($data['total_price_net'] ?? 0),
            totalVat: (int) ($data['total_vat'] ?? 0),
            buyable: BuyableDto::fromArray($data['buyable']),
            createdAt: Carbon::parse($data['created_at']),
            updatedAt: Carbon::parse($data['updated_at']),
        );
    }
}
