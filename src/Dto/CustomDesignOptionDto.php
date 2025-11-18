<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class CustomDesignOptionDto
{
    /**
     * @param  CustomDesignOptionDto[]  $options
     */
    public function __construct(
        public string $skus,
        public int $prices,
        public string $name,
        public array $options = [],
        public ?MediaDto $firstMedia = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            skus: $data['skus'],
            prices: $data['prices'],
            name: $data['name'],
            options: array_map(
                fn (array $row) => CustomDesignOptionDto::fromArray($row),
                $data['options'] ?? []
            ),
            firstMedia: ! blank($data['first_media'])
                ? MediaDto::fromArray($data['first_media'])
                : null,
        );
    }
}
