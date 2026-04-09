<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class ShopDto
{
    /**
     * @param  PaymentMethodDto[]  $paymentMethods
     * @param  CountryDto[]  $countries
     * @param  HostnameDto[]  $hostnames
     */
    public function __construct(
        public int $shopId,
        public string $name,
        public string $nameWithTld,
        public string $slug,
        public string $fqdn,
        public string $locale,
        public string $countryCode,
        public string $dialCode,
        public int $returnDays,
        public int $returnPrice,
        public string $cutoffTime,
        public CountryDto $country,
        public array $paymentMethods = [],
        public array $countries = [],
        public array $hostnames = []
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
            dialCode: $data['dial_code'],
            returnDays: $data['return_days'],
            returnPrice: $data['return_price'],
            cutoffTime: $data['cutoff_time'],
            country: CountryDto::fromArray($data['country']),
            paymentMethods: array_map(
                fn (array $paymentMethod) => PaymentMethodDto::fromArray($paymentMethod),
                $data['payment_methods']
            ),
            countries: (function () use ($data) {
                $countries = array_map(
                    fn (array $countryData) => CountryDto::fromArray($countryData),
                    $data['countries']
                );
                usort($countries, fn ($a, $b) => $a->name <=> $b->name);

                return $countries;
            })(),
            hostnames: array_map(
                fn (array $hostnameData) => HostnameDto::fromArray($hostnameData),
                $data['hostnames'] ?? []
            )
        );
    }
}
