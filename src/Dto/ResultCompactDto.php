<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use KeihartOnline\JouwHoesjeApi\Enums\DeviceTypeEnum;
use KeihartOnline\JouwHoesjeApi\Enums\LabelEnum;
use KeihartOnline\JouwHoesjeApi\Enums\ProductTypeEnum;
use KeihartOnline\JouwHoesjeApi\Enums\StockStatusEnum;

final readonly class ResultCompactDto
{
    /**
     * @param  LabelEnum[]  $labels
     */
    public function __construct(
        public ProductTypeEnum $productType,
        public string $slug,
        public StockStatusEnum $stockStatus,
        public bool $canBackorder,
        public ?int $amountLeft,
        public string $articleNumber,
        public ?string $ean,
        public string $title,
        public ?string $emoji,
        public int $price,
        public ?int $retailPrice,
        public bool $isPromotion = false,
        public bool $isCancelled = false,
        public bool $canCancel = false,
        public ?string $deviceCombinedName = null,
        public ?DeviceTypeEnum $deviceType = null,
        public ?string $brandName = null,
        public ?string $brandSlug = null,
        public array $labels = [],
        public ?MediaDto $firstMedia = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            productType: ProductTypeEnum::from($data['product_type']),
            slug: $data['slug'],
            stockStatus: StockStatusEnum::from($data['stock_status']),
            canBackorder: $data['can_backorder'],
            amountLeft: $data['amount_left'],
            articleNumber: $data['article_number'],
            ean: $data['ean'],
            title: $data['title'],
            emoji: $data['emoji'],
            price: $data['price'],
            retailPrice: $data['retail_price'],
            isPromotion: $data['retail_price'] > $data['price'],
            isCancelled: $data['is_cancelled'] ?? false,
            canCancel: $data['can_cancel'] ?? false,
            deviceCombinedName: $data['device_combined_name'],
            deviceType: $data['device_type'] !== null
                ? DeviceTypeEnum::tryFrom($data['device_type'])
                : null,
            brandName: $data['brand_name'],
            brandSlug: $data['brand_slug'],
            labels: array_map(
                fn (string $label) => LabelEnum::from($label),
                $data['labels']
            ),
            firstMedia: ! blank($data['media'])
                ? MediaDto::fromArray($data['media'][0])
                : null,
        );
    }
}
