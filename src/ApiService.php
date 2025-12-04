<?php

namespace KeihartOnline\JouwHoesjeApi;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use KeihartOnline\JouwHoesjeApi\Dto\BrandDto;
use KeihartOnline\JouwHoesjeApi\Dto\CartDto;
use KeihartOnline\JouwHoesjeApi\Dto\CreatedCustomDesignDto;
use KeihartOnline\JouwHoesjeApi\Dto\CustomDesignDto;
use KeihartOnline\JouwHoesjeApi\Dto\CustomDesignInfoDto;
use KeihartOnline\JouwHoesjeApi\Dto\DeviceDto;
use KeihartOnline\JouwHoesjeApi\Dto\FilterDto;
use KeihartOnline\JouwHoesjeApi\Dto\ResultCompactDto;
use KeihartOnline\JouwHoesjeApi\Dto\ResultDto;
use KeihartOnline\JouwHoesjeApi\Dto\ShopDto;
use KeihartOnline\JouwHoesjeApi\Dto\UploadDto;
use KeihartOnline\JouwHoesjeApi\Enums\FilterEnum;
use KeihartOnline\JouwHoesjeApi\Enums\ProductTypeEnum;
use KeihartOnline\JouwHoesjeApi\Exceptions\ApiException;
use KeihartOnline\JouwHoesjeApi\Exceptions\BuyableNotFoundException;
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
    public function getResults(
        int $perPage = 15,
        ?int $page = null,
        array $hardFilters = [],
        array $softFilters = [],
    ): LengthAwarePaginator {
        $query = array_filter([
            'per_page' => $perPage,
            'page' => $page,
            'hard_filters' => $hardFilters,
            'soft_filters' => $softFilters,
        ]);

        $response = $this->client->get('/results', $query);

        if (! $response->successful()) {
            throw new ApiException('Resultaten ophalen mislukte.');
        }

        $payload = $response->json();
        $items = array_map(
            fn (array $record) => ResultCompactDto::fromArray($record),
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
    public function getResult(string $slug): ResultDto
    {
        $response = $this->client->get('/results/'.$slug);

        if ($response->successful()) {
            return ResultDto::fromArray($response->json()['data']);
        }

        throw new ApiException('Geen geldige cover gevonden.');
    }

    /**
     * @param  FilterEnum[]  $filters
     * @return FilterDto[]
     *
     * @throws ApiException
     * @throws Throwable
     */
    public function getFilters(
        array $filters = [],
        array $hardFilters = [],
    ): array {
        $response = $this->client->get('/filters', array_filter([
            'filters' => $filters,
            'hard_filters' => $hardFilters,
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
    public function getCustomDesignInfo(string $slug): CustomDesignInfoDto
    {
        $response = $this->client->get('/custom-designs/info/'.$slug);

        if ($response->successful()) {
            return CustomDesignInfoDto::fromArray($response->json()['data']);
        }

        throw new ApiException(
            sprintf('Geen custom design info gevonden voor %s', $slug)
        );
    }

    /**
     * @throws ApiException
     * @throws Throwable
     */
    public function getCart(): CartDto
    {
        $response = $this->client->get('/cart');

        if ($response->successful()) {
            return CartDto::fromArray($response->json()['data']);
        }

        throw new ApiException('Geen cart teruggegeven.');
    }

    /**
     * @throws ApiException
     * @throws Throwable
     */
    public function addToCart(
        ProductTypeEnum $productType,
        string $articleNumber,
    ): CartDto {
        $response = $this->client
            ->throwError(false)
            ->post('/cart/add', [
                'product_type' => $productType,
                'article_number' => $articleNumber,
            ]);

        if ($response->status() === 404) {
            throw new BuyableNotFoundException;
        }

        if ($response->successful()) {
            return CartDto::fromArray($response->json()['data']);
        }

        throw new ApiException('Geen cart teruggegeven.');
    }

    /**
     * @throws ApiException
     * @throws Throwable
     */
    public function deleteFromCart(
        string $cartItemToken,
    ): CartDto {
        $response = $this->client
            ->post('/cart/delete', [
                'cart_item_token' => $cartItemToken,
            ]);

        if ($response->successful()) {
            return CartDto::fromArray($response->json()['data']);
        }

        throw new ApiException('Geen cart teruggegeven.');
    }

    /**
     * @throws ApiException
     * @throws Throwable
     */
    public function updateCartItem(
        string $cartItemToken,
        array $payload,
    ): CartDto {
        $response = $this->client
            ->post('/cart/update', [
                'cart_item_token' => $cartItemToken,
                ...$payload,
            ]);

        if ($response->successful()) {
            return CartDto::fromArray($response->json()['data']);
        }

        throw new ApiException('Geen cart teruggegeven.');
    }

    /**
     * @throws ApiException
     * @throws Throwable
     */
    public function createCustomDesign(
        string $sku,
        string $device,
    ): CreatedCustomDesignDto {
        $response = $this->client
            ->get('/custom-designs/create', [
                'sku' => $sku,
                'device' => $device,
            ]);

        if ($response->successful()) {
            return CreatedCustomDesignDto::fromArray($response->json()['data']);
        }

        throw new ApiException('Geen custom design data teruggegeven.');
    }

    /**
     * @throws ApiException
     * @throws Throwable
     */
    public function getCustomDesign(
        string $customDesignToken,
    ): CustomDesignDto {
        $response = $this->client
            ->get(sprintf('/custom-designs/%s', $customDesignToken));

        if ($response->successful()) {
            return CustomDesignDto::fromArray($response->json()['data']);
        }

        throw new ApiException('Geen custom design teruggegeven.');
    }

    /**
     * @throws ApiException
     * @throws Throwable
     */
    public function uploadForCustomDesign(
        string $customDesignToken,
        UploadedFile $file
    ): UploadDto {
        $response = $this->client
            ->setAttachment($file)
            ->post(sprintf('/custom-designs/%s/upload', $customDesignToken));

        if ($response->successful()) {
            return UploadDto::fromArray($response->json()['data']);
        }

        throw new ApiException('Geen upload teruggegeven.');
    }

    /**
     * @throws ApiException
     * @throws Throwable
     */
    public function deleteUploadForCustomDesign(
        string $customDesignToken
    ): bool {
        $response = $this->client
            ->delete(
                sprintf('/custom-designs/%s/upload', $customDesignToken)
            );

        if ($response->successful()) {
            return true;
        }

        return false;
    }

    /**
     * @throws ApiException
     * @throws Throwable
     */
    public function getCustomDesignPreview(
        string $customDesignToken,
    ): ?string {
        $response = $this->client
            ->get(sprintf('/custom-designs/%s/preview', $customDesignToken));

        if ($response->successful()) {
            return $response->json()['url'];
        }

        throw new ApiException('Geen custom design preview teruggegeven.');
    }
}
