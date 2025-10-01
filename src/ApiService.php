<?php

namespace KeihartOnline\JouwHoesjeApi;

use Illuminate\Support\Facades\Cache;
use KeihartOnline\JouwHoesjeApi\Dto\BrandDto;
use KeihartOnline\JouwHoesjeApi\Dto\CoverDto;
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
    public function getBrands(
        ?int $devicesLimit = null,
        ?bool $withImage = null,
    ): array {
        $response = $this->client->get('/brands', array_filter([
            'devices_limit' => $devicesLimit,
            'with_image' => $withImage,
        ]));

        if ($response->successful()) {
            return array_map(
                fn (array $brandData) => BrandDto::fromArray($brandData),
                $response->json()['data']
            );
        }

        throw new ApiException('Geen merken gevonden.');
    }

    /**
     * @throws ApiException
     * @throws Throwable
     */
    public function getBrand(
        string $slug,
        ?int $devicesLimit = null,
        ?bool $withImage = null,
    ): BrandDto {
        $response = $this->client->get('/brands/'.$slug, array_filter([
            'devices_limit' => $devicesLimit,
            'with_image' => $withImage,
        ]));

        if ($response->successful()) {
            return BrandDto::fromArray($response->json()['data']);
        }

        throw new ApiException('Geen geldig merk gevonden.');
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

    /**
     * @throws ApiException
     * @throws Throwable
     */
    public function getCover(string $slug): CoverDto
    {
        $response = $this->client->get('/covers/'.$slug);

        if ($response->successful()) {
            return CoverDto::fromArray($response->json()['data']);
        }

        throw new ApiException('Geen geldige cover gevonden.');
    }
}
