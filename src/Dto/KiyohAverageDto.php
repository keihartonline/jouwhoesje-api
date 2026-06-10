<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use Illuminate\Support\Carbon;
use KeihartOnline\JouwHoesjeApi\Enums\StarEnum;

final readonly class KiyohAverageDto
{
    public function __construct(
        public float $averageRating,
        public int $numberReviews,
        public float $yearAverageRating,
        public int $yearNumberReviews,
        public string $viewReviewUrl,
        public string $createReviewUrl,
        public Carbon $lastUpdate,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            averageRating: $data['average_rating'],
            numberReviews: $data['number_reviews'],
            yearAverageRating: $data['year_average_rating'],
            yearNumberReviews: $data['year_number_reviews'],
            viewReviewUrl: $data['view_review_url'],
            createReviewUrl: $data['create_review_url'],
            lastUpdate: Carbon::parse($data['last_update']),
        );
    }

    public function getYearAverageRatingFirstPart(): int
    {
        return intdiv((int) round($this->yearAverageRating * 10), 10);
    }

    public function getYearAverageRatingSecondPart(): int
    {
        return ((int) round($this->yearAverageRating * 10)) % 10;
    }

    /**
     * @return StarEnum[]
     */
    public function getStars(): array
    {
        $halves = (int) round($this->yearAverageRating);

        return array_map(
            fn (int $i) => match (true) {
                $halves >= $i * 2 => StarEnum::FULL,
                $halves === $i * 2 - 1 => StarEnum::HALF,
                default => StarEnum::EMPTY,
            },
            range(1, 5),
        );
    }
}
