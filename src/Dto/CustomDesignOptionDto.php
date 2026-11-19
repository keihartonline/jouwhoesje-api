<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use KeihartOnline\JouwHoesjeApi\Enums\StockStatusEnum;

final readonly class CustomDesignOptionDto
{
    /**
     * @param  string[]  $skus
     * @param  int[]  $prices
     * @param  CustomDesignOptionDto[]  $options
     */
    public function __construct(
        public array $skus,
        public array $prices,
        public string $name,
        public ?string $description,
        public array $options,
        public array $colours,
        public array $specifications,
        public ?MediaDto $firstMedia = null,
        public StockStatusEnum $stockStatus = StockStatusEnum::IN_STOCK,
        public bool $disabled = false,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            skus: $data['skus'],
            prices: $data['prices'],
            name: $data['name'],
            description: $data['description'] ?? null,
            options: array_map(
                fn (array $row) => CustomDesignOptionDto::fromArray($row),
                $data['options'] ?? []
            ),
            colours: $data['colours'] ?? [],
            specifications: array_map(
                fn ($row) => SpecificationDto::fromArray($row),
                $data['specifications'] ?? []
            ),
            firstMedia: ! blank($data['first_media'])
                ? MediaDto::fromArray($data['first_media'])
                : null,
            stockStatus: StockStatusEnum::tryFrom($data['stock_status'] ?? '') ?? StockStatusEnum::IN_STOCK,
            disabled: $data['disabled'] ?? false,
        );
    }
}
