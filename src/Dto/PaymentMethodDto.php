<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class PaymentMethodDto
{
    public function __construct(
        public string $name,
        public string $image,
        public ?string $id = null,
        public bool $isPrimaryMethod = false,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            image: $data['image'] ?? '',
            id: $data['id'] ?? null,
            isPrimaryMethod: $data['is_primary_method'] ?? false,
        );
    }
}
