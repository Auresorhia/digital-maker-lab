<?php

class QuizAnswerModel extends Model
{
    private ?int $id = null;
    private string $answerText = '';
    private int $questionId = 0; 
    private ?string $explanation = null; 
    private bool $isCorrect = false; 

    // Getters & Setters
    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): void { $this->id = $id; }

    public function getAnswerText(): string { return $this->answerText; }
    public function setAnswerText(string $answerText): void { $this->answerText = $answerText; }

    public function getQuestionId(): int { return $this->questionId; }
    public function setQuestionId(int $questionId): void { $this->questionId = $questionId; }

    public function getExplanation(): ?string { return $this->explanation; }
    public function setExplanation(?string $explanation): void { $this->explanation = $explanation; }

    public function isCorrect(): bool { return $this->isCorrect; }
    public function setIsCorrect(bool $isCorrect): void { $this->isCorrect = $isCorrect; }
}