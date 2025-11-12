<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use KeihartOnline\JouwHoesjeApi\Enums\LabelEnum;
use KeihartOnline\JouwHoesjeApi\Enums\ProductTypeEnum;
use KeihartOnline\JouwHoesjeApi\Enums\StockStatusEnum;

final readonly class FlatResultDto
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
        public string $subtitle,
        public string $description,
        public string $metaDescription,
        public string $datasheetDescription,
        public ?string $emoji,
        public int $price,
        public ?int $retailPrice,
        public bool $isPromotion,
        public ?string $deviceName,
        public ?string $deviceSlug,
        public ?string $deviceCombinedName,
        public array $deviceAllNames = [],
        public ?string $brandName,
        public ?string $brandSlug,
        public array $labels,
        public array $media,

        // Handy accessors
        public ?array $firstMedia = null,
        public bool $noLongerAvailable = false,
        public bool $isSellable = true,
    ) {}

    public static function fromArray(array $data): self
    {
        $dto = new self(
            productType: ProductTypeEnum::from($data['product_type']),
            slug: $data['slug'],
            stockStatus: StockStatusEnum::from($data['stock_status']),
            canBackorder: $data['can_backorder'],
            amountLeft: $data['amount_left'],
            articleNumber: $data['article_number'],
            ean: $data['ean'],
            title: $data['title'],
            subtitle: $data['subtitle'],
            description: $data['description'],
            metaDescription: $data['meta_description'],
            datasheetDescription: $data['datasheet_description'],
            emoji: $data['emoji'],
            price: $data['price'],
            retailPrice: $data['retail_price'],
            isPromotion: $data['retail_price'] > $data['price'],
            deviceName: $data['device_name'],
            deviceSlug: $data['device_slug'],
            deviceCombinedName: $data['device_combined_name'],
            deviceAllNames: $data['device_all_names'] ?? [],
            brandName: $data['brand_name'],
            brandSlug: $data['brand_slug'],
            labels: array_map(
                fn (string $label) => LabelEnum::from($label),
                $data['labels']
            ),
            media: $data['media'],
        );

        $dto->firstMedia = count($dto->media)
            ? reset($dto->media)
            : null;
        $dto->noLongerAvailable = ! $dto->canBackorder && $dto->stockStatus === StockStatusEnum::OUT_OF_STOCK;
        $dto->isSellable = in_array($dto->stockStatus, [StockStatusEnum::LOW_STOCK, StockStatusEnum::IN_STOCK]);

        return $dto;
    }
}
