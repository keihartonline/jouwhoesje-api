<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use Illuminate\Support\Carbon;

final readonly class DesignCollectionDto
{
    /**
     * @param  DesignCollectionCompactDto[]  $children
     */
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
        public int $resultsCollectionId,
        public array $alternates,
        public ?MediaDto $firstMedia = null,
        public ?BrandCompactDto $brand = null,
        public ?DesignCollectionCompactDto $parent = null,
        public array $children = [],
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
            resultsCollectionId: $data['results_collection_id'] ?? $data['id'],
            alternates: $data['alternates'] ?? [],
            firstMedia: ! blank($data['media'] ?? null)
                ? MediaDto::fromArray($data['media'][0])
                : null,
            brand: ! blank($data['brand'] ?? null)
                ? BrandCompactDto::fromArray($data['brand'])
                : null,
            parent: ! blank($data['parent'] ?? null)
                ? DesignCollectionCompactDto::fromArray($data['parent'])
                : null,
            children: array_map(
                fn (array $child) => DesignCollectionCompactDto::fromArray($child),
                $data['children'] ?? []
            ),
        );
    }
}
