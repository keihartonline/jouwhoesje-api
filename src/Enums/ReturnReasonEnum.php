<?php

namespace KeihartOnline\JouwHoesjeApi\Enums;

enum ReturnReasonEnum: string
{
    case WRONG_ITEM_ORDERED = 'wrong-item-ordered';
    case WRONG_ITEM_SENT = 'wrong-item-sent';
    case ITEM_NOT_AS_DESCRIBED = 'item-not-as-described';
    case CHANGED_MIND = 'changed-mind';
    case COULANCE = 'coulance';
    case DEFECTIVE = 'defective';
    case OTHER = 'other';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::WRONG_ITEM_ORDERED => 'Verkeerd product besteld',
            self::ITEM_NOT_AS_DESCRIBED => 'Product niet zoals beschreven',
            self::CHANGED_MIND => 'Veranderd van gedachten',
            self::COULANCE => 'Coulance',
            self::DEFECTIVE => 'Defect',
            self::WRONG_ITEM_SENT => 'Verkeerd product verzonden',
            self::OTHER => 'Anders',
        };
    }

    public function pickableByCustomer(): bool
    {
        return self::getPickableByCustomer($this);
    }

    public static function getPickableByCustomer(self $value): bool
    {
        return match ($value) {
            self::COULANCE, self::WRONG_ITEM_SENT, self::DEFECTIVE => false,
            default => true,
        };
    }
}
