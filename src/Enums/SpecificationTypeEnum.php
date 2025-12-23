<?php

namespace KeihartOnline\JouwHoesjeApi\Enums;

enum SpecificationTypeEnum: string
{
    case COMPATIBLE_MODELS = 'compatible-models';
    case COLOUR = 'colour';
    case MATERIAL = 'material';
    case PRINT_SIDE = 'print-side';
    case CASE_TYPE = 'case-type';
    case MAG_SAFE_COMPATIBLE = 'mag-safe-compatible';
    case ARTICLE_NUMBER = 'article-number';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::COMPATIBLE_MODELS => 'Geschikte modellen',
            self::COLOUR => 'Kleur',
            self::MATERIAL => 'Materiaal',
            self::PRINT_SIDE => 'Bedrukking',
            self::CASE_TYPE => 'Soort hoesje',
            self::MAG_SAFE_COMPATIBLE => 'Geschikt voor MagSafe',
            self::ARTICLE_NUMBER => 'Artikelnummer',
        };
    }
}
