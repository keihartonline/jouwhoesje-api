<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

class BrandDto
{
    /**
     * @param  DeviceDto[]  $devices
     */
    public function __construct(
        public int $brandId,
        public string $name,
        public ?string $slug = null,
        public ?int $sellableCoversCount = null,
        public array $devices = [],
        public ?ImageDto $image = null,
    ) {}

    public static function fromArray(array $data): self
    {
        $devices = array_map(
            fn (array $deviceData) => DeviceDto::fromArray($deviceData),
            $data['devices'] ?? []
        );

        return new self(
            brandId: $data['brand_id'],
            name: $data['name'],
            slug: $data['slug'] ?? null,
            sellableCoversCount: $data['sellable_covers_count'] ?? null,
            devices: $devices,
            image: $data['image'] ? ImageDto::fromArray($data['image']) : null,
        );
    }
}
