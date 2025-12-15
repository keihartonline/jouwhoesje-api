<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use KeihartOnline\JouwHoesjeApi\Enums\CustomDesignEffectEnum;
use KeihartOnline\JouwHoesjeApi\Enums\CustomDesignFitTypeEnum;

final readonly class CustomDesignSettingsDto
{
    public function __construct(
        public CustomDesignEffectEnum $effect,
        public CustomDesignFitTypeEnum $fitType,
        public ?array $coverData,
        public array $containData,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            effect: CustomDesignEffectEnum::from($data['effect']),
            fitType: CustomDesignFitTypeEnum::from($data['fit_type']),
            coverData: $data['cover_data'] ?? null,
            containData: $data['contain_data'] ?? null,
        );
    }
}
