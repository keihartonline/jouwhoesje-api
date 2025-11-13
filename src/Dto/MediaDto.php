<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class MediaDto
{
    /**
     * @param  array<string, string>  $conversions  Key is the name of the conversion, value is the URL
     */
    public function __construct(
        public ?string $caption,
        public ?string $title,
        public array $conversions,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            caption: $data['caption'] ?? null,
            title: ($data['title'] ?? $data['caption']) ?? null,
            conversions: $data['conversions'],
        );
    }
}
