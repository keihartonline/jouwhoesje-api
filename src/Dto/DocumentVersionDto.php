<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class DocumentVersionDto
{
    public function __construct(
        public string $content,
        public int $versionNumber,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            content: $data['content'],
            versionNumber: $data['version_number'],
        );
    }
}
