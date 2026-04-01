<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use KeihartOnline\JouwHoesjeApi\Enums\ReturnReasonEnum;

final readonly class ReturnRequestItemDto
{
    public function __construct(
        public ReturnReasonEnum $reason,
        public ?string $reasonNote,
        public int $quantity,
        public int $lineTotalNet,
        public int $lineTotalVat,
        public int $lineTotalGross,
        public OrderItemDto $orderItem,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            reason: ReturnReasonEnum::from($data['reason']),
            reasonNote: $data['reason_note'] ?? null,
            quantity: $data['quantity'],
            lineTotalNet: (int) ($data['line_total_net'] ?? 0),
            lineTotalVat: (int) ($data['line_total_vat'] ?? 0),
            lineTotalGross: (int) ($data['line_total_gross'] ?? 0),
            orderItem: OrderItemDto::fromArray($data['order_item']),
        );
    }
}
