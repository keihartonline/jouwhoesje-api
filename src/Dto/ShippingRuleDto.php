<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class ShippingRuleDto
{
    public function __construct(
        public int $shippingRuleId,
        public string $name,
        public bool $tracking,
        public int $price,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            shippingRuleId: $data['shipping_rule_id'],
            name: $data['name'],
            tracking: $data['tracking'],
            price: $data['price'],
        );
    }
}
