<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

readonly class CoverDto
{
    public function __construct(
        public int $coverId,
        public string $articleNumber,
        public ?string $ean = null,
        public DeviceDto $device,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            coverId: $data['cover_id'],
            articleNumber: $data['article_number'],
            ean: $data['ean'] ?? null,
            device: DeviceDto::fromArray($data['device']),
        );
    }
}
