<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final class CoverDto
{
    public function __construct(
        public string $slug,
        public string $stockStatus,
        public bool $canBackorder,
        public ?int $amountLeft,
        public string $articleNumber,
        public ?string $ean,
        public string $title,
        public ?string $subtitle,
        public ?string $description,
        public ?string $metaDescription,
        public int $price,
        public ?int $retailPrice,
        public ?int $weight,
        public string $deviceName,
        public string $deviceSlug,
        public string $deviceCombinedName,
        public array $deviceAllNames = [],
        public ?int $deviceReleaseYear = null,
        public string $brandName = '',
        public string $brandSlug = '',
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            slug: $data['slug'],
            stockStatus: $data['stock_status'],
            canBackorder: $data['can_backorder'],
            amountLeft: $data['amount_left'],
            articleNumber: $data['article_number'],
            ean: $data['ean'],
            title: $data['title'],
            subtitle: $data['subtitle'],
            description: $data['description'],
            metaDescription: $data['meta_description'],
            price: $data['price'] ?? 0,
            retailPrice: $data['retail_price'],
            weight: $data['weight'],
            deviceName: $data['device_name'],
            deviceSlug: $data['device_slug'],
            deviceCombinedName: $data['device_combined_name'],
            deviceAllNames: $data['device_all_names'],
            deviceReleaseYear: $data['device_release_year'],
            brandName: $data['brand_name'],
            brandSlug: $data['brand_slug'],
        );
    }
}
