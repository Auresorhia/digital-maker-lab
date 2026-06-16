<?php
$safeJobId = isset($jobId) ? (int) $jobId : 0;
if ($safeJobId <= 0) return;
?>

<div class="ai-overlay" aria-hidden="true"></div>

<div class="ai-modal" role="dialog" aria-modal="true" aria-label="Assistant Digital Maker Lab" aria-hidden="true">
    <div class="ai-modal__card">

        <div class="ai-modal__header">
            <h2 class="ai-modal__title">Explore ce métier avec l'assistant</h2>
            <button class="ai-modal__close" type="button" aria-label="Fermer l'assistant">&#215;</button>
        </div>

        <div class="ai-modal__tabs" role="tablist">
            <button class="ai-tab is-active" type="button" data-tab="collabs" role="tab" aria-selected="true">Les collaborations</button>
            <button class="ai-tab" type="button" data-tab="impact" role="tab" aria-selected="false">L'impact sur t'es app</button>
        </div>

        <div class="ai-modal__content">
            <div class="ai-jobs-grid" role="group" aria-label="Grille des métiers"></div>
            <div class="ai-apps-list" aria-live="polite"></div>
        </div>

        <div class="ai-modal__footer">
            <div class="ai-message">
                <div class="ai-message__avatar" aria-hidden="true">&#10022;</div>
                <div class="ai-message__body">
                    <div class="ai-message__header">
                        <span class="ai-message__name">Assistant Digital Maker Lab</span>
                        <span class="ai-message__status">En attente</span>
                    </div>
                    <p class="ai-message__text ai-message__text--hint">Clique sur un métier pour activer l'assistant</p>
                </div>
            </div>
            <p class="ai-hint" aria-hidden="true">Clique sur un métier pour explorer &#10022;</p>
            <button class="ai-cta" type="button">Changer de métier &#8594;</button>
        </div>

    </div>
</div>

<button class="ai-bubble" type="button" data-metier-id="<?= $safeJobId ?>" aria-expanded="false" aria-label="Ouvrir l'assistant Digital Maker Lab">
    <span class="ai-bubble__label">Votre assistant Digital Maker Lab</span>
    <span class="ai-bubble__icon" aria-hidden="true">&#10022;</span>
</button>
