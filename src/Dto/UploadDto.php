<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class UploadDto
{
    public function __construct(
        public string $name,
        public string $path,
        public MediaDto $media,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            path: $data['path'],
            media: MediaDto::fromArray($data['media']),
        );
    }
}
