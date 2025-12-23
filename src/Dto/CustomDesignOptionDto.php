<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class CustomDesignOptionDto
{
    /**
     * @param  string[]  $skus
     * @param  int[]  $prices
     * @param  CustomDesignOptionDto[]  $options
     */
    public function __construct(
        public array $skus,
        public array $prices,
        public string $name,
        public array $options,
        public array $colours,
        public array $specifications,
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
            colours: $data['colours'] ?? [],
            specifications: array_map(
                fn ($row) => SpecificationDto::fromArray($row),
                $data['specifications'] ?? []
            ),
            firstMedia: ! blank($data['first_media'])
                ? MediaDto::fromArray($data['first_media'])
                : null,
        );
    }
}
