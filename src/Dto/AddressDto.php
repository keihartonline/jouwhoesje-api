<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class AddressDto
{
    /**
     * @param  string[]  $invalidFields
     */
    public function __construct(
        public ?string $name,
        public ?string $street,
        public ?string $houseNumber,
        public ?string $houseNumberAddition,
        public ?string $address,
        public ?string $addressAdditional,
        public ?string $zipcode,
        public ?string $city,
        public int $countryId,
        public string $formatted,
        public array $invalidFields,
        public CountryDto $country,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'] ?? null,
            street: $data['street'] ?? null,
            houseNumber: $data['house_number'] ?? null,
            houseNumberAddition: $data['house_number_addition'] ?? null,
            address: $data['address'] ?? null,
            addressAdditional: $data['address_additional'] ?? null,
            zipcode: $data['zipcode'] ?? null,
            city: $data['city'] ?? null,
            countryId: $data['country_id'],
            formatted: $data['formatted'],
            invalidFields: $data['invalid_fields'] ?? [],
            country: CountryDto::fromArray($data['country']),
        );
    }
}
