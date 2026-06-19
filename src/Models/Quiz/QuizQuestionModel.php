<?php
require_once __DIR__ . '/../../core/Model.php';
require_once __DIR__ . '/QuizAnswerModel.php';

class QuizQuestionModel extends Model
{
    private ?int $id = null;
    private string $questionText = '';
    private int $jobId = 0; 
    private string $level = ''; 
    private array $answers = []; 



    // Getters & Setters (Pour l'hydratation manuelle ou automatique)
    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): void { $this->id = $id; }

    public function getQuestionText(): string { return $this->questionText; }
    public function setQuestionText(string $questionText): void { $this->questionText = $questionText; }

    public function getJobId(): int { return $this->jobId; }
    public function setJobId(int $jobId): void { $this->jobId = $jobId; }

    public function getLevel(): string { return $this->level; }
    public function setLevel(string $level): void { $this->level = $level; }
    
    // Gestion des réponses liées
    public function getAnswers(): array { return $this->answers; }
    public function setAnswers(array $answers): void { $this->answers = $answers; }
    public function addAnswer(QuizAnswerModel $answer): void { $this->answers[] = $answer; }
}