<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use KeihartOnline\JouwHoesjeApi\Enums\FilterEnum;

final readonly class FilterDto
{
    /**
     * @param  FilterOptionDto[]|FilterOptionGroupDto[]  $options
     */
    public function __construct(
        public FilterEnum $filter,
        public int $count,
        public array $options,
        public bool $hasOptionGroups = false,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            filter: FilterEnum::from($data['filter']),
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
