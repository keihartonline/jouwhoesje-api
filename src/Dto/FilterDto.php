<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use Illuminate\Support\Arr;
use KeihartOnline\JouwHoesjeApi\Enums\FilterTypeEnum;

final readonly class FilterDto
{
    /**
     * @param  FilterOptionDto[]|FilterOptionGroupDto[]  $options
     */
    public function __construct(
        public FilterTypeEnum $filterType,
        public string $name,
        public string $label,
        public int $count,
        public array $options,
        public bool $hasOptionGroups = false,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            filterType: FilterTypeEnum::from($data['filter_type']),
            name: $data['name'],
            label: $data['label'],
            count: $data['count'],
            options: $data['has_option_groups']
                ? array_map(
                    fn (array $optionGroupData) => FilterOptionGroupDto::fromArray($optionGroupData),
                    $data['options']
                )
                : array_map(
                    fn (array $optionData) => FilterOptionDto::fromArray($optionData),
                    $data['options'] ?? []
                ),
            hasOptionGroups: $data['has_option_groups'],
        );
    }
}
