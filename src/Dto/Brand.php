<?php

namespace App\Api\DTO;

class Brand
{
    public int $brandId;

    public string $name;

    public string $slug;

    public int $sellableCovers;

    /**
     * @param  array<string, mixed>  $data
     */
    public function __construct(array $data)
    {
        $this->brandId = $data['brand_id'];
        $this->name = $data['name'];
        $this->slug = $data['slug'];
        $this->sellableCovers = $data['sellable_covers'];
    }

    /**
     * @param  array<string, mixed>  $response
     */
    public static function fromResponse(array $response): self
    {
        return new self($response);
    }
}
