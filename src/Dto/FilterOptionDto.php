<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class FilterOptionDto
{
    public function __construct(
        public string $label,
        public int|string $value,
        public ?string $group,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            label: $data['label'],
            value: $data['value'],
            group: $data['group'],
        );
    }
}
