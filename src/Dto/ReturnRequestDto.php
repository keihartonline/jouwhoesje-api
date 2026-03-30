<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use Illuminate\Support\Carbon;
use KeihartOnline\JouwHoesjeApi\Enums\ReturnRequestStatusEnum;
use KeihartOnline\JouwHoesjeApi\Enums\ReturnRequestTypeEnum;

final readonly class ReturnRequestDto
{
    public function __construct(
        public string $returnRequestNumber,
        public ReturnRequestStatusEnum $status,
        public ReturnRequestTypeEnum $type,
        public string $title,
        public int $totalQuantity,
        public int $returnPrice,
        public ?string $note,
        public bool $shouldReturnItems,
        public Carbon $createdAt,
        public Carbon $updatedAt,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            returnRequestNumber: $data['return_request_number'],
            status: ReturnRequestStatusEnum::from($data['status']),
            type: ReturnRequestTypeEnum::from($data['type']),
            title: $data['title'],
            totalQuantity: $data['total_quantity'],
            returnPrice: $data['return_price'],
            note: $data['note'] ?? null,
            shouldReturnItems: $data['should_return_items'],
            createdAt: Carbon::parse($data['created_at']),
            updatedAt: Carbon::parse($data['updated_at']),
        );
    }
}
