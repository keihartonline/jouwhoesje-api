<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use KeihartOnline\JouwHoesjeApi\Enums\DeviceTypeEnum;

final readonly class DeviceDto
{
    public function __construct(
        public int $deviceId,
        public DeviceTypeEnum $type,
        public string $name,
        public ?string $combinedName = null,
        public array $allNames = [],
        public ?int $releaseYear = null,
        public ?string $slug = null,
        public ?string $usp = null,
        public ?string $valuableSubject = null,
        public ?string $customDesignText = null,
        public int $coversCount = 0,
        public int $customizableCount = 0,
        public bool $preferredProduct = false,
        public bool $isTopModel = false,
        public ?BrandDto $brand = null,
        public ?string $series = null,
        public ?MediaDto $firstMedia = null,
        public ?string $shortName = null,
        public ?string $sentenceName = null,
        /** @var DeviceCompactDto[] Visible models that are easily confused with this one */
        public array $relatedDevices = [],
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            deviceId: $data['device_id'],
            type: DeviceTypeEnum::from($data['type']),
            name: $data['name'],
            combinedName: $data['combined_name'] ?? null,
            allNames: $data['all_names'] ?? [],
            releaseYear: $data['release_year'] ?? null,
            slug: $data['slug'] ?? null,
            usp: $data['usp'] ?? null,
            valuableSubject: $data['valuable_subject'] ?? null,
            customDesignText: $data['custom_design_text'] ?? null,
            coversCount: $data['covers_count'] ?? 0,
            customizableCount: $data['customizable_count'] ?? 0,
            preferredProduct: $data['preferred_product'] ?? false,
            isTopModel: $data['is_top_model'] ?? false,
            brand: isset($data['brand']) ? BrandDto::fromArray($data['brand']) : null,
            series: $data['series'] ?? null,
            firstMedia: ! blank($data['media'] ?? null)
                ? MediaDto::fromArray($data['media'][0])
                : null,
            shortName: $data['short_name'] ?? null,
            sentenceName: $data['sentence_name'] ?? null,
            relatedDevices: array_map(
                DeviceCompactDto::fromArray(...),
                $data['related_devices'] ?? []
            ),
        );
    }
}
