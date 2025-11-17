<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class MediaDto
{
    /**
     * @param  array<string, string>  $conversions  Key is the name of the conversion, value is the URL
     */
    public function __construct(
        public string|int|null $handle,
        public array $conversions,
        public ?string $caption = null,
        public ?string $title = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            handle: $data['handle'] ?? null,
            conversions: $data['conversions'],
            caption: $data['caption'] ?? null,
            title: ($data['title'] ?? $data['caption']) ?? null,
        );
    }
}
