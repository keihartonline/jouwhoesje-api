<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use KeihartOnline\JouwHoesjeApi\Enums\CustomDesignQualityEnum;

final readonly class CustomDesignDto
{
    public function __construct(
        public string $customDesignToken,
        public DeviceDto $device,
        public MaskDto $mask,
        public string $name,
        public int $price,
        public bool $canHaveContainFitType,
        public ?string $preview,
        public ?UploadDto $upload,
        public CustomDesignSettingsDto $settings,
        public CustomDesignQualityEnum $quality,
        public DimensionsDto $dimensions,
        public array $colourVariants,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            customDesignToken: $data['custom_design_token'],
            device: DeviceDto::fromArray($data['device']),
            mask: MaskDto::fromArray($data['mask']),
            name: $data['name'],
            price: $data['price'],
            canHaveContainFitType: $data['can_have_contain_fit_type'],
            preview: $data['preview'],
            upload: ! blank($data['upload']) ? UploadDto::fromArray($data['upload']) : null,
            settings: CustomDesignSettingsDto::fromArray($data['settings']),
            quality: CustomDesignQualityEnum::from($data['quality']),
            dimensions: DimensionsDto::fromArray($data['dimensions']),
            colourVariants: array_map(
                fn (array $row) => CustomDesignColourVariantDto::fromArray($row),
                $data['colour_variants']
            )
        );
    }
}
