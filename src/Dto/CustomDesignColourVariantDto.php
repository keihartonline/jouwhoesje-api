<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class CustomDesignColourVariantDto
{
    public function __construct(
        public string $name,
        public string $reference,
        public string $sku,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            reference: $data['reference'],
            sku: $data['sku'],
        );
    }
}
