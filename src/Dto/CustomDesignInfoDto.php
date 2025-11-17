<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class CustomDesignInfoDto
{
    /**
     * @param  CustomDesignGroupDto[]  $groups
     * @param  MediaDto[]  $media
     */
    public function __construct(
        public string $sku,
        public array $prices,
        public array $groupNames,
        public int $groupsCount,
        public int $optionsCount,
        public array $groups,
        public array $media,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            sku: $data['sku'],
            prices: $data['prices'],
            groupNames: $data['group_names'],
            groupsCount: $data['groups_count'] ?? 0,
            optionsCount: $data['options_count'] ?? 0,
            groups: array_map(
                fn (array $row) => CustomDesignGroupDto::fromArray($row),
                $data['groups']
            ),
            media: array_map(
                fn (array $row) => MediaDto::fromArray($row),
                $data['media']
            ),
        );
    }
}
