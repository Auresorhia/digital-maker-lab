<?php

function extraireSnippet(string $contenu, string $query, int $longueur = 220): string {
    $pos = mb_stripos($contenu, $query);

    if ($pos === false) {
        $extrait = mb_substr($contenu, 0, $longueur);
        $suffix  = mb_strlen($contenu) > $longueur ? '…' : '';
        return htmlspecialchars($extrait) . $suffix;
    }

    $debut   = max(0, $pos - 60);
    $extrait = mb_substr($contenu, $debut, $longueur);
    $prefix  = $debut > 0 ? '…' : '';
    $suffix  = ($debut + $longueur) < mb_strlen($contenu) ? '…' : '';

    $extrait_safe = htmlspecialchars($extrait);
    $query_safe   = preg_quote(htmlspecialchars($query), '/');
    $extrait_safe = preg_replace('/(' . $query_safe . ')/iu', '<strong>$1</strong>', $extrait_safe);

    return $prefix . $extrait_safe . $suffix;
}

function highlighterTitrePhp(string $texte, string $query): string {
    $texte_safe = htmlspecialchars($texte);
    $query_safe = preg_quote(htmlspecialchars($query), '/');
    return preg_replace('/(' . $query_safe . ')/iu', '<strong>$1</strong>', $texte_safe);
}

$rawQuery     = $_GET['q'] ?? '';
$queryDisplay = htmlspecialchars($rawQuery);
$nbResultats  = count($resultats);

$page_title = $queryDisplay ? 'Recherche : ' . $queryDisplay . ' – Digital Maker Lab' : 'Recherche – Digital Maker Lab';
$page_css   = 'home.css';
$extra_css  = 'search-results.css';
$hide_nav   = true;

require_once __DIR__ . '/../partials/header.php';
?>
<link rel="stylesheet" href="assets/css/searchbar.css">

<main class="search-results-page">

    <div class="search-results-header">
        <a class="search-results-back" href="/metiers">← Retour aux métiers</a>

        <?php require_once __DIR__ . '/searchbar/searchbar.php'; ?>

        <?php if ($queryDisplay): ?>
            <h1 class="search-results-title">
                <?= $nbResultats ?> résultat<?= $nbResultats > 1 ? 's' : '' ?> pour
                «&nbsp;<strong><?= $queryDisplay ?></strong>&nbsp;»
            </h1>
        <?php else: ?>
            <h1 class="search-results-title">Rechercher un métier</h1>
        <?php endif; ?>
    </div>

    <?php if ($queryDisplay && $nbResultats === 0): ?>
        <p class="search-results-empty">
            <span class="search-results-empty__icon">🔍</span>
            Aucun métier ne correspond à «&nbsp;<strong><?= $queryDisplay ?></strong>&nbsp;».
        </p>
    <?php elseif ($nbResultats > 0): ?>
        <ul class="search-results-list">
            <?php foreach ($resultats as $metier): ?>
                <li class="search-results-card">
                    <a class="search-results-card__link"
                       href="/metiers/<?= htmlspecialchars($metier['slug'], ENT_QUOTES, 'UTF-8') ?>">
                        <div class="search-results-card__header">
                            <h2 class="search-results-card__title">
                                <?= highlighterTitrePhp($metier['titre'], $rawQuery) ?>
                            </h2>
                            <span class="search-results-card__specialty">
                                <?= htmlspecialchars($metier['specialite']) ?>
                            </span>
                        </div>
                        <?php if (!empty($metier['contenu'])): ?>
                            <p class="search-results-card__snippet">
                                <?= extraireSnippet($metier['contenu'], $rawQuery) ?>
                            </p>
                        <?php endif; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

</main>

<footer class="site-footer" id="footer">
    <div class="site-footer__logo">
        <img src="assets/images/logos/logo_digital_maker_lab_orange.webp" alt="Digital Maker Lab">
    </div>
    <div class="site-footer__brand">
        <img src="assets/images/logos/logo_digital_maker_lab_orange.webp" alt="Digital Maker Lab">
    </div>
    <div class="site-footer__content">
        <nav class="site-footer__nav" aria-label="Navigation pied de page">
            <a href="/">Accueil</a>
            <a href="/#about">À propos</a>
            <a href="/metiers">Les métiers du digital</a>
            <a href="/#news">Actualités</a>
        </nav>
        <div class="site-footer__socials">
            <a href="#" aria-label="YouTube">
                <img src="assets/images/icons/icon-white-youtube.svg" alt="">
            </a>
            <a href="https://www.instagram.com/digital_maker_lab?igsh=OTJsN2YzczlsZzVx" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                <img src="assets/images/icons/icon-white-instagram.svg" alt="">
            </a>
        </div>
    </div>
    <div class="site-footer__legal">
        <a href="#">Mentions légales</a>
        <a href="#">Conditions générales</a>
    </div>
</footer>

<script src="assets/js/search.js"></script>
<script>
    const searchInput = document.getElementById('search-input');
    if (searchInput) {
        searchInput.value = <?= json_encode($rawQuery) ?>;
    }
</script>
