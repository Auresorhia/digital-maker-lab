<?php
/** * @var App\Models\Quiz\QuizQuestionModel[] $questions 
 * @var string $specialtyTitle
 * @var int $jobId
 */
$totalQuestions = count($questions);
?>

<div class="popup-overlay" id="js-quiz-overlay">
    
    <div class="popup-container" id="main-popup-container">
        
        <button type="button" class="popup-close-btn" onclick="closeQuizPopup()" aria-label="Fermer"></button>
        
        <div style="position: relative; width: 100%;">
            <img src="/assets/images/quiz/banniere-quiz.svg" alt="Quiz Banner" class="popup-banner" id="js-quiz-banner">
            <div class="banner-job-title" id="js-banner-title">
                <?= htmlspecialchars($specialtyTitle ?? 'Motion designer') ?>
            </div>
        </div>

        <div class="popup-content" id="main-popup-content">

            <div id="quiz-game-container">
                <?php foreach ($questions as $index => $question): 
                    $answers = $question->getAnswers();
                    $answerA = $answers[0] ?? null;
                    $answerB = $answers[1] ?? null;
                ?>
                    <div class="question-step <?= $index === 0 ? 'active' : '' ?>" data-step="<?= $index ?>" style="<?= $index !== 0 ? 'display: none;' : '' ?>">
                        
                        <div class="question-container">
                            <div class="question-counter">
                                QUESTION <?= ($index + 1) ?>/<?= $totalQuestions ?>
                            </div>
                            <h2 class="question-text">
                                <?= htmlspecialchars($question->getQuestionText()) ?>
                            </h2>
                        </div>

                        <div class="popup-actions" id="grid-<?= $index ?>">
                            <?php if ($answerA): ?>
                                <button type="button" 
                                        id="btn-answer-<?= $answerA->getId() ?>"
                                        class="quiz-btn" 
                                        onclick="handleVote(<?= $index ?>, <?= $answerA->getId() ?>, <?= $answerB ? $answerB->getId() : 'null' ?>, <?= $answerA->isCorrect() ? 'true' : 'false' ?>, '<?= addslashes($answerA->getAnswerText()) ?>')">
                                    <span><?= htmlspecialchars($answerA->getAnswerText()) ?></span>
                                </button>
                            <?php endif; ?>

                            <?php if ($answerB): ?>
                                <button type="button" 
                                        id="btn-answer-<?= $answerB->getId() ?>"
                                        class="quiz-btn" 
                                        onclick="handleVote(<?= $index ?>, <?= $answerB->getId() ?>, <?= $answerA ? $answerA->getId() : 'null' ?>, <?= $answerB->isCorrect() ? 'true' : 'false' ?>, '<?= addslashes($answerB->getAnswerText()) ?>')">
                                    <span><?= htmlspecialchars($answerB->getAnswerText()) ?></span>
                                </button>
                            <?php endif; ?>
                        </div>

                        <div class="response-container" id="correction-<?= $index ?>" style="display: none;">
                            
                            <h3 class="response-title" id="verdict-title-<?= $index ?>"></h3>
                            
                            <?php 
                            $explanation = '';
                            foreach ($answers as $ans) {
                                if ($ans->isCorrect() && !empty($ans->getExplanation())) {
                                    $explanation = $ans->getExplanation();
                                    break;
                                }
                            }
                            ?>
                            <p class="response-explanation"><?= htmlspecialchars($explanation) ?></p>

                            <button type="button" class="question-btn" onclick="nextStep(<?= $index ?>, <?= $totalQuestions ?>)">
                                <?= ($index + 1) === $totalQuestions ? 'Voir mes résultats' : 'Question suivante' ?>
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div id="quiz-results-container" style="display: none; width: 100%;">
                
                <div style="height: 38px; width: 100%; flex-shrink: 0;"></div>

                <div style="height: 130px; width: 100%; margin-top: 16px; margin-bottom: 16px; flex-shrink: 0; display: flex; justify-content: center; align-items: center;">
                    <img src="/assets/images/quiz/" alt="Score final" style="height: 130px; width: 405px; display: block; object-fit: contain;">
                </div>

                <div style="width: 100%; padding: 0 16px; overflow: hidden; flex-direction: column; display: flex; gap: 16px;">
                    <div style="align-self: stretch; display: flex; align-items: center; gap: 10px; height: 34px;">
                        <div style="color: #000000; font-size: 14px; font-family: 'JetBrains Mono', monospace; font-weight: 700; text-transform: uppercase;">VOS RÉPONSES</div>
                    </div>

                    <div id="js-responses-grid" class="responses-list"></div>
                </div>

                <div style="margin-top: auto; display: flex; justify-content: flex-start; align-items: flex-start; padding: 24px 16px; width: 100%;">
                    <button type="button" class="question-btn" onclick="window.location.reload();">
                        Réessayer ↻
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
let userScore = 0; 
let quizHistory = [];

