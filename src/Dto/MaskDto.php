<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class MaskDto
{
    public function __construct(
        public int $dimensionWidthMm,
        public int $dimensionHeightMm,
        public int $dimensionWidthPx,
        public int $dimensionHeightPx,
        public float $left,
        public float $top,
        public float $width,
        public float $height,
        public MediaDto $bottomMedia,
        public MediaDto $topMedia,
        public MediaDto $maskMedia,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            dimensionWidthMm: $data['dimension_width_mm'],
            dimensionHeightMm: $data['dimension_height_mm'],
            dimensionWidthPx: $data['dimension_width_px'],
            dimensionHeightPx: $data['dimension_height_px'],
            left: $data['left'],
            top: $data['top'],
            width: $data['width'],
            height: $data['height'],
            bottomMedia: MediaDto::fromArray($data['bottom_media']),
            topMedia: MediaDto::fromArray($data['top_media']),
            maskMedia: MediaDto::fromArray($data['mask_media']),
        );
    }
}
