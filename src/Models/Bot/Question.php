<?php

namespace Models\Bot;

class Question
{
    private string $id;
    private string $text;
    private array $answers;

    public function __construct(string $id, string $text, array $answers)
    {
        $this->id = $id;
        $this->text = $text;
        $this->answers = $answers;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getAnswers(): array
    {
        return $this->answers;
    }
}