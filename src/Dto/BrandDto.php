<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class BrandDto
{
    /**
     * @param  DeviceDto[]  $devices
     */
    public function __construct(
        public int $brandId,
        public string $name,
        public ?string $slug = null,
        public ?string $usp = null,
        public int $coversCount = 0,
        public int $customizableCount = 0,
        public array $devices = [],
        public array $series = [],
        public ?MediaDto $firstMedia = null,
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
            usp: $data['usp'] ?? null,
            coversCount: $data['covers_count'] ?? 0,
            customizableCount: $data['customizable_count'] ?? 0,
            devices: $devices,
            series: $data['series'] ?? [],
            firstMedia: ! blank($data['media'] ?? null)
                ? MediaDto::fromArray($data['media'][0])
                : null,
        );
    }
}
