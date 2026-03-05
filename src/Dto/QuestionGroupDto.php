<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class QuestionGroupDto
{
    /**
     * @param  QuestionDto[]  $questions
     */
    public function __construct(
        public string $name,
        public ?string $icon,
        public array $questions,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            icon: $data['icon'] ?? null,
            questions: array_map(
                fn (array $row) => QuestionDto::fromArray($row),
                $data['questions'] ?? []
            )
        );
    }
}
