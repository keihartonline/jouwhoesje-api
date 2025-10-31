<?php

namespace KeihartOnline\JouwHoesjeApi;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use KeihartOnline\JouwHoesjeApi\Dto\BrandDto;
use KeihartOnline\JouwHoesjeApi\Dto\CartDto;
use KeihartOnline\JouwHoesjeApi\Dto\CoverCompactDto;
use KeihartOnline\JouwHoesjeApi\Dto\CoverDto;
use KeihartOnline\JouwHoesjeApi\Dto\DeviceDto;
use KeihartOnline\JouwHoesjeApi\Dto\FilterDto;
use KeihartOnline\JouwHoesjeApi\Dto\ShopDto;
use KeihartOnline\JouwHoesjeApi\Exceptions\ApiException;
use Throwable;

readonly class ApiService
{
    public function __construct(
        private ApiClient $client,
        Request $request,
    ) {
        $this->client->setCartToken($request->cookie('cart_token'));
    }

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
                fn (array $record) => BrandDto::fromArray($record),
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
     * @return DeviceDto[]
     *
     * @throws ApiException
     * @throws Throwable
     */
    public function getDevices(
        string $query,
        int $limit = 10,
    ): array {
        $query = array_filter([
            'query' => $query,
            'limit' => $limit,
        ]);

        $response = $this->client->get('/devices', $query);

        if (! $response->successful()) {
            throw new ApiException('Devices ophalen mislukte.');
        }

        $payload = $response->json();

        return array_map(
            fn (array $record) => DeviceDto::fromArray($record),
            $payload['data'] ?? []
        );
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
    public function getCovers(
        int $perPage = 15,
        ?int $page = null,
        array $filters = [],
    ): LengthAwarePaginator {
        $query = array_filter([
            'per_page' => $perPage,
            'page' => $page,
            'filters' => $filters,
        ]);

        $response = $this->client->get('/covers', $query);

        if (! $response->successful()) {
            throw new ApiException('Covers ophalen mislukte.');
        }

        $payload = $response->json();
        $items = array_map(
            fn (array $record) => CoverCompactDto::fromArray($record),
            $payload['data'] ?? []
        );

        $currentPage = data_get($payload, 'meta.current_page', $page ?? 1);
        $perPage = (int) data_get($payload, 'meta.per_page', $perPage);
        $total = (int) data_get($payload, 'meta.total', count($items));

        return new LengthAwarePaginator(
            items: $items,
            total: $total,
            perPage: $perPage,
            currentPage: $currentPage,
        );
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

    /**
     * @return FilterDto[]
     *
     * @throws ApiException
     * @throws Throwable
     */
    public function getFilters(
        string $brand,
        ?string $device = null,
    ): array {
        $response = $this->client->get('/filters', array_filter([
            'brand' => $brand,
            'device' => $device,
        ]));

        if ($response->successful()) {
            return array_map(
                fn (array $record) => FilterDto::fromArray($record),
                $response->json()['data']
            );
        }

        throw new ApiException('Geen filters gevonden.');
    }

    /**
     * @throws ApiException
     * @throws Throwable
     */
    public function getCart(bool $recalculate = false): CartDto
    {
        $response = $this->client->get('/cart', [
            'recalculate' => $recalculate,
        ]);

        if ($response->successful()) {
            return CartDto::fromArray($response->json()['data']);
        }

        throw new ApiException('Geen cart teruggegeven.');
    }
}
