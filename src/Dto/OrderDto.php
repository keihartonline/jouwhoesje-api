<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use Illuminate\Support\Carbon;
use KeihartOnline\JouwHoesjeApi\Enums\OrderStatusEnum;

final readonly class OrderDto
{
    public function __construct(
        public string $orderNumber,
        public OrderStatusEnum $status,
        public string $email,
        public int $vatRate,
        public bool $isCompany,
        public ?string $companyName,
        public ?string $vatNumber,
        public int $totalPriceGross,
        public int $shippingCostsGross,
        public AddressDto $invoiceAddress,
        public ?AddressDto $shippingAddress,
        public ShippingRuleDto $shippingRule,
        public Carbon $createdAt,
        public Carbon $updatedAt,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            orderNumber: $data['order_number'],
            status: OrderStatusEnum::from($data['status']),
            email: $data['email'],
            vatRate: (int) ($data['vat_rate'] ?? 0),
            isCompany: (bool) ($data['is_company'] ?? 0),
            companyName: $data['company_name'] ?? null,
            vatNumber: $data['vat_number'] ?? null,
            totalPriceGross: (int) ($data['total_price_gross'] ?? 0),
            shippingCostsGross: (int) ($data['shipping_costs_gross'] ?? 0),
            invoiceAddress: AddressDto::fromArray($data['invoice_address'] ?? []),
            shippingAddress: ! blank($data['shipping_address'])
                ? AddressDto::fromArray($data['shipping_address'])
                : null,
            shippingRule: ShippingRuleDto::fromArray($data['shipping_rule']),
            createdAt: Carbon::parse($data['created_at']),
            updatedAt: Carbon::parse($data['updated_at']),
        );
    }
}
