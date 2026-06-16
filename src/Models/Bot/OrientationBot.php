<?php

namespace Models\Bot;

class OrientationBot
{
    private array $questions;
    private array $profiles;

    public function __construct(array $questions, array $profiles)
    {
        $this->questions = $questions;
        $this->profiles = $profiles;
    }

    public static function createDefault(): self
    {
        return new self(
            OrientationData::getQuestions(),
            OrientationData::getProfiles()
        );
    }

    public function getQuestions(): array
    {
        return $this->questions;
    }

    public function getProfiles(): array
    {
        return $this->profiles;
    }

    public function getFirstQuestion(): ?Question
    {
        return $this->getQuestionById('start');
    }

    public function getQuestionById(string $questionId): ?Question
    {
        foreach ($this->questions as $question) {
            if ($question->getId() === $questionId) {
                return $question;
            }
        }

        return null;
    }

    public function getProfileByKey(string $profileKey): ?Profile
    {
        foreach ($this->profiles as $profile) {
            if ($profile->getKey() === $profileKey) {
                return $profile;
            }
        }

        return null;
    }
}