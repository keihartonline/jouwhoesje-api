<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class PaginatedCoverResultDto
{
    /**
     * @param  ResultCompactDto[]  $items
     */
    public function __construct(
        public array $items,
        public ?int $currentPage,
        public ?int $perPage,
        public ?int $total,
        public ?int $lastPage,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            items: array_map(
                fn (array $itemData) => ResultCompactDto::fromArray($itemData),
                $data['data']
            ),
            currentPage: $data['current_page'],
            perPage: $data['per_page'],
            total: $data['total'],
            lastPage: $data['last_page'],
        );
    }
}
