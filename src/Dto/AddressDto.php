<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class AddressDto
{
    public function __construct(
        public CountryDto $country,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            country: CountryDto::fromArray($data['country']),
        );
    }
}
