<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class PaginatedCoverResultDto
{
    /**
     * @param  CoverCompactDto[]  $items
     */
    public function __construct(
        public array $items,
        public array $meta,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            items: array_map(
                fn (array $itemData) => CoverCompactDto::fromArray($itemData),
                $data['data']
            ),
            meta: $data['meta'],
        );
    }
}
