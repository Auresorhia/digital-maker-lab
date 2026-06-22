<?php
$page_title       = 'Digital Maker Lab';
$page_css         = 'finder.css';
$extra_css        = 'orientation.css';
$header_class     = 'site-header';
$show_desktop_nav = true;
$nav_prefix       = $nav_prefix ?? '../';
$assets_prefix    = $assets_prefix ?? '';

$nav_links = [
    ['label' => 'Accueil',                'href' => '', 'active' => true],
    ['label' => 'À propos',               'href' => '', 'active' => false],
    ['label' => 'Les métiers du digital', 'href' => '', 'active' => false],
    ['label' => 'Actualités',             'href' => '', 'active' => false],
];

$specialtiesWithJobs = $specialtiesWithJobs ?? [];
$job_data = $job_data ?? [];
$hasJobSheet = !empty($job_data);

$quizQuestions = [];
$quizSpecialtyTitle = '';
if ($hasJobSheet && !empty($job_data['id_job'])) {
    require_once __DIR__ . '/../../Models/Quiz/QuizModel.php';
    $quizModel = new QuizModel();
    $quizQuestions = $quizModel->findByJobWithAnswers((int)$job_data['id_job']);
    $quizSpecialtyTitle = $job_data['job_name'] ?? '';
}

$extra_css_2 = !empty($quizQuestions) ? 'quiz/quiz.css' : '';
$extra_css_3 = ($hasJobSheet && !empty($job_data['id_job'])) ? 'assistant-ia.css' : '';

$e = static function ($value): string {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
};

$renderText = static function ($value) use ($e): string {
    return nl2br($e($value));
};

$jobsByCategory = [];
foreach ($specialtiesWithJobs as $specialty) {
    $jobsByCategory[(string) $specialty['id']] = $specialty['jobs'] ?? [];
}

require_once __DIR__ . '/../partials/header.php';
?>

