<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class DeviceDto
{
    public function __construct(
        public int $deviceId,
        public string $name,
        public ?string $combinedName = null,
        public array $allNames = [],
        public ?int $releaseYear = null,
        public ?string $slug = null,
        public int $completeCoversCount = 0,
        public int $sellableCoversCount = 0,
        public bool $preferredProduct = false,
        public ?BrandDto $brand = null,
        public ?string $series = null,
        public ?MediaDto $firstMedia = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            deviceId: $data['device_id'],
            name: $data['name'],
            combinedName: $data['combined_name'] ?? null,
            allNames: $data['all_names'] ?? [],
            releaseYear: $data['release_year'] ?? null,
            slug: $data['slug'] ?? null,
            completeCoversCount: $data['complete_covers_count'] ?? 0,
            sellableCoversCount: $data['sellable_covers_count'] ?? 0,
            preferredProduct: $data['preferred_product'] ?? false,
            brand: isset($data['brand']) ? BrandDto::fromArray($data['brand']) : null,
            series: $data['series'] ?? null,
            firstMedia: ! blank($data['media'] ?? null)
                ? MediaDto::fromArray($data['media'][0])
                : null,
        );
    }
}
