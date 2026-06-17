<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use Illuminate\Support\Carbon;

final readonly class CartDto
{
    /**
     * @param  CartItemDto[]  $items
     * @param  ShippingRuleDto[]  $possibleShippingRules
     */
    public function __construct(
        public string $cartToken,
        public int $totalQuantity,
        public int $totalGross,
        public int $totalNet,
        public int $totalVat,
        public int $productsTotalGross,
        public int $productsTotalNet,
        public int $productsTotalVat,
        public int $giftPackagingTotalGross,
        public int $giftPackagingTotalNet,
        public int $giftPackagingTotalVat,
        public int $shippingCostsGross,
        public int $shippingCostsNet,
        public int $shippingCostsVat,
        public int $minimumOrderValue,
        public bool $isShippable,
        public bool $isPayable,
        public ?string $vatNumber,
        public ?string $normalizedVatNumber,
        public bool $isCompany,
        public bool $vatDeferred,
        public bool $hasBeenTouched,
        public ?string $email,
        public ?string $dialCode,
        public ?string $phoneNumber,
        public ?string $formattedPhoneNumber,
        public ?string $companyName,
        public bool $useAlternativeShippingAddress,
        public AddressDto $invoiceAddress,
        public AddressDto $shippingAddress,
        public int $vatRate,
        public ?string $vatNumberExample,
        public array $items,
        public array $messages,
        public array $errors,
        public ?ShippingRuleDto $shippingRule,
        public array $possibleShippingRules,
        public Carbon $createdAt,
        public Carbon $updatedAt,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            cartToken: $data['cart_token'],
            totalQuantity: (int) ($data['total_quantity'] ?? 0),
            totalGross: (int) ($data['total_gross'] ?? 0),
            totalNet: (int) ($data['total_net'] ?? 0),
            totalVat: (int) ($data['total_vat'] ?? 0),
            productsTotalGross: (int) ($data['products_total_gross'] ?? 0),
            productsTotalNet: (int) ($data['products_total_net'] ?? 0),
            productsTotalVat: (int) ($data['products_total_vat'] ?? 0),
            giftPackagingTotalGross: (int) ($data['gift_packaging_total_gross'] ?? 0),
            giftPackagingTotalNet: (int) ($data['gift_packaging_total_net'] ?? 0),
            giftPackagingTotalVat: (int) ($data['gift_packaging_total_vat'] ?? 0),
            shippingCostsGross: (int) ($data['shipping_costs_gross'] ?? 0),
            shippingCostsNet: (int) ($data['shipping_costs_net'] ?? 0),
            shippingCostsVat: (int) ($data['shipping_costs_vat'] ?? 0),
            minimumOrderValue: (int) ($data['minimum_order_value'] ?? 0),
            isShippable: (bool) ($data['is_shippable'] ?? 0),
            isPayable: (bool) ($data['is_payable'] ?? 0),
            vatNumber: $data['vat_number'] ?? null,
            normalizedVatNumber: $data['normalized_vat_number'] ?? null,
            isCompany: (bool) ($data['is_company'] ?? 0),
            vatDeferred: (bool) ($data['vat_deferred'] ?? 0),
            hasBeenTouched: (bool) ($data['has_been_touched'] ?? 0),
            email: $data['email'] ?? null,
            dialCode: $data['dial_code'] ?? null,
            phoneNumber: $data['phone_number'] ?? null,
            formattedPhoneNumber: $data['formatted_phone_number'] ?? null,
            companyName: $data['company_name'] ?? null,
            useAlternativeShippingAddress: (bool) ($data['use_alternative_shipping_address'] ?? 0),
            invoiceAddress: AddressDto::fromArray($data['invoice_address'] ?? []),
            shippingAddress: AddressDto::fromArray($data['shipping_address'] ?? []),
            vatRate: (int) ($data['vat_rate'] ?? 0),
            vatNumberExample: $data['vat_number_example'] ?? null,
            items: array_map(
                fn (array $itemData) => CartItemDto::fromArray($itemData),
                $data['items'] ?? []
            ),
            messages: array_map(
                fn (array $messageData) => CartMessageDto::fromArray($messageData),
                $data['messages'] ?? []
            ),
            errors: $data['errors'] ?? [],
            shippingRule: ! blank($data['shipping_rule'])
                ? ShippingRuleDto::fromArray($data['shipping_rule'])
                : null,
            possibleShippingRules: array_map(
                fn (array $ruleData) => ShippingRuleDto::fromArray($ruleData),
                $data['possible_shipping_rules'] ?? []
            ),
            createdAt: Carbon::parse($data['created_at']),
            updatedAt: Carbon::parse($data['updated_at']),
        );
    }
}
