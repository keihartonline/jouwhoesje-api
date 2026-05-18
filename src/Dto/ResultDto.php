<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use KeihartOnline\JouwHoesjeApi\Enums\DeviceTypeEnum;
use KeihartOnline\JouwHoesjeApi\Enums\LabelEnum;
use KeihartOnline\JouwHoesjeApi\Enums\ProductTypeEnum;
use KeihartOnline\JouwHoesjeApi\Enums\StockStatusEnum;

final class ResultDto
{
    /**
     * @param  SpecificationDto[]  $specifications
     * @param  LabelEnum[]  $labels
     * @param  array<string, string>  $alternates
     * @param  MediaDto[]  $media
     */
    public function __construct(
        public ProductTypeEnum $productType,
        public string $slug,
        public StockStatusEnum $stockStatus,
        public bool $canBackorder,
        public ?int $amountLeft,
        public int $shippingPoints,
        public string $articleNumber,
        public ?string $ean,
        public string $title,
        public ?string $subtitle,
        public ?string $name,
        public string $description,
        public ?string $metaDescription,
        public ?string $variantDescription,
        public ?string $emoji,
        public int $price,
        public ?int $retailPrice,
        public bool $isPromotion,
        public ?string $deviceName,
        public ?string $deviceSlug,
        public ?string $deviceCombinedName,
        public array $deviceAllNames,
        public ?DeviceTypeEnum $deviceType,
        public ?int $family,
        public ?string $brandName,
        public ?string $brandSlug,
        public array $specifications,
        public array $labels,
        public array $alternates,
        public array $media,
    ) {}

    public function firstMedia(): ?MediaDto
    {
        return ! blank($this->media) ? $this->media[0] : null;
    }

    public function firstMediaUrl(): ?string
    {
        return $this->firstMedia()?->conversions['lg'] ?? null;
    }

    public function noLongerAvailable(): bool
    {
        return ! $this->canBackorder && $this->stockStatus === StockStatusEnum::OUT_OF_STOCK;
    }

    public function isSellable(): bool
    {
        return in_array($this->stockStatus, [StockStatusEnum::LOW_STOCK, StockStatusEnum::IN_STOCK]);
    }

    public static function fromArray(array $data): self
    {
        return new self(
            productType: ProductTypeEnum::from($data['product_type']),
            slug: $data['slug'],
            stockStatus: StockStatusEnum::from($data['stock_status']),
            canBackorder: $data['can_backorder'],
            amountLeft: $data['amount_left'],
            shippingPoints: $data['shipping_points'],
            articleNumber: $data['article_number'],
            ean: $data['ean'],
            title: $data['title'],
            subtitle: $data['subtitle'],
            name: $data['name'],
            description: $data['description'],
            metaDescription: $data['meta_description'],
            variantDescription: $data['variant_description'],
            emoji: $data['emoji'],
            price: $data['price'],
            retailPrice: $data['retail_price'],
            isPromotion: $data['retail_price'] > $data['price'],
            deviceName: $data['device_name'],
            deviceSlug: $data['device_slug'],
            deviceCombinedName: $data['device_combined_name'],
            deviceAllNames: $data['device_all_names'] ?? [],
            deviceType: $data['device_type'] !== null
                ? DeviceTypeEnum::tryFrom($data['device_type'])
                : null,
            family: $data['family'],
            brandName: $data['brand_name'],
            brandSlug: $data['brand_slug'],
            specifications: array_map(
                fn ($row) => SpecificationDto::fromArray($row),
                $data['specifications'] ?? []
            ),
            labels: array_map(
                fn (string $label) => LabelEnum::from($label),
                $data['labels']
            ),
            alternates: $data['alternates'] ?? [],
            media: array_map(
                fn (array $row) => MediaDto::fromArray($row),
                $data['media']
            ),
        );
    }
}
