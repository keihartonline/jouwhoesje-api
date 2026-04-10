<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class CompanyDetailsDto
{
    public function __construct(
        public string $name,
        public string $address,
        public string $zipcode,
        public string $city,
        public string $country,
        public string $phoneNumber,
        public string $cocNumber,
        public string $vatId,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            address: $data['address'],
            zipcode: $data['zipcode'],
            city: $data['city'],
            country: $data['country'],
            phoneNumber: $data['phone_number'],
            cocNumber: $data['coc_number'],
            vatId: $data['vat_id'],
        );
    }
}
