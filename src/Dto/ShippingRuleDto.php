<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use KeihartOnline\JouwHoesjeApi\Enums\ShippingLevelEnum;

final readonly class ShippingRuleDto
{
    public function __construct(
        public int $shippingRuleId,
        public ShippingLevelEnum $shippingLevel,
        public int $price,
        public bool $hasTracking,
        public string $trackingLabel,
        public string $label,
        public ?string $carrierName = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            shippingRuleId: $data['shipping_rule_id'],
            shippingLevel: ShippingLevelEnum::from($data['shipping_level']),
            price: $data['price'],
            hasTracking: $data['has_tracking'],
            trackingLabel: __($data['tracking_label']),
            label: __($data['label']),
            carrierName: $data['carrier_name'] ?? null,
        );
    }
}
