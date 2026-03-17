<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use Illuminate\Support\Carbon;
use KeihartOnline\JouwHoesjeApi\Enums\OrderStatusEnum;

final readonly class OrderDto
{
    /**
     * @param  OrderItemDto[]  $items
     */
    public function __construct(
        public string $orderNumber,
        public OrderStatusEnum $status,
        public string $email,
        public ?string $dialCode,
        public ?string $phoneNumber,
        public int $vatRate,
        public bool $isCompany,
        public ?string $companyName,
        public ?string $vatNumber,
        public bool $readyForReturns,
        public bool $hasItemsThatCanBeReturned,
        public int $totalQuantity,
        public int $totalGross,
        public int $totalNet,
        public int $totalVat,
        public int $shippingCostsGross,
        public int $shippingCostsNet,
        public int $shippingCostsVat,
        public AddressDto $invoiceAddress,
        public ?AddressDto $shippingAddress,
        public ShippingRuleDto $shippingRule,
        public Carbon $expectedShippingDate,
        public Carbon $firstExpectedDeliveryDate,
        public Carbon $lastExpectedDeliveryDate,
        public array $items,
        public Carbon $createdAt,
        public Carbon $updatedAt,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            orderNumber: $data['order_number'],
            status: OrderStatusEnum::from($data['status']),
            email: $data['email'],
            dialCode: $data['dial_code'],
            phoneNumber: $data['phone_number'],
            vatRate: (int) ($data['vat_rate'] ?? 0),
            isCompany: (bool) ($data['is_company'] ?? 0),
            companyName: $data['company_name'] ?? null,
            vatNumber: $data['vat_number'] ?? null,
            readyForReturns: (bool) ($data['ready_for_returns'] ?? 0),
            hasItemsThatCanBeReturned: (bool) ($data['has_items_that_can_be_returned'] ?? 0),
            totalQuantity: (int) ($data['total_quantity'] ?? 0),
            totalGross: (int) ($data['total_gross'] ?? 0),
            totalNet: (int) ($data['total_net'] ?? 0),
            totalVat: (int) ($data['total_vat'] ?? 0),
            shippingCostsGross: (int) ($data['shipping_costs_gross'] ?? 0),
            shippingCostsNet: (int) ($data['shipping_costs_gross'] ?? 0),
            shippingCostsVat: (int) ($data['shipping_costs_gross'] ?? 0),
            invoiceAddress: AddressDto::fromArray($data['invoice_address'] ?? []),
            shippingAddress: ! blank($data['shipping_address'])
                ? AddressDto::fromArray($data['shipping_address'])
                : null,
            shippingRule: ShippingRuleDto::fromArray($data['shipping_rule']),
            expectedShippingDate: Carbon::parse($data['expected_shipping_date']),
            firstExpectedDeliveryDate: Carbon::parse($data['first_expected_delivery_date']),
            lastExpectedDeliveryDate: Carbon::parse($data['last_expected_delivery_date']),
            items: array_map(
                fn (array $itemData) => OrderItemDto::fromArray($itemData),
                $data['items']
            ),
            createdAt: Carbon::parse($data['created_at']),
            updatedAt: Carbon::parse($data['updated_at']),
        );
    }
}