<main class="finder-page">
    <button class="finder-sidebar__toggle" type="button" aria-label="Ouvrir les catégories" aria-controls="finder-sidebar" aria-expanded="false">
        <span aria-hidden="true">&gt;</span>
    </button>

    <div class="finder-sidebar-overlay" id="finder-sidebar-overlay" aria-hidden="true"></div>

    <aside class="finder-sidebar" id="finder-sidebar" aria-label="Catégories">
        <button class="finder-sidebar__close" type="button" aria-label="Fermer les catégories">
            <span aria-hidden="true">X</span>
        </button>

        <a class="finder-sidebar__logo" href="<?= $e($nav_prefix) ?>" aria-label="Retour à l'accueil">
            <img src="<?= $e($assets_prefix) ?>assets/images/logos/logo_digital_maker_lab_orange.webp" alt="Digital Maker Lab">
        </a>

        <h2 class="finder-sidebar__title">Catégories</h2>

        <ul class="finder-sidebar__list">
            <?php if (!empty($specialtiesWithJobs)): ?>
                <?php foreach ($specialtiesWithJobs as $specialty): ?>
                    <li>
                        <a href="#" data-category="<?= (int) $specialty['id'] ?>">
                            <?= $e($specialty['name']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="finder-sidebar__empty">Aucune catégorie visible.</li>
            <?php endif; ?>
        </ul>
    </aside>

    <div class="finder-searchbar-wrapper">
        <?php require_once __DIR__ . '/searchbar/searchbar.php'; ?>
    </div>

    <aside class="finder-subsidebar" id="finder-subsidebar" aria-label="Métiers" aria-hidden="true">
        <button class="finder-subsidebar__back" type="button" aria-label="Retour aux catégories">
            <span aria-hidden="true">‹</span>
        </button>

        <button class="finder-subsidebar__heading" type="button" aria-expanded="false">
            <span class="finder-subsidebar__title" id="finder-subsidebar-title">Catégorie</span>
            <span aria-hidden="true">⌄</span>
        </button>

        <ul class="finder-subsidebar__list" id="finder-subsidebar-list">
            <!-- Métiers injectés par JS depuis la base de données -->
        </ul>
    </aside>

    <section class="finder-hero" aria-labelledby="finder-hero-title">
        <img class="finder-hero__icon finder-hero__icon--mac" src="<?= $e($assets_prefix) ?>assets/images/finder/icon-mac.webp" alt="" aria-hidden="true">
        <img class="finder-hero__icon finder-hero__icon--like" src="<?= $e($assets_prefix) ?>assets/images/finder/icon-like.webp" alt="" aria-hidden="true">
        <img class="finder-hero__icon finder-hero__icon--cursor" src="<?= $e($assets_prefix) ?>assets/images/finder/icon-cursor.webp" alt="" aria-hidden="true">

        <h1 class="finder-hero__title" id="finder-hero-title">
            <span>Quel métier du digital</span>
            <span>est fait pour toi ?</span>
        </h1>

        <p class="finder-hero__intro">
            Explore les métiers par domaine ou fais notre test pour découvrir ceux qui te correspondent le mieux et trouver la spécialité dans laquelle tu peux vraiment t'épanouir.
        </p>

        <button class="orientation-preview__button finder-orientation-button" type="button">Faire le test&nbsp;!</button>
    </section>

    <article class="finder-job-sheet<?= $hasJobSheet ? ' is-open' : '' ?>" id="finder-job-sheet" aria-labelledby="finder-job-sheet-title" aria-hidden="<?= $hasJobSheet ? 'false' : 'true' ?>">
        <?php if ($hasJobSheet): ?>
            <header class="finder-job-sheet__hero">
                <h1 class="finder-job-sheet__title" id="finder-job-sheet-title">
                    <?= $e($job_data['job_name'] ?? '') ?>
                </h1>
            </header>

            <?php if (!empty($job_data['explainer_text'])): ?>
                <section class="finder-job-sheet__intro">
                    <?php if (!empty($job_data['explainer_title'])): ?>
                        <h2 class="finder-job-sheet__section-title"><?= $e($job_data['explainer_title']) ?></h2>
                    <?php endif; ?>
                    <p><?= $renderText($job_data['explainer_text']) ?></p>
                </section>
            <?php endif; ?>

            <?php if (!empty($job_data['interview_pro_title']) || !empty($job_data['interview_pro_link'])): ?>
                <section class="finder-job-sheet__interview finder-job-sheet__interview--pro">
                    <span class="finder-job-sheet__tag">Interview pro</span>

                    <?php if (!empty($job_data['interview_pro_title'])): ?>
                        <h2 class="finder-job-sheet__section-title"><?= $e($job_data['interview_pro_title']) ?></h2>
                    <?php endif; ?>

                    <?php if (!empty($job_data['interview_pro_link'])): ?>
                        <br>
                        <a href="<?= $e($job_data['interview_pro_link']) ?>" target="_blank" rel="noopener noreferrer" aria-label="Youtube">
                            Voir l'interview pro
                        </a>
                    <?php endif; ?>
                </section>
            <?php endif; ?>

            <?php if (!empty($job_data['qualities_title']) || !empty($job_data['quality_1_title']) || !empty($job_data['quality_1_text']) || !empty($job_data['quality_2_title']) || !empty($job_data['quality_2_text']) || !empty($job_data['quality_3_title']) || !empty($job_data['quality_3_text'])): ?>
                <section class="finder-job-sheet__skills">
                    <?php if (!empty($job_data['qualities_title'])): ?>
                        <h2 class="finder-job-sheet__section-title"><?= $e($job_data['qualities_title']) ?></h2>
                    <?php endif; ?>

                    <div class="finder-job-sheet__accordion">
                        <?php for ($i = 1; $i <= 3; $i++): ?>
                            <?php
                            $titleKey = 'quality_' . $i . '_title';
                            $textKey = 'quality_' . $i . '_text';
                            $hasQuality = !empty($job_data[$titleKey]) || !empty($job_data[$textKey]);
                            ?>

                            <?php if ($hasQuality): ?>
                                <button class="finder-job-sheet__accordion-trigger" type="button" aria-expanded="false" aria-controls="skill-<?= $i ?>">
                                    <span><?= $e($job_data[$titleKey] ?? 'Qualité ' . $i) ?></span>
                                    <span aria-hidden="true">∧</span>
                                </button>

                                <div class="finder-job-sheet__accordion-panel" id="skill-<?= $i ?>">
                                    <?php if (!empty($job_data[$textKey])): ?>
                                        <p><?= $renderText($job_data[$textKey]) ?></p>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                </section>
            <?php endif; ?>

            <?php if (!empty($job_data['working_site_title']) || !empty($job_data['working_site_text'])): ?>
                <section class="finder-job-sheet__text-block">
                    <?php if (!empty($job_data['working_site_title'])): ?>
                        <h2 class="finder-job-sheet__section-title"><?= $e($job_data['working_site_title']) ?></h2>
                    <?php endif; ?>

                    <?php if (!empty($job_data['working_site_text'])): ?>
                        <p><?= $renderText($job_data['working_site_text']) ?></p>
                    <?php endif; ?>
                </section>
            <?php endif; ?>

            <?php if (!empty($job_data['student_video_title']) || !empty($job_data['student_video_link'])): ?>
                <section class="finder-job-sheet__interview finder-job-sheet__interview--student">
                    <span class="finder-job-sheet__tag">Interview étudiant</span>

                    <?php if (!empty($job_data['student_video_title'])): ?>
                        <h2 class="finder-job-sheet__section-title"><?= $e($job_data['student_video_title']) ?></h2>
                    <?php endif; ?>

                    <?php if (!empty($job_data['student_video_link'])): ?>
                        <br>
                        <a href="<?= $e($job_data['student_video_link']) ?>" target="_blank" rel="noopener noreferrer" aria-label="Youtube">
                            Voir l'interview étudiant
                        </a>
                    <?php endif; ?>
                </section>
            <?php endif; ?>

            <?php if (!empty($job_data['money_title']) || !empty($job_data['money_text'])): ?>
                <section class="finder-job-sheet__text-block">
                    <?php if (!empty($job_data['money_title'])): ?>
                        <h2 class="finder-job-sheet__section-title"><?= $e($job_data['money_title']) ?></h2>
                    <?php endif; ?>

                    <?php if (!empty($job_data['money_text'])): ?>
                        <p><?= $renderText($job_data['money_text']) ?></p>
                    <?php endif; ?>
                </section>
            <?php endif; ?>

            <?php if (!empty($job_data['career_development_title'])): ?>
                <section class="finder-job-sheet__text-block">
                    <h2 class="finder-job-sheet__section-title"><?= $e($job_data['career_development_title']) ?></h2>
                </section>
            <?php endif; ?>

            <section class="finder-job-sheet__lead-magnet">
                <h2 class="finder-job-sheet__section-title">
                    Tu veux savoir si le métier de <?= $e($job_data['job_name'] ?? 'ce métier') ?> est vraiment fait pour toi ?
                </h2>
                <p>Découvrir un métier ne suffit pas toujours pour savoir si l'on peut s'y projeter.</p>
                <div class="finder-job-sheet__cta-row">
                    <button id="btn-quiz" type="button" class="finder-job-sheet__cta finder-job-sheet__cta--outline">
                        Commencer le quiz
                    </button>
                    <button id="btn-assistant" type="button" class="finder-job-sheet__cta finder-job-sheet__cta--assistant">
                        Votre assistant Digital Maker Lab
                    </button>
                </div>
            </section>
        <?php endif; ?>
    </article>
</main>

<footer class="site-footer" id="footer">
    <div class="site-footer__brand">
        <img src="<?= $e($assets_prefix) ?>assets/images/logos/Logo_digital_maker_lab_rectangle_noir.webp" alt="Digital Maker Lab">
    </div>

    <div class="site-footer__logo">
        <img src="<?= $e($assets_prefix) ?>assets/images/logos/Logo_digital_maker_lab_rectangle_noir.webp" alt="Digital Maker Lab">
    </div>

    <div class="site-footer__content">
        <nav class="site-footer__nav" aria-label="Navigation pied de page">
            <a href="<?= $e($nav_prefix) ?>">Accueil</a>
            <a href="<?= $e($nav_prefix) ?>#about">À propos</a>
            <a href="<?= $e($nav_prefix) ?>metiers">Les métiers du digital</a>
            <a href="<?= $e($nav_prefix) ?>#news">Actualités</a>
        </nav>

        <div class="site-footer__socials">
            <a href="#" aria-label="YouTube">
                <img src="<?= $e($assets_prefix) ?>assets/images/icons/icon-white-youtube.svg" alt="">
            </a>
            <a href="https://www.instagram.com/digital_maker_lab" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                <img src="<?= $assets_prefix ?>assets/images/icons/icon-white-instagram.svg" alt="">
            </a>
        </div>
    </div>

    <div class="site-footer__legal">
        <a href="#">Mentions légales</a>
        <a href="#">Conditions générales</a>
    </div>

    <p class="site-footer__copy">Tous droits réservés. 2026 - made by DC Paris</p>
</footer>

<div class="orientation-modal" id="orientation-modal" aria-hidden="true">
    <div class="orientation-modal__backdrop" data-orientation-close></div>
    <section class="orientation-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="orientation-modal-title">
        <div class="orientation-modal__panel">
            <header class="orientation-modal__hero">
                <button class="orientation-modal__close" type="button" aria-label="Fermer le questionnaire" data-orientation-close>&times;</button>
                <h2 id="orientation-modal-title">QUESTIONNAIRES<br>D&rsquo;ORIENTATION</h2>
            </header>
            <div class="orientation-modal__content" data-orientation-content></div>
        </div>
    </section>
</div>

<script>
    window.finderJobsByCategory = <?= json_encode($jobsByCategory, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;
    <?php if (!empty($active_job_slug)): ?>
    window.activeJobSlug = '<?= $e($active_job_slug) ?>';
    <?php endif; ?>
</script>
<?php if ($hasJobSheet && !empty($job_data['id_job'])): ?>
<?php $jobId = $job_data['id_job']; require_once __DIR__ . '/../partials/assistant/assistant-ia-bubble.php'; ?>
<?php endif; ?>
<?php if ($hasJobSheet && !empty($quizQuestions)):
    $questions      = $quizQuestions;
    $specialtyTitle = $quizSpecialtyTitle;
    $jobId          = (int)($job_data['id_job'] ?? 0);
    require_once __DIR__ . '/../Quiz/quiz.php';
endif; ?>
<script>
function openQuizPopup() {
    var el = document.getElementById('js-quiz-overlay');
    if (el) { el.style.display = 'flex'; }
}
</script>
<script src="<?= $e($assets_prefix) ?>assets/js/finder.js"></script>
<script src="<?= $e($assets_prefix) ?>assets/js/orientation.js"></script>
<?php if ($hasJobSheet && !empty($job_data['id_job'])): ?>
<script src="<?= $e($assets_prefix) ?>assets/js/assistant-ia.js"></script>
<?php endif; ?>
<script>
    (function () {
        var quizBtn = document.getElementById('btn-quiz');
        var asstBtn = document.getElementById('btn-assistant');
        var bubble  = document.querySelector('.ai-bubble');
        if (quizBtn) {
            quizBtn.addEventListener('click', function () {
                if (typeof openQuizPopup === 'function') openQuizPopup();
                else if (typeof openOrientationModal === 'function') openOrientationModal();
            });
        }
        if (asstBtn && bubble) {
            asstBtn.addEventListener('click', function () { bubble.click(); });
        }
    })();
</script>
