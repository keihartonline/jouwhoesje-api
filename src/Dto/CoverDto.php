<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use KeihartOnline\JouwHoesjeApi\Enums\LabelEnum;
use KeihartOnline\JouwHoesjeApi\Enums\StockStatusEnum;

final readonly class CoverDto
{
    /**
     * @param LabelEnum[] $labels
     */
    public function __construct(
        public string $slug,
        public StockStatusEnum $stockStatus,
        public bool $canBackorder,
        public ?int $amountLeft,
        public string $articleNumber,
        public ?string $ean,
        public string $name,
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
        public array $labels = [],
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
            name: $data['name'],
            title: $data['title'],
            subtitle: $data['subtitle'] ?? null,
            description: $data['description'] ?? null,
            metaDescription: $data['meta_description'] ?? null,
            price: (int) ($data['price'] ?? 0),
            retailPrice: $data['retail_price'] ?? null,
            weight: $data['weight'] ?? null,
            deviceName: $data['device_name'],
            deviceSlug: $data['device_slug'],
            deviceCombinedName: $data['device_combined_name'],
            deviceAllNames: $data['device_all_names'] ?? [],
            deviceReleaseYear: $data['device_release_year'] ?? null,
            brandName: $data['brand_name'] ?? '',
            brandSlug: $data['brand_slug'] ?? '',
            labels: array_map(
                fn (string $label) => LabelEnum::from($label),
                $data['labels'] ?? []
            ),
            media: $data['media'] ?? [],
        );
    }
}
