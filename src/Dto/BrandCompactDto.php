<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class BrandCompactDto
{
    public function __construct(
        public string $name,
        public string $slug,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            slug: $data['slug'],
        );
    }
}
