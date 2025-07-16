<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

class ShopDto
{
    public int $shopId;

    public string $name;

    public string $nameWithTld;

    public string $slug;

    public string $fqdn;

    public string $locale;

    public string $countryCode;

    /**
     * @param  array<string, mixed>  $data
     */
    public function __construct(array $data)
    {
        $this->shopId = $data['shop_id'];
        $this->name = $data['name'];
        $this->nameWithTld = $data['name_with_tld'];
        $this->slug = $data['slug'];
        $this->fqdn = $data['fqdn'];
        $this->locale = $data['locale'];
        $this->countryCode = $data['country_code'];
    }

    /**
     * @param  array<string, mixed>  $response
     */
    public static function fromResponse(array $response): self
    {
        return new self($response);
    }
}
