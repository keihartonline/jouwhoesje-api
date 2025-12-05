<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use KeihartOnline\JouwHoesjeApi\Enums\CustomDesignEffectEnum;

final readonly class CustomDesignDto
{
    public function __construct(
        public string $customDesignToken,
        public DeviceDto $device,
        public MaskDto $mask,
        public string $name,
        public int $price,
        public CustomDesignEffectEnum $effect,
        public ?UploadDto $upload = null,
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
            upload: ! blank($data['upload']) ? UploadDto::fromArray($data['upload']) : null,
        );
    }
}
