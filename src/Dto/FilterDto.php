<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use JsonSerializable;
use KeihartOnline\JouwHoesjeApi\Enums\FilterTypeEnum;

final readonly class FilterDto implements Arrayable, JsonSerializable
{
    /**
     * @param  FilterOptionDto[]|FilterOptionGroupDto[]  $options
     */
    public function __construct(
        public FilterTypeEnum $filterType,
        public string $name,
        public string $label,
        public int $count,
        public array $options,
        public bool $hasOptionGroups = false,
        public bool $searchable = false,
    ) {}

    public function toArray(): array
    {
        return self::toSnakeArray(get_object_vars($this));
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    private static function toSnakeArray(mixed $value): mixed
    {
        if (is_array($value)) {
            $out = [];
            foreach ($value as $k => $v) {
                $out[is_string($k) ? Str::snake($k) : $k] = self::toSnakeArray($v);
            }
            return $out;
        }
        if (is_object($value)) {
            $vars = get_object_vars($value);
            $out = [];
            foreach ($vars as $k => $v) {
                $out[Str::snake($k)] = self::toSnakeArray($v);
            }
            return $out;
        }
        return $value;
    }

    public static function fromArray(array $data): self
    {
        $firstOption = Arr::first($data['options']);
        $hasOptionGroups = false;

        if ($firstOption !== null && array_key_exists('options', $firstOption) && is_array($firstOption['options'])) {
            $options = array_map(
                fn (array $optionGroupData) => FilterOptionGroupDto::fromArray($optionGroupData),
                $data['options']
            );
            $hasOptionGroups = true;
        } else {
            $options = array_map(
                fn (array $optionData) => FilterOptionDto::fromArray($optionData),
                $data['options'] ?? []
            );
        }

        return new self(
            filterType: FilterTypeEnum::from($data['filter_type']),
            name: $data['name'],
            label: $data['label'],
            count: $data['count'],
            options: $options,
            hasOptionGroups: $hasOptionGroups,
            searchable: $data['searchable'],
        );
    }
}
