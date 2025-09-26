<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

readonly class DeviceDto
{
    public function __construct(
        public int $deviceId,
        public string $name,
        public ?string $combinedName = null,
        public array $allNames = [],
        public ?int $releaseYear = null,
        public ?string $slug = null,
        public int $completeCoversCount = 0,
        public ?BrandDto $brand = null,
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
            brand: isset($data['brand']) ? BrandDto::fromArray($data['brand']) : null,
        );
    }
}
