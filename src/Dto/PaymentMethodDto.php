<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class PaymentMethodDto
{
    public function __construct(
        public string $name,
        public string $image,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            image: $data['image'],
        );
    }
}
