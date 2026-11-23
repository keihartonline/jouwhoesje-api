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
        public string $intro,
        public ?string $description,
        public string $metaTitle,
        public string $metaDescription,
        public array $alternates,
        public ?MediaDto $firstMedia = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            createdAt: Carbon::parse($data['created_at']),
            slug: $data['slug'],
            name: $data['name'],
            title: $data['title'],
            intro: $data['intro'],
            description: $data['description'] ?? null,
            metaTitle: $data['meta_title'],
            metaDescription: $data['meta_description'],
            alternates: $data['alternates'] ?? [],
            firstMedia: ! blank($data['media'] ?? null)
                ? MediaDto::fromArray($data['media'][0])
                : null,
        );
    }
}
