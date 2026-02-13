<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class OrderItemDto
{
    public function __construct(
        public int $quantity,
        public int $unitPriceGross,
        public int $totalPriceGross,
        public string $articleNumber,
        public string $name,
        public bool $isChild,
        public BuyableDto $buyable,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            quantity: (int) ($data['quantity'] ?? 0),
            unitPriceGross: (int) ($data['unit_price_gross'] ?? 0),
            totalPriceGross: (int) ($data['total_price_gross'] ?? 0),
            articleNumber: $data['article_number'] ?? null,
            name: $data['name'] ?? null,
            isChild: (bool) ($data['is_child'] ?? false),
            buyable: BuyableDto::fromArray($data['buyable']),
        );
    }
}
