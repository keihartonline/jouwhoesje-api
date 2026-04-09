<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class HostnameDto
{
    public function __construct(
        public int $id,
        public string $locale,
        public string $language,
        public string $name,
        public string $flag,
        public string $fqdn,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            locale: $data['locale'],
            language: $data['language'],
            name: $data['name'],
            flag: $data['flag'],
            fqdn: $data['fqdn'],
        );
    }
}
