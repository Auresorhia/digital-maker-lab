<?php

namespace Models\Bot;

class Answer
{
    private string $text;
    private string $profileKey;
    private ?string $nextQuestionId;

    public function __construct(string $text, string $profileKey, ?string $nextQuestionId = null)
    {
        $this->text = $text;
        $this->profileKey = $profileKey;
        $this->nextQuestionId = $nextQuestionId;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getProfileKey(): string
    {
        return $this->profileKey;
    }

    public function getNextQuestionId(): ?string
    {
        return $this->nextQuestionId;
    }
}