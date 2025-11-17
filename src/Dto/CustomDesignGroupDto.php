<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class CustomDesignGroupDto
{
    /**
     * @param  CustomDesignOptionDto[]  $options
     */
    public function __construct(
        public string $sku,
        public array $skus,
        public array $prices,
        public string $name,
        public int $optionsCount,
        public array $options,
        public ?MediaDto $firstMedia = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            sku: $data['sku'],
            skus: $data['skus'],
            prices: $data['prices'],
            name: $data['name'],
            optionsCount: $data['options_count'] ?? 0,
            options: array_map(
                fn (array $row) => CustomDesignOptionDto::fromArray($row),
                $data['options']
            ),
            firstMedia: ! blank($data['first_media'])
                ? MediaDto::fromArray($data['first_media'])
                : null,
        );
    }
}
