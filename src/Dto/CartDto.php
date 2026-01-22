<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use Illuminate\Support\Carbon;
use KeihartOnline\JouwHoesjeApi\Enums\CartErrorEnum;

final readonly class CartDto
{
    /**
     * @param  CartItemDto[]  $items
     * @param  CartErrorEnum[]  $errors
     */
    public function __construct(
        public string $cartToken,
        public int $totalQuantity,
        public int $totalPriceGross,
        public int $totalPriceNet,
        public int $totalGiftPackagingGross,
        public int $totalGiftPackagingNet,
        public int $totalProductsGross,
        public int $totalProductsNet,
        public int $totalVat,
        public int $minimumOrderValue,
        public bool $isShippable,
        public bool $isPayable,
        public bool $isCompany,
        public bool $vatDeferred,
        public ?string $email,
        public ?string $companyName,
        public bool $useAlternativeShippingAddress,
        public AddressDto $invoiceAddress,
        public AddressDto $shippingAddress,
        public int $vatRate,
        public array $items,
        public array $messages,
        public array $errors,
        public Carbon $createdAt,
        public Carbon $updatedAt,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            cartToken: $data['cart_token'],
            totalQuantity: (int) ($data['total_quantity'] ?? 0),
            totalPriceGross: (int) ($data['total_price_gross'] ?? 0),
            totalPriceNet: (int) ($data['total_price_net'] ?? 0),
            totalGiftPackagingGross: (int) ($data['total_gift_packaging_gross'] ?? 0),
            totalGiftPackagingNet: (int) ($data['total_gift_packaging_net'] ?? 0),
            totalProductsGross: (int) ($data['total_products_gross'] ?? 0),
            totalProductsNet: (int) ($data['total_products_net'] ?? 0),
            totalVat: (int) ($data['total_vat'] ?? 0),
            minimumOrderValue: (int) ($data['minimum_order_value'] ?? 0),
            isShippable: (bool) ($data['is_shippable'] ?? 0),
            isPayable: (bool) ($data['is_payable'] ?? 0),
            isCompany: (bool) ($data['is_company'] ?? 0),
            vatDeferred: (bool) ($data['vat_deferred'] ?? 0),
            email: $data['email'],
            companyName: $data['company_name'],
            useAlternativeShippingAddress: (bool) ($data['use_alternative_shipping_address'] ?? 0),
            invoiceAddress: AddressDto::fromArray($data['invoice_address'] ?? []),
            shippingAddress: AddressDto::fromArray($data['shipping_address'] ?? []),
            vatRate: $data['vat_rate'],
            items: array_map(
                fn (array $itemData) => CartItemDto::fromArray($itemData),
                $data['items'] ?? []
            ),
            messages: array_map(
                fn (array $messageData) => CartMessageDto::fromArray($messageData),
                $data['messages'] ?? []
            ),
            errors: array_map(
                fn (string $error) => CartErrorEnum::from($error),
                $data['errors'] ?? []
            ),
            createdAt: Carbon::parse($data['created_at']),
            updatedAt: Carbon::parse($data['updated_at']),
        );
    }
}
