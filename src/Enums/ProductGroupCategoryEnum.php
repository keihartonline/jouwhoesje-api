<?php

namespace KeihartOnline\JouwHoesjeApi\Enums;

enum ProductGroupCategoryEnum: string
{
    case BACK_PRINTED = 'back-printed';
    case FULLY_PRINTED = 'fully-printed';
    case BOOK_CASES = 'book-cases';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::BACK_PRINTED => 'Hoesje met bedrukking op achterkant',
            self::FULLY_PRINTED => 'Hoesje met volledige bedrukking',
            self::BOOK_CASES => 'Portemonnee hoesje (Bookcase)',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(
            fn ($item) => [$item->value => self::getLabel($item)]
        )->toArray();
    }
}
