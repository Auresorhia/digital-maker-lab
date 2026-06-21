<?php
/** @var array $_SESSION['quiz_results'] */

// Récupération des données du quiz stockées en session par le contrôleur
$results = $_SESSION['quiz_results'] ?? null;

if (!$results) {
    echo "<p>Aucun résultat de quiz trouvé. Veuillez repasser le quiz.</p>";
    exit;
}

$score = $results['score'];
$totalQuestions = $results['total_questions'];
$details = $results['details']; // Contient l'historique des 10 questions
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats du Quiz</title>
    <link rel="stylesheet" href="css/quiz/answer.css"> </head>
<body>

<div class="quiz-results-container">
    
    <button class="close-btn" onclick="window.location.href='index.php'">&times;</button>

    <div class="quiz-header">
        <h1 class="job-title"><?= htmlspecialchars($specialtyTitle ?? 'Motion designer') ?></h1>
    </div>

    <div class="score-banner">
        <div class="banner-content">
            <div class="thumb-icon">👍</div>
            <div class="score-text">
                <h2>Bien joué !</h2>
                <p><strong><?= $score ?></strong> <?= $score > 1 ? 'bonnes réponses' : 'bonne réponse' ?> !</p>
            </div>
        </div>
    </div>

    <div class="responses-section">
        <h3>VOS RÉPONSES</h3>
        
        <div class="responses-grid">
            <?php 
            $counter = 1;
            foreach ($details as $qId => $item): 
                // Vérification si la question est juste ou fausse pour appliquer la bonne classe
                $statusClass = $item['is_correct'] ? 'is-good' : 'is-wrong';
                $icon = $item['is_correct'] ? '✓' : '×';
                
                // Si l'utilisateur n'a rien coché (cas rare)
                $userAnswerText = $item['user_answer_id'] ? ($item['is_correct'] ? $item['correct_answer'] : ($item['user_answer_id'] == 1 ? 'Vrai' : 'Faux')) : 'Aucune';
                
                // Pour coller à ta maquette (afficher Vrai ou Faux proprement)
                // Si la bonne réponse est affichée ou si on doit la deviner :
                if (strtolower($item['correct_answer']) === 'vrai') {
                    $userAnswerText = $item['is_correct'] ? 'Vrai' : 'Faux';
                } elseif (strtolower($item['correct_answer']) === 'faux') {
                    $userAnswerText = $item['is_correct'] ? 'Faux' : 'Vrai';
                }
            ?>
                <div class="response-badge <?= $statusClass ?>">
                    <span class="badge-icon"><?= $icon ?></span>
                    <span class="badge-text">
                        Question <?= $counter ?> <strong class="user-choice"><?= htmlspecialchars($userAnswerText) ?></strong>
                    </span>
                </div>
            <?php 
                $counter++;
            endforeach; 
            ?>
        </div>
    </div>

    <div class="quiz-footer">
        <p class="motivation-text">Believe croit en tes rêves ça va le faire</p>
        <button class="btn-retry" onclick="window.location.href='index.php?action=quiz&job_id=<?= $results['job_id'] ?>'">
            Réessayer ↻
        </button>
    </div>
</div>

</body>
</html>