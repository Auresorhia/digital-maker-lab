<?php

namespace App\Models;

class QuizAnswerModel 
{
    private ?int $id;
    private string $answerText;
    private int $questionId; // Correspond bien à question_id dans ta table quiz_job_answer
    private ?string $explanation; // Commentaire ou explication de la réponse
    private bool $isCorrect; // true = Bonne réponse / false = Mauvaise réponse

    public function __construct(?int $id, string $answerText, int $questionId, ?string $explanation, bool $isCorrect) 
    {
        $this->id = $id;
        $this->answerText = $answerText;
        $this->questionId = $questionId;
        $this->explanation = $explanation;
        $this->isCorrect = $isCorrect;
    }

    // Getters pour récupérer et afficher les informations dans tes Vues (Views)
    public function getId(): ?int { return $this->id; }
    public function getAnswerText(): string { return $this->answerText; }
    public function getQuestionId(): int { return $this->questionId; }
    public function getExplanation(): ?string { return $this->explanation; }
    public function isCorrect(): bool { return $this->isCorrect; }
}