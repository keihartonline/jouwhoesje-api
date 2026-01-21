<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class CountryDto
{
    public function __construct(
        public int $id,
        public string $countryCode,
        public string $name,
        public string $flag,
        public int $vatRate,
        public bool $vatDeferral,
        public bool $splitAddress,
        public bool $showAddressAdditional,
        public bool $showHouseNumberAdditional,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            countryCode: $data['country_code'],
            name: $data['name'],
            flag: $data['flag'],
            vatRate: $data['vat_rate'],
            vatDeferral: $data['vat_deferral'],
            splitAddress: $data['split_address'],
            showAddressAdditional: $data['show_address_additional'],
            showHouseNumberAdditional: $data['show_house_number_additional'],
        );
    }
}
