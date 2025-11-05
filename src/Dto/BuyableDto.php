<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class BuyableDto
{
    public function __construct(
        public ?array $media,
        public string $name,
        public ?string $slug,
        public int $stock,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            media: $data['media'],
            name: $data['name'],
            slug: $data['slug'],
            stock: $data['stock'],
        );
    }
}
