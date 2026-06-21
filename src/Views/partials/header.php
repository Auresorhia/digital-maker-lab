<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($seo_title ?? $page_title ?? 'Digital Maker Lab') ?></title>
    <?php if (!empty($seo_desc)): ?>
        <meta name="description" content="<?= htmlspecialchars($seo_desc) ?>">
    <?php endif; ?>
    <?php if (!empty($seo_canonical)): ?>
        <link rel="canonical" href="<?= htmlspecialchars($seo_canonical) ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="<?= $assets_prefix ?? '' ?>assets/css/design-system.css">
    <link rel="stylesheet" href="<?= $assets_prefix ?? '' ?>assets/css/<?= $page_css ?? 'home.css' ?>">
    <?php if (!empty($extra_css)): ?>
        <link rel="stylesheet" href="<?= $assets_prefix ?? '' ?>assets/css/<?= $extra_css ?>">
    <?php endif; ?>
</head>

<body>
    <header class="<?= $header_class ?? 'site-header' ?>">
        <button class="menu-toggle" type="button" aria-label="Ouvrir le menu" aria-controls="mobile-menu" aria-expanded="false">
            <span></span>
            <span></span>
        </button>
        <?php if (!empty($show_desktop_nav)): ?>
            <nav class="desktop-nav" aria-label="Navigation principale">
                <ul class="desktop-nav__list">
                    <li><a class="desktop-nav__link is-active" href="<?= $nav_prefix ?? '' ?>#hero">Accueil</a></li>
                    <li><a class="desktop-nav__link" href="<?= $nav_prefix ?? '' ?>#about">À Propos</a></li>
                    <li><a class="desktop-nav__link" href="<?= $nav_prefix ?? '' ?>#jobs">Métiers Du Digital</a></li>
                    <li><a class="desktop-nav__link" href="<?= $nav_prefix ?? '' ?>#news">Actualités</a></li>
                </ul>
            </nav>
        <?php endif; ?>
    </header>

    <nav class="mobile-menu" id="mobile-menu" aria-hidden="true">
        <button class="menu-close" type="button" aria-label="Fermer le menu">×</button>
        <ul class="mobile-menu__list">
            <?php foreach ($nav_links ?? [] as $link): ?>
                <li>
                    <a class="mobile-menu__link <?= !empty($link['active']) ? 'is-active' : '' ?>" href="<?= $link['href'] ?>">
                        <?= $link['label'] ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>

    <script src="<?= $assets_prefix ?? '' ?>assets/js/menu.js"></script>