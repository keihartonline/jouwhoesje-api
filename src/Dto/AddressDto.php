<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class AddressDto
{
    public function __construct(
        public ?string $name,
        public ?string $street,
        public ?string $houseNumber,
        public ?string $houseNumberAddition,
        public ?string $addressLine1,
        public ?string $addressLine2,
        public ?string $zipcode,
        public ?string $city,
        public int $countryId,
        public CountryDto $country,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'] ?? null,
            street: $data['street'] ?? null,
            houseNumber: $data['house_number'] ?? null,
            houseNumberAddition: $data['house_number_addition'] ?? null,
            addressLine1: $data['address_line_1'] ?? null,
            addressLine2: $data['address_line_2'] ?? null,
            zipcode: $data['zipcode'] ?? null,
            city: $data['city'] ?? null,
            countryId: $data['country_id'],
            country: CountryDto::fromArray($data['country']),
        );
    }
}
