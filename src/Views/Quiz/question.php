<?php
/** * @var App\Models\Quiz\QuizQuestionModel[] $questions 
 * @var string $specialtyTitle
 * @var int $jobId
 */
$totalQuestions = count($questions);
?>

<div id="quiz-game-container">
    <?php foreach ($questions as $index => $question): 
        $answers = $question->getAnswers();
        $answerA = $answers[0] ?? null;
        $answerB = $answers[1] ?? null;
    ?>
        <div class="question-step <?= $index === 0 ? 'active' : '' ?>" data-step="<?= $index ?>">
            
            <div class="question-counter">
                QUESTION <?= ($index + 1) ?>/<?= $totalQuestions ?>
            </div>

            <h2 class="question-text">
                <?= htmlspecialchars($question->getQuestionText()) ?>
            </h2>

            <div class="answers-binary-grid" id="grid-<?= $index ?>">
                <?php if ($answerA): ?>
                    <button type="button" 
                            id="btn-answer-<?= $answerA->getId() ?>"
                            class="answer-btn btn-left" 
                            onclick="handleVote(<?= $index ?>, <?= $answerA->getId() ?>, <?= $answerB ? $answerB->getId() : 'null' ?>, <?= $answerA->isCorrect() ? 'true' : 'false' ?>, '<?= addslashes($answerA->getAnswerText()) ?>')">
                        <span><?= htmlspecialchars($answerA->getAnswerText()) ?></span>
                    </button>
                <?php endif; ?>

                <?php if ($answerB): ?>
                    <button type="button" 
                            id="btn-answer-<?= $answerB->getId() ?>"
                            class="answer-btn btn-right" 
                            onclick="handleVote(<?= $index ?>, <?= $answerB->getId() ?>, <?= $answerA ? $answerA->getId() : 'null' ?>, <?= $answerB->isCorrect() ? 'true' : 'false' ?>, '<?= addslashes($answerB->getAnswerText()) ?>')">
                        <span><?= htmlspecialchars($answerB->getAnswerText()) ?></span>
                    </button>
                <?php endif; ?>
            </div>

            <div class="correction-block" id="correction-<?= $index ?>" style="display: none;">
                <div class="user-answer-title" id="verdict-title-<?= $index ?>"></div>
                
                <?php 
                $explanation = '';
                foreach ($answers as $ans) {
                    if ($ans->isCorrect() && !empty($ans->getExplanation())) {
                        $explanation = $ans->getExplanation();
                        break;
                    }
                }
                if (!empty($explanation)): 
                ?>
                    <p class="explanation-text"><strong>Explication :</strong> <?= htmlspecialchars($explanation) ?></p>
                <?php endif; ?>

                <button type="button" class="btn-next" onclick="nextStep(<?= $index ?>, <?= $totalQuestions ?>)">
                    Question suivante
                </button>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div id="quiz-results-container" style="display: none;">
    <button class="close-btn">&times;</button>

    <div class="quiz-header">
        <h1 class="job-title"><?= htmlspecialchars($specialtyTitle ?? 'Motion designer') ?></h1>
    </div>

    <div class="score-banner">
        <div class="banner-content">
            <div class="thumb-icon">👍</div>
            <div class="score-text">
                <h2>Bien joué !</h2>
                <p><strong id="live-score-display">0</strong> bonne(s) réponse(s) !</p>
            </div>
        </div>
    </div>

    <div class="responses-section">
        <h3>VOS RÉPONSES</h3>
        
        <div class="responses-grid" id="js-responses-grid"></div>
    </div>

    <div class="quiz-footer">
        <p class="motivation-text">Believe croit en tes rêves ça va le faire</p>
        <button class="btn-retry" onclick="window.location.reload();">
            Réessayer ↻
        </button>
    </div>
</div>

<script>
// Variables globales pour stocker temporairement les résultats sans BDD
let userScore = 0;
let quizHistory = [];

function handleVote(currentIndex, clickedId, otherId, isCorrect, chosenText) {
    const gridDiv = document.getElementById(`grid-${currentIndex}`);
    const clickedBtn = document.getElementById(`btn-answer-${clickedId}`);
    const otherBtn = document.getElementById(`btn-answer-${otherId}`);
    const titleDiv = document.getElementById(`verdict-title-${currentIndex}`);
    const correctionDiv = document.getElementById(`correction-${currentIndex}`);

    // 1. Bloquer les boutons pour éviter le spam
    clickedBtn.disabled = true;
    if (otherBtn) otherBtn.disabled = true;

    // 2. Enregistrer le choix pour le récapitulatif final
    quizHistory.push({
        questionNumber: currentIndex + 1,
        userChoice: chosenText,
        isCorrect: isCorrect
    });

    // 3. ANIMATION DES COULEURS (Verdict immédiat)
    let correctText = chosenText; 
    
    if (isCorrect) {
        clickedBtn.classList.add('btn-correct'); // Devient Vert
    } else {
        clickedBtn.classList.add('btn-incorrect'); // Devient Rouge
        if (otherBtn) {
            otherBtn.classList.add('btn-correct'); // La bonne réponse s'allume en Vert
            correctText = otherBtn.innerText.trim();
        }
    }

    // 4. Préparer le texte de la bonne réponse finale en violet
    titleDiv.innerHTML = `<span style="color: #6366f1; font-size: 1.8rem; font-weight: bold; display: block; margin-bottom: 10px;">${correctText}</span>`;

    // 5. TRANSITION (Après 1 seconde de couleur, on nettoie pour coller à ta maquette)
    setTimeout(() => {
        // Disparition de la grille de boutons colorés
        gridDiv.style.display = 'none';
        
        // Apparition de la bonne réponse + explication + bouton suivante
        correctionDiv.style.display = 'block';
    }, 1000); // 1000 millisecondes = 1 seconde d'affichage des boutons colorés
}

function nextStep(currentIndex, totalQuestions) {
    const currentStepEl = document.querySelector(`[data-step="${currentIndex}"]`);
    
    if (currentIndex + 1 < totalQuestions) {
        // Passer à la question suivante
        currentStepEl.classList.remove('active');
        const nextStepEl = document.querySelector(`[data-step="${currentIndex + 1}"]`);
        nextStepEl.classList.add('active');
    } else {
        // 🔥 FIN DU QUIZ : Pas de route ! On construit le récap en JS à la volée
        buildAndShowRecap();
    }
}

function buildAndShowRecap() {
    // 1. Cacher le bloc du jeu de questions
    document.getElementById('quiz-game-container').style.display = 'none';
    
    // 2. Mettre à jour le score dans la bannière violette
    document.getElementById('live-score-display').innerText = userScore;
    
    // 3. Générer la grille des 10 badges selon les choix stockés
    const gridContainer = document.getElementById('js-responses-grid');
    gridContainer.innerHTML = ''; // Nettoyage
    
    quizHistory.forEach(item => {
        const badgeClass = item.isCorrect ? 'is-good' : 'is-wrong';
        const icon = item.isCorrect ? '✓' : '×';
        
        const badgeHtml = `
            <div class="response-badge ${badgeClass}">
                <span class="badge-icon">${icon}</span>
                <span class="badge-text">
                    Question ${item.questionNumber} <strong class="user-choice">${item.userChoice}</strong>
                </span>
            </div>
        `;
        gridContainer.insertAdjacentHTML('beforeend', badgeHtml);
    });
    
    // 4. Afficher le superbe récapitulatif
    document.getElementById('quiz-results-container').style.display = 'block';
}
</script>