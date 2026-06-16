<?php

namespace App\Models;

class QuizQuestionModel 
{
    private ?int $id;
    private string $questionText;
    private int $jobId; // Correspond à job_id dans ta base de données
    private string $level; // 'easy', 'medium', 'hard'
    private array $answers = []; // Contiendra les objets QuizMetierAnswer

    public function __construct(?int $id, string $questionText, int $jobId, string $level) 
    {
        $this->id = $id;
        $this->questionText = $questionText;
        $this->jobId = $jobId;
        $this->level = $level;
    }

    // Getters
    public function getId(): ?int { return $this->id; }
    public function getQuestionText(): string { return $this->questionText; }
    public function getJobId(): int { return $this->jobId; }
    public function getLevel(): string { return $this->level; }
    
    // Gestion des réponses liées
    public function getAnswers(): array { return $this->answers; }
    public function setAnswers(array $answers): void { $this->answers = $answers; }
    public function addAnswer(QuizAnswerModel $answer): void { $this->answers[] = $answer; }
}