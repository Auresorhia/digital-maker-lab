<?php
/**
 * Composant — Bulle Assistant IA
 * Ticket #32 : À inclure dans chaque vue de page métier
 *
 * Prérequis : la variable $jobId doit être définie dans le contrôleur
 * qui charge la page métier.
 *
 * Exemple d'inclusion dans une vue métier :
 *   <?php $jobId = 5; include __DIR__ . '/assistant-ia-bubble.php'; ?>
 *
 * Fichiers CSS/JS à ajouter dans le <head> et avant </body> :
 *   <link rel="stylesheet" href="assets/css/assistant-ia.css">
 *   <script src="assets/js/assistant-ia.js" defer></script>
 */

$safeJobId = isset($jobId) ? (int) $jobId : 0;
?>

<?php if ($safeJobId > 0): ?>

<!-- Overlay (fond sombre) -->
<div class="assistant-ia-overlay" aria-hidden="true"></div>

<!-- Panneau latéral -->
<aside class="assistant-ia-panel" aria-label="Applications du métier" aria-hidden="true">
    <div class="assistant-ia-panel__header">
        <div>
            <p class="assistant-ia-panel__title">Les apps du métier</p>
            <p class="assistant-ia-panel__subtitle">3 outils incontournables</p>
        </div>
        <button class="assistant-ia-panel__close" aria-label="Fermer le panneau">&times;</button>
    </div>
    <div class="assistant-ia-panel__body">
        <!-- Contenu chargé dynamiquement par assistant-ia.js -->
    </div>
</aside>

<!-- Bulle flottante -->
<button
    class="assistant-ia-bubble"
    data-metier-id="<?= $safeJobId ?>"
    aria-label="Voir les applications de ce métier"
    type="button"
>
    <span class="assistant-ia-bubble__icon" aria-hidden="true">✦</span>
    <span class="assistant-ia-bubble__label">Les apps du métier</span>
</button>

<?php endif; ?>
