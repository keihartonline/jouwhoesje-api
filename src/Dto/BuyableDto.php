<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use KeihartOnline\JouwHoesjeApi\Enums\ProductTypeEnum;

final readonly class BuyableDto
{
    public function __construct(
        public ProductTypeEnum $productType,
        public string $articleNumber,
        public ?MediaDto $firstMedia,
        public string $name,
        public string $slug,
        public ?string $brandSlug,
        public ?string $deviceSlug,
        public int $limit,
        public int $stock,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            productType: ProductTypeEnum::from($data['product_type']),
            articleNumber: $data['article_number'],
            firstMedia: ! blank($data['first_media'])
                ? MediaDto::fromArray($data['first_media'])
                : null,
            name: $data['name'],
            slug: $data['slug'],
            brandSlug: $data['brand_slug'] ?? null,
            deviceSlug: $data['device_slug'] ?? null,
            limit: $data['limit'],
            stock: $data['stock'],
        );
    }
}
