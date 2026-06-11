<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use Illuminate\Support\Carbon;

final readonly class DesignCollectionDto
{
    public function __construct(
        public int $id,
        public Carbon $createdAt,
        public string $slug,
        public string $name,
        public string $title,
        public string $description,
        public string $metaTitle,
        public string $metaDescription,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            createdAt: Carbon::parse($data['created_at']),
            slug: $data['slug'],
            name: $data['name'],
            title: $data['title'],
            description: $data['description'],
            metaTitle: $data['meta_title'],
            metaDescription: $data['meta_description'],
        );
    }
}
