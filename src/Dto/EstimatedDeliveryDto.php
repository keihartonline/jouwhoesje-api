<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class EstimatedDeliveryDto
{
    public function __construct(
        public string $cutoffDay,
        public string $cutoffTime,
        public bool $cutoffIsToday,
        public bool $cutoffIsTomorrow,
        public string $expectedDeliveryDay,
        public string $expectedLastDeliveryDay,
        public bool $expectedDeliveryDayIsTomorrow,
        public bool $hasRange,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            cutoffDay: $data['cutoff_day'],
            cutoffTime: $data['cutoff_time'],
            cutoffIsToday: $data['cutoff_is_today'],
            cutoffIsTomorrow: $data['cutoff_is_tomorrow'],
            expectedDeliveryDay: $data['expected_delivery_day'],
            expectedLastDeliveryDay: $data['expected_last_delivery_day'],
            expectedDeliveryDayIsTomorrow: $data['expected_delivery_day_is_tomorrow'],
            hasRange: $data['has_range'],
        );
    }
}
