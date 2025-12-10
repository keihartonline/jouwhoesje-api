<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use KeihartOnline\JouwHoesjeApi\Enums\CustomDesignEffectEnum;
use KeihartOnline\JouwHoesjeApi\Enums\CustomDesignFitTypeEnum;

final readonly class CustomDesignDto
{
    public function __construct(
        public string $customDesignToken,
        public DeviceDto $device,
        public MaskDto $mask,
        public string $name,
        public int $price,
        public CustomDesignEffectEnum $effect,
        public CustomDesignFitTypeEnum $fitType,
        public ?string $preview = null,
        public ?UploadDto $upload = null,
        public ?array $cropperData = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            customDesignToken: $data['custom_design_token'],
            device: DeviceDto::fromArray($data['device']),
            mask: MaskDto::fromArray($data['mask']),
            name: $data['name'],
            price: $data['price'],
            effect: CustomDesignEffectEnum::from($data['effect']),
            fitType: CustomDesignFitTypeEnum::from($data['fit_type']),
            preview: $data['preview'],
            upload: ! blank($data['upload']) ? UploadDto::fromArray($data['upload']) : null,
            cropperData: $data['cropper_data'],
        );
    }
}
