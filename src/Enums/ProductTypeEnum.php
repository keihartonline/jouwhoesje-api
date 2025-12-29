<?php

namespace KeihartOnline\JouwHoesjeApi\Enums;

enum ProductTypeEnum: string
{
    case COVER = 'cover';
    case CUSTOM_DESIGN = 'custom-design';
    case SCREEN_PROTECTOR = 'screen-protector';
    case CAMERA_PROTECTOR = 'camera-protector';
    case PHONE_CORD = 'phone-cord';
    case CROSSBODY_CORD = 'crossbody-cord';
    case CHARGING_CABLE = 'charging-cable';
    case GIFT_PACKAGING = 'gift-packaging';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::COVER => 'Hoesje',
            self::CUSTOM_DESIGN => 'Gepersonaliseerd hoesje',
            self::SCREEN_PROTECTOR => 'Screen protector',
            self::CAMERA_PROTECTOR => 'Camera protector',
            self::PHONE_CORD => 'Telefoonkoord universeel',
            self::CROSSBODY_CORD => 'Crossbody koord',
            self::CHARGING_CABLE => 'Oplaadkabel',
            self::GIFT_PACKAGING => 'Cadeauverpakking',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(
            fn ($item) => [$item->value => self::getLabel($item)]
        )->toArray();
    }
}
