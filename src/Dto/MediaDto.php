<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class MediaDto
{
    /**
     * @param  array<string, string>  $conversions  Key is the name of the conversion, value is the URL
     */
    public function __construct(
        public array $conversions,
        public string|int|null $handle = null,
        public ?string $caption = null,
        public ?string $title = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            conversions: $data['conversions'],
            handle: $data['handle'] ?? null,
            caption: $data['caption'] ?? null,
            title: ($data['title'] ?? $data['caption']) ?? null,
        );
    }
}
