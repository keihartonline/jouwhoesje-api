<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use Illuminate\Support\Carbon;

final readonly class CartDto
{
    public function __construct(
        public string $cartToken,
        public int $totalQty,
        public int $totalWeight,
        public int $vatRate,
        public int $itemTotal,
        public int $vatTotal,
        public int $shippingTotal,
        public int $grandTotalWithoutVat,
        public int $grandTotal,
        public Carbon $createdAt,
        public Carbon $updatedAt,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            cartToken: $data['cart_token'],
            totalQty: (int) ($data['total_qty'] ?? 0),
            totalWeight: (int) ($data['total_weight'] ?? 0),
            vatRate: (int) ($data['vat_rate'] ?? 0),
            itemTotal: (int) ($data['item_total'] ?? 0),
            vatTotal: (int) ($data['vat_total'] ?? 0),
            shippingTotal: (int) ($data['shipping_total'] ?? 0),
            grandTotalWithoutVat: (int) ($data['grand_total_without_vat'] ?? 0),
            grandTotal: (int) ($data['grand_total'] ?? 0),
            createdAt: Carbon::parse($data['created_at']),
            updatedAt: Carbon::parse($data['updated_at']),
        );
    }
}
