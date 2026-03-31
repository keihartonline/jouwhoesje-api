<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use Illuminate\Support\Carbon;
use KeihartOnline\JouwHoesjeApi\Enums\ReturnRequestStatusEnum;

final readonly class ReturnRequestStatusDto
{
    public function __construct(
        public ReturnRequestStatusEnum $status,
        public Carbon $createdAt,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            status: ReturnRequestStatusEnum::from($data['status']),
            createdAt: Carbon::parse($data['created_at']),
        );
    }
}
