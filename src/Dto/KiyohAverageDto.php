<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

use Illuminate\Support\Carbon;

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
}
