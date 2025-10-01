<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

readonly class ImageDto
{
    /**
     * @param string $url
     * @param array<string, string> $conversions Key is the name of the conversion, value is the URL
     */
    public function __construct(
        public string $url,
        public array $conversions,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            url: $data['url'],
            conversions: $data['conversions'],
        );
    }
}
