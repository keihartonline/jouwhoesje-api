<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use Illuminate\Support\Carbon;
use KeihartOnline\JouwHoesjeApi\Enums\InvoiceTypeEnum;

final readonly class InvoiceDto
{
    public function __construct(
        public string $invoiceNumber,
        public InvoiceTypeEnum $type,
        public Carbon $invoiceDate,
        public bool $isAvailable,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            invoiceNumber: $data['invoice_number'],
            type: InvoiceTypeEnum::from($data['type']),
            invoiceDate: Carbon::parse($data['invoice_date']),
            isAvailable: (bool) ($data['is_available'] ?? false),
        );
    }

    public static function fromNullableArray(?array $data): ?self
    {
        return blank($data) ? null : self::fromArray($data);
    }
}
