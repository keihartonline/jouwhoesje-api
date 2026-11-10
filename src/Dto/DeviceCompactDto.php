<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use KeihartOnline\JouwHoesjeApi\Enums\DeviceTypeEnum;

final readonly class DeviceCompactDto
{
    public function __construct(
        public int $deviceId,
        public DeviceTypeEnum $type,
        public string $name,
        public ?string $combinedName = null,
        public ?string $slug = null,
        public ?int $releaseYear = null,
        public int $coversCount = 0,
        public int $customizableCount = 0,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            deviceId: $data['device_id'],
            type: DeviceTypeEnum::from($data['type']),
            name: $data['name'],
            combinedName: $data['combined_name'] ?? null,
            slug: $data['slug'] ?? null,
            releaseYear: $data['release_year'] ?? null,
            coversCount: $data['covers_count'] ?? 0,
            customizableCount: $data['customizable_count'] ?? 0,
        );
    }
}
