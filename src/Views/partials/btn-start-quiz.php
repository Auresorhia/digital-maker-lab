<?php
/**
 * @var int 
 */
?>

<button type="button" 
        class="quiz-start-trigger-btn" 
        data-job-id="<?= (int)$jobId ?>"
        onclick="openQuizPopup(<?= (int)$jobId ?>)"
        style="border-radius: 8px; border: 2px solid var(--cta, #C5B0FF); 
               background: #FFF; display: flex; 
               flex-direction: column; 
               align-items: flex-start; 
               gap: 16px; padding: 16px; 
               cursor: pointer; width: 100%; 
               transition: transform 0.2s ease, 
               box-shadow 0.2s ease;">
    
    <span style="font-family: 'Inter', 
                sans-serif; font-size: 16px; 
                font-weight: 600; color: #000000;">
        Commencer le quiz
    </span>
    
</button>

<style>

.quiz-start-trigger-btn:active {
    transform: translateY(0);
}
</style>