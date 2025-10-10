<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use KeihartOnline\JouwHoesjeApi\Enums\StockStatusEnum;

final readonly class CoverCompactDto
{
    public function __construct(
        public string $slug,
        public StockStatusEnum $stockStatus,
        public bool $canBackorder,
        public ?int $amountLeft,
        public string $articleNumber,
        public ?string $ean,
        public string $title,
        public int $price,
        public ?int $retailPrice,
        public string $deviceCombinedName,
        public string $brandName = '',
        public string $brandSlug = '',
        public array $media = [],
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            slug: $data['slug'],
            stockStatus: StockStatusEnum::from($data['stock_status']),
            canBackorder: (bool) $data['can_backorder'],
            amountLeft: $data['amount_left'] ?? null,
            articleNumber: $data['article_number'],
            ean: $data['ean'] ?? null,
            title: $data['title'],
            price: (int) ($data['price'] ?? 0),
            retailPrice: $data['retail_price'] ?? null,
            deviceCombinedName: $data['device_combined_name'],
            brandName: $data['brand_name'] ?? '',
            brandSlug: $data['brand_slug'] ?? '',
            media: $data['media'] ?? [],
        );
    }
}
