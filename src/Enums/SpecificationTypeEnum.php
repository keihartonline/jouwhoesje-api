<?php

namespace KeihartOnline\JouwHoesjeApi\Enums;

enum SpecificationTypeEnum: string
{
    case COMPATIBLE_MODELS = 'compatible-models';
    case COLOUR = 'colour';
    case MATERIAL = 'material';
    case DESIGN_COLLECTIONS = 'design-collections';
    case PRINT_SIDE = 'print-side';
    case CASE_TYPE = 'case-type';
    case DIMENSIONS_MIN = 'dimensions-min';
    case DIMENSIONS_OPTIMAL = 'dimension-optimal';
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
            self::DESIGN_COLLECTIONS => 'Collecties',
            self::PRINT_SIDE => 'Bedrukking',
            self::CASE_TYPE => 'Soort hoesje',
            self::DIMENSIONS_MIN => 'Minimale afmetingen printgebied',
            self::DIMENSIONS_OPTIMAL => 'Aanbevolen afmetingen printgebied',
            self::MAG_SAFE_COMPATIBLE => 'Geschikt voor MagSafe',
            self::ARTICLE_NUMBER => 'Artikelnummer',
        };
    }
}
