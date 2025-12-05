<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class CustomDesignPreviewDto
{
    public function __construct(
        public string $url,
        public array $effects,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            url: $data['url'],
            effects: $data['effects'],
        );
    }
}
