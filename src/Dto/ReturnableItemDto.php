<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class ReturnableItemDto
{
    public function __construct(
        public int $quantity,
        public int $unitPriceGross,
        public int $unitPriceNet,
        public string $articleNumber,
        public string $name,
        public MediaDto $firstMedia,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            quantity: (int) ($data['quantity'] ?? 0),
            unitPriceGross: (int) ($data['unit_price_gross'] ?? 0),
            unitPriceNet: (int) ($data['unit_price_net'] ?? 0),
            articleNumber: $data['article_number'] ?? null,
            name: $data['name'] ?? null,
            firstMedia: MediaDto::fromArray($data['first_media']),
        );
    }
}
