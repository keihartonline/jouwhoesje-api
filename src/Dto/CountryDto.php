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
        public bool $vat_deferral,
        public bool $show_additional_address_line,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            countryCode: $data['country_code'],
            name: $data['name'],
            flag: $data['flag'],
            vatRate: $data['vat_rate'],
            vat_deferral: $data['vat_deferral'],
            show_additional_address_line: $data['show_additional_address_line'],
        );
    }
}
