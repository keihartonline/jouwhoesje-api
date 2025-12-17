<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class DimensionsDto
{
    public function __construct(
        public int $minWidth,
        public int $minHeight,
        public int $width,
        public int $height,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            minWidth: $data['min_width'],
            minHeight: $data['min_height'],
            width: $data['width'],
            height: $data['height'],
        );
    }
}
