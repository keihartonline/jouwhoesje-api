<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use KeihartOnline\JouwHoesjeApi\Enums\FilterTypeEnum;

final readonly class FilterDto
{
    /**
     * @param  FilterOptionDto[]  $options
     */
    public function __construct(
        public FilterTypeEnum $filterType,
        public string $name,
        public string $label,
        public int $count,
        public array $options,
    ) {}

    public static function fromArray(array $data): self
    {
        $options = array_map(
            fn (array $optionData) => FilterOptionDto::fromArray($optionData),
            $data['options'] ?? []
        );

        return new self(
            filterType: FilterTypeEnum::from($data['filterType']),
            name: $data['name'],
            label: $data['label'],
            count: $data['count'],
            options: $options,
        );
    }
}
