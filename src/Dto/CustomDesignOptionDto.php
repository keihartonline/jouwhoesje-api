<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class CustomDesignOptionDto
{
    public function __construct(
        public string $sku,
        public int $price,
        public string $name,
        public bool $hasVariants,
        public ?MediaDto $firstMedia = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            sku: $data['sku'],
            price: $data['price'],
            name: $data['name'],
            hasVariants: $data['has_variants'] ?? false,
            firstMedia: ! blank($data['first_media'])
                ? MediaDto::fromArray($data['first_media'])
                : null,
        );
    }
}
