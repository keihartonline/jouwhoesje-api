<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class ShopDto
{
    public function __construct(
        public int $shopId,
        public string $name,
        public string $nameWithTld,
        public string $slug,
        public string $fqdn,
        public string $locale,
        public string $countryCode,
        public int $minimumOrderValue,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            shopId: $data['shop_id'],
            name: $data['name'],
            nameWithTld: $data['name_with_tld'],
            slug: $data['slug'],
            fqdn: $data['fqdn'],
            locale: $data['locale'],
            countryCode: $data['country_code'],
            minimumOrderValue: $data['minimum_order_value'],
        );
    }
}
