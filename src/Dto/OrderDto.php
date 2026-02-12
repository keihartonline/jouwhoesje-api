<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use Illuminate\Support\Carbon;
use KeihartOnline\JouwHoesjeApi\Enums\OrderStatusEnum;

final readonly class OrderDto
{
    public function __construct(
        public string $orderNumber,
        public OrderStatusEnum $status,
        public Carbon $createdAt,
        public Carbon $updatedAt,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            orderNumber: $data['order_number'],
            status: OrderStatusEnum::from($data['status']),
            createdAt: Carbon::parse($data['created_at']),
            updatedAt: Carbon::parse($data['updated_at']),
        );
    }
}
