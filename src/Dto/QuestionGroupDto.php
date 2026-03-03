<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class QuestionGroupDto
{
    public function __construct(
        public string $name,
        public ?string $icon,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            icon: $data['icon'] ?? null,
        );
    }
}
