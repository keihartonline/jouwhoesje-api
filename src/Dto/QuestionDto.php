<?php

namespace KeihartOnline\JouwHoesjeApi\Dto;

final readonly class QuestionDto
{
    public function __construct(
        public string $title,
        public string $content,
        public array $tags,
        public ?QuestionGroupDto $group,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            title: $data['title'],
            content: $data['content'],
            tags: $data['tags'] ?? [],
            group: isset($data['group'])
                ? QuestionGroupDto::fromArray($data['group'])
                : null,
        );
    }
}
