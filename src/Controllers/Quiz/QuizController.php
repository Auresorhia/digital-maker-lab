<?php

namespace App\Controllers;

use PDO;
use App\Models\Quiz\QuizModel;

class QuizController 
{
    private QuizModel $quizModel;

    public function __construct(PDO $db) 
    {
        // On s'assure que la session est démarrée pour stocker le score
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Instanciation du modèle de Quiz
        $this->quizModel = new QuizModel($db);
    }

    /**
     * Action 1 : Afficher le quiz d'un métier
     */
    public function show(int $jobId): void 
    {
        // 1. Récupération des questions hydratées avec leurs réponses
        $questions = $this->quizModel->findByJobWithAnswers($jobId);

        if (empty($questions)) {
            echo "Aucun quiz disponible pour ce métier actuellement.";
            return;
        }

        // 2. On transmet les données à la vue (adapter le chemin selon ton architecture)
        // require_once __DIR__ . '/../Views/quiz/show.php';
        
        // Pour le test visuel rapide, on peut faire un dump ou passer à la vue :
        echo "<h2>Contrôleur : Quiz récupéré avec succès ! ready à être affiché.</h2>";
    }

    /**
     * Action 2 : Traiter la soumission du formulaire et calculer le score
     */
    public function submit(int $jobId, array $userAnswers): void 
    {
        // 1. On récupère le quiz de référence pour vérifier les bonnes réponses
        $questions = $this->quizModel->findByJobWithAnswers($jobId);
        
        $score = 0;
        $totalQuestions = count($questions);
        $resultsDetail = []; // Pour afficher les corrections à l'utilisateur

        foreach ($questions as $question) {
            $questionId = $question->getId();
            
            // On récupère l'ID de la réponse cochée par l'utilisateur pour cette question
            $chosenAnswerId = isset($userAnswers[$questionId]) ? (int)$userAnswers[$questionId] : null;
            
            $isCorrect = false;
            $correctAnswerText = '';
            $explanation = '';

            // On parcourt les réponses de la question pour trouver la bonne et comparer
            foreach ($question->getAnswers() as $answer) {
                if ($answer->isCorrect()) {
                    $correctAnswerText = $answer->getAnswerText();
                    $explanation = $answer->getExplanation();
                }
                
                if ($chosenAnswerId !== null && $answer->getId() === $chosenAnswerId && $answer->isCorrect()) {
                    $isCorrect = true;
                }
            }

            if ($isCorrect) {
                $score++;
            }

            // On stocke le détail pour la page de résultat
            $resultsDetail[$questionId] = [
                'question' => $question->getQuestionText(),
                'user_answer_id' => $chosenAnswerId,
                'is_correct' => $isCorrect,
                'correct_answer' => $correctAnswerText,
                'explanation' => $explanation
            ];
        }

        // 2. Sauvegarde des données dans la Superglobale $_SESSION
        $_SESSION['quiz_results'] = [
            'job_id'          => $jobId,
            'score'           => $score,
            'total_questions' => $totalQuestions,
            'details'         => $resultsDetail,
            'percentage'      => $totalQuestions > 0 ? round(($score / $totalQuestions) * 100) : 0
        ];

        // 3. Redirection vers la page de résultat (ex: result.php)
        // header("Location: /quiz/result");
        // exit;
        
        echo "<h2>Contrôleur : Score calculé et mis en session !</h2>";
        echo "<p>Score : <strong>$score / $totalQuestions</strong></p>";
    }
}