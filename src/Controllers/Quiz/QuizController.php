<?php

class QuizController extends Controller
{
    private QuizModel $quizModel;

    public function __construct() 
    {
        // Appel du constructeur parent si nécessaire (ex: initialisations globales)
        if (method_exists('Controller', '__construct')) {
            parent::__construct();
        }
        
        // Démarrage de la session de manière sécurisée
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // L'instanciation se fait maintenant sans lui passer $db
        $this->quizModel = new QuizModel();
    }

    /**
     * Action 1 : Afficher le quiz complet d'un métier
     */
    public function show(int $jobId): void 
    {
        // 1. Récupération des questions du quiz
        $questions = $this->quizModel->findByJobWithAnswers($jobId);

        if (empty($questions)) {
            echo "Aucun quiz disponible pour ce métier actuellement.";
            return;
        }

        // 2. Récupération de la spécialité grâce au chaînage des modèles (sans $db)
        $jobModel = new JobModel();
        $job = $jobModel->findById($jobId);

        $specialtyTitle = 'Spécialité'; // Titre par défaut si non trouvé

        if ($job && isset($job['specialty_id'])) {
            $specialtyModel = new SpecialtyModel();
            $specialty = $specialtyModel->findById((int)$job['specialty_id']);
            
            if ($specialty) {
                // Adapte 'specialty_name' ou 'name' selon ta base de données
                $specialtyTitle = $specialty['specialty_name'] ?? $specialty['name'] ?? 'Spécialité';
            }
        }

        // 3. Transmission à la vue
        require_once __DIR__ . '/../../Views/quiz/question.php';
    }

    /**
     * Action 2 : Traiter la soumission finale, calculer le score et afficher le verdict
     */
    public function submit(int $jobId, array $userAnswers): void 
    {
        $questions = $this->quizModel->findByJobWithAnswers($jobId);
        
        $score = 0;
        $totalQuestions = count($questions);
        $resultsDetail = [];

        foreach ($questions as $question) {
            $questionId = $question->getId();
            $chosenAnswerId = isset($userAnswers[$questionId]) ? (int)$userAnswers[$questionId] : null;
            
            $isCorrect = false;
            $correctAnswerText = '';
            $explanation = '';

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

            $resultsDetail[$questionId] = [
                'question' => $question->getQuestionText(),
                'user_answer_id' => $chosenAnswerId,
                'is_correct' => $isCorrect,
                'correct_answer' => $correctAnswerText,
                'explanation' => $explanation
            ];
        }

        // Récupération rapide du titre de la spécialité pour la page answer.php (sans $db)
        $jobModel = new JobModel();
        $job = $jobModel->findById($jobId);
        $specialtyTitle = 'Spécialité';
        
        if ($job && isset($job['specialty_id'])) {
            $specialtyModel = new SpecialtyModel();
            $specialty = $specialtyModel->findById((int)$job['specialty_id']);
            $specialtyTitle = $specialty ? ($specialty['specialty_name'] ?? $specialty['name'] ?? 'Spécialité') : 'Spécialité';
        }

        $_SESSION['quiz_results'] = [
            'job_id'          => $jobId,
            'score'           => $score,
            'total_questions' => $totalQuestions,
            'details'         => $resultsDetail,
            'percentage'      => $totalQuestions > 0 ? round(($score / $totalQuestions) * 100) : 0
        ];

        require_once __DIR__ . '/../../Views/quiz/answer.php';
        exit;
    }
}