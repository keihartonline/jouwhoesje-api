<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class OrderItemDto
{
    public function __construct(
        public int $quantity,
        public int $unitPriceGross,
        public int $unitPriceNet,
        public int $lineTotalGross,
        public int $lineTotalNet,
        public int $lineTotalVat,
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
            unitPriceNet: (int) ($data['unit_price_net'] ?? 0),
            lineTotalGross: (int) ($data['line_total_gross'] ?? 0),
            lineTotalNet: (int) ($data['line_total_net'] ?? 0),
            lineTotalVat: (int) ($data['line_total_vat'] ?? 0),
            articleNumber: $data['article_number'] ?? null,
            name: $data['name'] ?? null,
            isChild: (bool) ($data['is_child'] ?? false),
            buyable: BuyableDto::fromArray($data['buyable']),
        );
    }
}
