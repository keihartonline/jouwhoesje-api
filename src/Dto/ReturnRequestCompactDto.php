<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use Illuminate\Support\Carbon;
use KeihartOnline\JouwHoesjeApi\Enums\ReturnRequestStatusEnum;
use KeihartOnline\JouwHoesjeApi\Enums\ReturnRequestTypeEnum;

final readonly class ReturnRequestCompactDto
{
    public function __construct(
        public string $returnRequestNumber,
        public ReturnRequestStatusEnum $status,
        public ReturnRequestTypeEnum $type,
        public int $totalQuantity,
        public bool $isCancelled,
        public bool $canCancel,
        public Carbon $createdAt,
        public Carbon $updatedAt,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            returnRequestNumber: $data['return_request_number'],
            status: ReturnRequestStatusEnum::from($data['status']),
            type: ReturnRequestTypeEnum::from($data['type']),
            totalQuantity: $data['total_quantity'],
            isCancelled: $data['is_cancelled'] ?? false,
            canCancel: $data['can_cancel'] ?? false,
            createdAt: Carbon::parse($data['created_at']),
            updatedAt: Carbon::parse($data['updated_at']),
        );
    }
}
