<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use Illuminate\Support\Carbon;

final readonly class EstimatedDeliveryDto
{
    public function __construct(
        public int $shippingRuleId,
        public Carbon $cutoff,
        public Carbon $firstDay,
        public Carbon $lastDay,
        public bool $hasRange,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            shippingRuleId: $data['shipping_rule_id'],
            cutoff: Carbon::parse($data['cutoff']),
            firstDay: Carbon::parse($data['first_day']),
            lastDay: Carbon::parse($data['last_day']),
            hasRange: $data['has_range'],
        );
    }
}
