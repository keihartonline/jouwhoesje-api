<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class CustomDesignInfoDto
{
    /**
     * @param  CustomDesignOptionDto[]  $options
     * @param  MediaDto[]  $media
     */
    public function __construct(
        public array $prices,
        public array $options,
        public int $optionsCount,
        public array $media,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            prices: $data['prices'],
            options: array_map(
                fn (array $row) => CustomDesignOptionDto::fromArray($row),
                $data['options']
            ),
            optionsCount: $data['options_count'] ?? 1,
            media: array_map(
                fn (array $row) => MediaDto::fromArray($row),
                $data['media']
            ),
        );
    }
}
