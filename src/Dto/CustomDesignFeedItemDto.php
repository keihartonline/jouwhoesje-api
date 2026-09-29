<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use KeihartOnline\JouwHoesjeApi\Enums\DeviceTypeEnum;

final readonly class CustomDesignFeedItemDto
{
    public function __construct(
        public int $deviceId,
        public string $slug,
        public string $name,
        public string $combinedName,
        public DeviceTypeEnum $type,
        public ?string $brandName,
        public int $minPrice,
        public ?MediaDto $media = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            deviceId: $data['device_id'],
            slug: $data['slug'],
            name: $data['name'],
            combinedName: $data['combined_name'],
            type: DeviceTypeEnum::from($data['type']),
            brandName: $data['brand_name'] ?? null,
            minPrice: $data['min_price'],
            media: ! blank($data['media'] ?? null)
                ? MediaDto::fromArray($data['media'])
                : null,
        );
    }
}
