<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use Illuminate\Support\Carbon;
use KeihartOnline\JouwHoesjeApi\Enums\ReturnRequestStatusEnum;
use KeihartOnline\JouwHoesjeApi\Enums\ReturnRequestTypeEnum;

final readonly class ReturnRequestDto
{
    /**
     * @param  ReturnRequestItemDto[]  $items
     */
    public function __construct(
        public string $returnRequestNumber,
        public ReturnRequestStatusEnum $status,
        public array $statusHistory,
        public ReturnRequestTypeEnum $type,
        public string $title,
        public int $totalQuantity,
        public int $returnPrice,
        public ?string $note,
        public bool $shouldReturnItems,
        public bool $compensateShippingCosts,
        public bool $isCancelled,
        public bool $canCancel,
        public array $items,
        public Carbon $createdAt,
        public Carbon $updatedAt,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            returnRequestNumber: $data['return_request_number'],
            status: ReturnRequestStatusEnum::from($data['status']),
            statusHistory: array_map(
                fn (array $statusData) => ReturnRequestStatusDto::fromArray($statusData),
                $data['status_history']
            ),
            type: ReturnRequestTypeEnum::from($data['type']),
            title: $data['title'],
            totalQuantity: $data['total_quantity'],
            returnPrice: $data['return_price'],
            note: $data['note'] ?? null,
            shouldReturnItems: $data['should_return_items'],
            compensateShippingCosts: $data['compensate_shipping_costs'],
            isCancelled: $data['is_cancelled'],
            canCancel: $data['can_cancel'],
            items: array_map(
                fn (array $itemData) => ReturnRequestItemDto::fromArray($itemData),
                $data['items'] ?? []
            ),
            createdAt: Carbon::parse($data['created_at']),
            updatedAt: Carbon::parse($data['updated_at']),
        );
    }
}
