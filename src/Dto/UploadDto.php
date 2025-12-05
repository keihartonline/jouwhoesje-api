<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use KeihartOnline\JouwHoesjeApi\Enums\CustomDesignEffectEnum;

final readonly class UploadDto
{
    public function __construct(
        public string $name,
        public string $path,
        public MediaDto $media,
        public array $effects,
    ) {}

    public static function fromArray(array $data): self
    {
        $effects = [];

        foreach (CustomDesignEffectEnum::cases() as $effect) {
            $effects[$effect->value] = $data['media']['conversions'][$effect->value] ?? null;
            unset($data['media']['conversions'][$effect->value]);
        }

        return new self(
            name: $data['name'],
            path: $data['path'],
            media: MediaDto::fromArray($data['media']),
            effects: array_filter($effects),
        );
    }
}
