<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class CountryDto
{
    public function __construct(
        public int $id,
        public string $countryCode,
        public string $name,
        public string $flag,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            countryCode: $data['country_code'],
            name: $data['name'],
            flag: $data['flag'],
        );
    }
}
