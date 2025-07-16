<?php

namespace KeihartOnline\JouwHoesjeApi;

use KeihartOnline\JouwHoesjeApi\Dto\BrandDto;
use KeihartOnline\JouwHoesjeApi\Dto\ShopDto;
use KeihartOnline\JouwHoesjeApi\Exceptions\ApiException;
use Throwable;

readonly class ApiService
{
    public function __construct(private ApiClient $client) {}

    /**
     * @throws ApiException
     * @throws Throwable
     */
    public function getShop(): ShopDto
    {
        $response = $this->client->get('/shop');

        if ($response->successful()) {
            return ShopDto::fromResponse($response->json());
        }

        throw new ApiException('Geen geldige shop gevonden.');
    }

    /**
     * @return BrandDto[]
     * @throws ApiException
     * @throws Throwable
     */
    public function getBrands(): array
    {
        $response = $this->client->get('/brands');

        if ($response->successful()) {
            return array_map(
                fn (array $brandData) => BrandDto::fromResponse($brandData),
                $response->json()
            );
        }

        throw new ApiException('Geen geldige shop gevonden.');
    }
}
