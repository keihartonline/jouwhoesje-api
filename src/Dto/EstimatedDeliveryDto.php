<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class EstimatedDeliveryDto
{
    public function __construct(
        public int $shippingRuleId,
        public string $cutoff,
        public string $firstDay,
        public string $lastDay,
        public bool $hasRange,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            shippingRuleId: $data['shipping_rule_id'],
            cutoff: $data['cutoff'],
            firstDay: $data['first_day'],
            lastDay: $data['last_day'],
            hasRange: $data['has_range'],
        );
    }
}
