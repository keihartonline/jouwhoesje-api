<?php

namespace KeihartOnline\JouwHoesjeApi\Enums;

enum ReturnReasonEnum: string
{
    case WRONG_ITEM_ORDERED = 'wrong-item-ordered';
    case ITEM_NOT_AS_DESCRIBED = 'item-not-as-described';
    case CHANGED_MIND = 'changed-mind';
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
            self::OTHER => 'Anders',
        };
    }
}
