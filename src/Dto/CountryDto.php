<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class CountryDto
{
    public function __construct(
        public string $countryCode,
        public string $name,
        public string $nameWithFlag,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            countryCode: $data['country_code'],
            name: $data['name'],
            nameWithFlag: $data['name_with_flag'],
        );
    }
}
