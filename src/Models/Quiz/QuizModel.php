<?php

namespace App\Models\Quiz;

use PDO;
use App\Models\QuizQuestionModel;
use App\Models\QuizAnswerModel;

class QuizModel 
{
    private PDO $db;

    public function __construct(PDO $db) 
    {
        $this->db = $db;
    }

    /**
     * Récupère le quiz complet d'un job (Questions + Réponses) sous forme d'objets hydratés
     */
    public function findByJobWithAnswers(int $jobId): array 
    {
        $sql = "
            SELECT 
                q.id AS q_id, q.question_text AS q_text, q.level AS q_level, q.job_id AS q_job_id,
                a.id AS a_id, a.answer_text AS a_text, a.explanation AS a_explanation, a.is_correct AS a_is_correct
            FROM quiz_job_question q
            LEFT JOIN quiz_job_answer a ON q.id = a.question_id
            WHERE q.job_id = :jobId
            ORDER BY q.id ASC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['jobId' => $jobId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $questions = [];

        foreach ($rows as $row) {
            $questionId = $row['q_id'];

            // Si la question n'a pas encore été instanciée dans notre tableau, on la crée
            if (!isset($questions[$questionId])) {
                $questions[$questionId] = new QuizQuestionModel(
                    $questionId,
                    $row['q_text'],
                    (int)$row['q_job_id'],
                    $row['q_level']
                );
            }

            // Si une réponse est liée à cette question, on l'instancie et on l'ajoute
            if ($row['a_id'] !== null) {
                $answer = new QuizAnswerModel(
                    (int)$row['a_id'],
                    $row['a_text'],
                    $questionId,
                    $row['a_explanation'],
                    (bool)$row['a_is_correct']
                );
                
                $questions[$questionId]->addAnswer($answer);
            }
        }

        // On réindexe le tableau à partir de 0 pour éviter les clés manquantes en JS/PHP
        return array_values($questions);
    }

    /**
     * Insère une nouvelle question et retourne son ID (généré par MySQL)
     */
    public function createQuestion(array $data): int 
    {
        $sql = "INSERT INTO quiz_job_question (question_text, job_id, level) 
                VALUES (:question_text, :job_id, :level)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'question_text' => $data['question_text'],
            'job_id'        => $data['job_id'],
            'level'         => $data['level']
        ]);

        return (int)$this->db->lastInsertId();
    }

    /**
     * Insère une réponse liée à une question
     */
    public function createAnswer(array $data): int 
    {
        $sql = "INSERT INTO quiz_job_answer (answer_text, question_id, explanation, is_correct) 
                VALUES (:answer_text, :question_id, :explanation, :is_correct)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'answer_text' => $data['answer_text'],
            'question_id' => $data['question_id'],
            'explanation' => $data['explanation'] ?? null,
            'is_correct'  => $data['is_correct'] ? 1 : 0 // Convertit le booléen en TINYINT (1 ou 0) pour MySQL
        ]);

        return (int)$this->db->lastInsertId();
    }
}