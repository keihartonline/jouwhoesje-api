<?php

namespace KeihartOnline\JouwHoesjeApi;

use Illuminate\Support\Facades\Cache;
use KeihartOnline\JouwHoesjeApi\Dto\BrandDto;
use KeihartOnline\JouwHoesjeApi\Dto\DeviceDto;
use KeihartOnline\JouwHoesjeApi\Dto\ShopDto;
use KeihartOnline\JouwHoesjeApi\Exceptions\ApiException;
use Throwable;

readonly class ApiService
{
    public function __construct(private ApiClient $client) {}

    /**
     * @throws Throwable
     */
    public function getShop(): ShopDto
    {
        return Cache::driver('array')
            ->rememberForever(
                'jouw-hoesje-api:shop',
                function () {
                    $response = $this->client->get('/shop');

                    if ($response->successful()) {
                        return ShopDto::fromArray($response->json()['data']);
                    }

                    throw new ApiException('Geen geldige shop gevonden.');
                }
            );
    }

    /**
     * @return BrandDto[]
     *
     * @throws ApiException
     * @throws Throwable
     */
    public function getBrands(): array
    {
        $response = $this->client->get('/brands');

        if ($response->successful()) {
            return array_map(
                fn (array $brandData) => BrandDto::fromArray($brandData),
                $response->json()['data']
            );
        }

        throw new ApiException('Geen geldige shop gevonden.');
    }

    /**
     * @throws ApiException
     * @throws Throwable
     */
    public function getBrand(string $slug): BrandDto
    {
        $response = $this->client->get('/brands/'.$slug);

        if ($response->successful()) {
            return BrandDto::fromArray($response->json()['data']);
        }

        throw new ApiException('Geen geldige shop gevonden.');
    }

    /**
     * @throws ApiException
     * @throws Throwable
     */
    public function getDevice(string $slug): DeviceDto
    {
        $response = $this->client->get('/devices/'.$slug);

        if ($response->successful()) {
            return DeviceDto::fromArray($response->json()['data']);
        }

        throw new ApiException('Geen geldige shop gevonden.');
    }
}
