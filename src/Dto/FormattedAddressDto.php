<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class FormattedAddressDto
{
    public function __construct(
        public ?string $name,
        public ?string $addressLine1,
        public ?string $addressLine2,
        public ?string $zipcode,
        public ?string $city,
        public ?string $countryName,
        public ?string $countryCode,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'] ?? null,
            addressLine1: $data['address_line_1'] ?? null,
            addressLine2: $data['address_line_1'] ?? null,
            zipcode: $data['zipcode'] ?? null,
            city: $data['city'] ?? null,
            countryName: $data['country_name'] ?? null,
            countryCode: $data['country_code'] ?? null,
        );
    }
}
