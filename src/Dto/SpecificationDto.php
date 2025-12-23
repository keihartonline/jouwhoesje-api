<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use KeihartOnline\JouwHoesjeApi\Enums\SpecificationTypeEnum;

final readonly class SpecificationDto
{
    public function __construct(
        public SpecificationTypeEnum $type,
        public mixed $value,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            type: SpecificationTypeEnum::from($data['type']),
            value: $data['value'],
        );
    }
}
