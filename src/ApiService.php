<?php

namespace App\Api;

use App\Api\DTO\Brand;
use App\Api\DTO\Shop;
use Illuminate\Support\Facades\Cache;

readonly class ApiService
{
    public function __construct(private ApiClient $client) {}

    public function getShop(): ?Shop
    {
        return Cache::remember(
            $this->getCacheKey('shop'),
            now()->addDay(),
            function () {
                $response = $this->client->get('/shop');

                if ($response->successful()) {
                    return Shop::fromResponse($response->json());
                }

                return null;
            }
        );
    }

    /**
     * @return Brand[]
     */
    public function getBrands(): array
    {
        return Cache::remember(
            $this->getCacheKey('brands'),
            now()->addWeek(),
            function () {
                $response = $this->client->get('/brands');

                if ($response->successful()) {
                    return array_map(
                        fn (array $brandData) => Brand::fromResponse($brandData),
                        $response->json()
                    );
                }

                return [];
            }
        );
    }

    private function getCacheKey(string $string): string
    {
        return sprintf(
            'api:%s_%s',
            $string,
            request()->getHost()
        );
    }
}
