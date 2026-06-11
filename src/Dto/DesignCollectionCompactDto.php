<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class DesignCollectionCompactDto
{
    public function __construct(
        public int $id,
        public string $slug,
        public string $name,
        public string $title,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            slug: $data['slug'],
            name: $data['name'],
            title: $data['title'],
        );
    }
}
