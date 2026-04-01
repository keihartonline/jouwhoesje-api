<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use KeihartOnline\JouwHoesjeApi\Enums\ReturnReasonEnum;

final readonly class ReturnRequestItemDto
{
    public function __construct(
        public ReturnReasonEnum $reason,
        public ?string $reasonNote,
        public int $quantity,
        public OrderItemDto $orderItem,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            reason: ReturnReasonEnum::from($data['reason']),
            reasonNote: $data['reason_note'] ?? null,
            quantity: $data['quantity'],
            orderItem: OrderItemDto::fromArray($data['order_item']),
        );
    }
}
