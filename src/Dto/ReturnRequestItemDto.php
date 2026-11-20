<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use KeihartOnline\JouwHoesjeApi\Enums\ReturnReasonEnum;

final readonly class ReturnRequestItemDto
{
    public function __construct(
        public ReturnReasonEnum $reason,
        public ?string $reasonNote,
        public int $quantity,
        public ?int $lineTotalNet,
        public ?int $lineTotalVat,
        public ?int $lineTotalGross,
        public OrderItemDto $orderItem,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            reason: ReturnReasonEnum::from($data['reason']),
            reasonNote: $data['reason_note'] ?? null,
            quantity: $data['quantity'],
            lineTotalNet: isset($data['line_total_net']) ? (int) $data['line_total_net'] : null,
            lineTotalVat: isset($data['line_total_vat']) ? (int) $data['line_total_vat'] : null,
            lineTotalGross: isset($data['line_total_gross']) ? (int) $data['line_total_gross'] : null,
            orderItem: OrderItemDto::fromArray($data['order_item']),
        );
    }
}
