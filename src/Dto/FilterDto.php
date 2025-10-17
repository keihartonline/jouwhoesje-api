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
    ) {}

    public static function fromArray(array $data): self
    {
        $firstOption = Arr::first($data['options']);

        if (array_key_exists('options', $firstOption) && is_array($firstOption['options'])) {
            $options = array_map(
                fn (array $optionGroupData) => FilterOptionGroupDto::fromArray($optionGroupData),
                $data['options']
            );
        } else {
            $options = array_map(
                fn (array $optionData) => FilterOptionDto::fromArray($optionData),
                $data['options'] ?? []
            );
        }

        return new self(
            filterType: FilterTypeEnum::from($data['filterType']),
            name: $data['name'],
            label: $data['label'],
            count: $data['count'],
            options: $options,
        );
    }
}