function closeQuizPopup() {
    const overlay = document.getElementById('js-quiz-overlay');
    if (overlay) {
        overlay.style.display = 'none';
    }
}

function handleVote(currentIndex, clickedId, otherId, isCorrect, chosenText) {
    const gridDiv = document.getElementById(`grid-${currentIndex}`);
    const clickedBtn = document.getElementById(`btn-answer-${clickedId}`);
    const otherBtn = document.getElementById(`btn-answer-${otherId}`);
    const titleDiv = document.getElementById(`verdict-title-${currentIndex}`);
    const correctionDiv = document.getElementById(`correction-${currentIndex}`);

    clickedBtn.disabled = true;
    if (otherBtn) otherBtn.disabled = true;

    const isCorrectBool = (isCorrect === true || isCorrect === "true");

    if (isCorrectBool) {
        userScore++;
    }

    quizHistory.push({
        questionNumber: currentIndex + 1,
        userChoice: chosenText,
        isCorrect: isCorrectBool
    });

    let correctText = chosenText; 
    
    if (isCorrectBool) {
        clickedBtn.style.background = "rgba(52, 199, 89, 0.40)";
        clickedBtn.style.color = "#000000";
        clickedBtn.style.border = "2px solid #34C759";
    } else {
        clickedBtn.style.background = "rgba(255, 56, 60, 0.40)";
        clickedBtn.style.color = "#000000";
        clickedBtn.style.border = "2px solid #FF383C";
        if (otherBtn) {
            otherBtn.style.background = "rgba(52, 199, 89, 0.40)";
            otherBtn.style.color = "#000000";
            otherBtn.style.border = "2px solid #34C759";
            correctText = otherBtn.innerText.trim();
        }
    }

    titleDiv.innerText = correctText;

    setTimeout(() => {
        gridDiv.style.display = 'none';
        correctionDiv.style.display = 'flex'; 
    }, 1000);
}

function nextStep(currentIndex, totalQuestions) {
    const currentStepEl = document.querySelector(`[data-step="${currentIndex}"]`);
    
    if (currentIndex + 1 < totalQuestions) {
        currentStepEl.style.display = 'none';
        currentStepEl.classList.remove('active');
        
        const nextStepEl = document.querySelector(`[data-step="${currentIndex + 1}"]`);
        nextStepEl.style.display = 'block';
        nextStepEl.classList.add('active');
    } else {
        buildAndShowFigmaRecap();
    }
}

function buildAndShowFigmaRecap() {
    document.getElementById('quiz-game-container').style.display = 'none';
    document.getElementById('js-quiz-banner').style.display = 'none';
    document.getElementById('js-banner-title').style.display = 'none';
    
    document.getElementById('main-popup-content').style.padding = '0';
    
    const popup = document.getElementById('main-popup-container');
    popup.className = 'popup-container-results'; 
    popup.style.height = '880px';
    popup.style.width = '637px';
    
    const gridContainer = document.getElementById('js-responses-grid');
    gridContainer.innerHTML = ''; 
    
    quizHistory.forEach(item => {
        let badgeHtml = '';
        
        if (item.isCorrect) {
            badgeHtml = `
                <div class="response-card-badge is-correct">
                    <div class="card-badge-icon-wrapper">
                        <div style="width: 8px; height: 5px; border-left: 1.5px solid white; border-bottom: 1.5px solid white; transform: rotate(-45deg); margin-top: -2px;"></div>
                    </div>
                    <div class="card-badge-question-num">Question ${item.questionNumber}</div>
                    <div class="card-badge-user-value">${item.userChoice}</div>
                </div>
            `;
        } else {
            badgeHtml = `
                <div class="response-card-badge is-wrong">
                    <div class="card-badge-icon-wrapper">
                        <div style="width: 8px; height: 2px; background: white; transform: rotate(45deg); position: absolute;"></div>
                        <div style="width: 8px; height: 2px; background: white; transform: rotate(-45deg); position: absolute;"></div>
                    </div>
                    <div class="card-badge-question-num">Question ${item.questionNumber}</div>
                    <div class="card-badge-user-value">${item.userChoice}</div>
                </div>
            `;
        }
        
        gridContainer.insertAdjacentHTML('beforeend', badgeHtml);
    });
    
    document.getElementById('quiz-results-container').style.display = 'flex';
    document.getElementById('quiz-results-container').style.flexDirection = 'column';
}
</script>