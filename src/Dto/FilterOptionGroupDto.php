<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class FilterOptionGroupDto
{
    /**
     * @param FilterOptionDto[] $options
     */
    public function __construct(
        public string $label,
        public int $count,
        public array $options,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            label: $data['label'],
            count: $data['count'],
            options: array_map(
                fn (array $optionData) => FilterOptionDto::fromArray($optionData),
                $data['options'] ?? []
            ),
        );
    }
}
