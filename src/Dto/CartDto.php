<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use Illuminate\Support\Carbon;

final readonly class CartDto
{
    /**
     * @param  CartItemDto[]  $items
     */
    public function __construct(
        public string $cartToken,
        public int $totalQuantity,
        public int $totalPriceGross,
        public int $totalPriceNet,
        public int $totalGiftPackagingGross,
        public int $totalGiftPackagingNet,
        public int $totalVat,
        public int $minimumOrderValue,
        public array $items,
        public array $messages,
        public Carbon $createdAt,
        public Carbon $updatedAt,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            cartToken: $data['cart_token'],
            totalQuantity: (int) ($data['total_quantity'] ?? 0),
            totalPriceGross: (int) ($data['total_price_gross'] ?? 0),
            totalPriceNet: (int) ($data['total_price_net'] ?? 0),
            totalGiftPackagingGross: (int) ($data['total_gift_packaging_gross'] ?? 0),
            totalGiftPackagingNet: (int) ($data['total_gift_packaging_net'] ?? 0),
            totalVat: (int) ($data['total_vat'] ?? 0),
            minimumOrderValue: (int) ($data['minimum_order_value'] ?? 0),
            items: array_map(
                fn (array $itemData) => CartItemDto::fromArray($itemData),
                $data['items'] ?? []
            ),
            messages: array_map(
                fn (array $messageData) => CartMessageDto::fromArray($messageData),
                $data['messages'] ?? []
            ),
            createdAt: Carbon::parse($data['created_at']),
            updatedAt: Carbon::parse($data['updated_at']),
        );
    }
}
