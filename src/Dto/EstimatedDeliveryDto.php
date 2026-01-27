<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class EstimatedDeliveryDto
{
    public function __construct(
        public int $shippingRuleId,
        public string $cutoffDay,
        public string $cutoffTime,
        public bool $cutoffIsToday,
        public bool $cutoffIsTomorrow,
        public string $firstDay,
        public string $lastDay,
        public bool $hasRange,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            shippingRuleId: $data['shipping_rule_id'],
            cutoffDay: $data['cutoff_day'],
            cutoffTime: $data['cutoff_time'],
            cutoffIsToday: $data['cutoff_is_today'],
            cutoffIsTomorrow: $data['cutoff_is_tomorrow'],
            firstDay: $data['first_day'],
            lastDay: $data['last_day'],
            hasRange: $data['has_range'],
        );
    }
}
