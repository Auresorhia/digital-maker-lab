<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title ?? 'Digital Maker Lab') ?></title>
    <link rel="stylesheet" href="assets/css/design-system.css">
    <link rel="stylesheet" href="assets/css/<?= $page_css ?? 'home.css' ?>">
    <?php if (!empty($extra_css)): ?>
        <link rel="stylesheet" href="assets/css/<?= $extra_css ?>">
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
                <a class="desktop-nav__support" id="audio-toggle" href="#" aria-label="Activer l'accessibilité audio">
                    <svg width="34" height="35" viewBox="0 0 34 35" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="nav-icon-svg">
                        <path d="M3.5482 10.6254C2.52979 10.8997 1.63021 11.502 0.988755 12.3392C0.347303 13.1764 -0.000220914 14.2017 1.05358e-07 15.2564V20.4872C1.05358e-07 21.7589 0.505173 22.9785 1.40439 23.8777C2.3036 24.7769 3.52319 25.2821 4.79487 25.2821H9.15385C9.50067 25.2821 9.83328 25.1443 10.0785 24.899C10.3238 24.6538 10.4615 24.3212 10.4615 23.9744V11.7692C10.4615 11.4224 10.3238 11.0898 10.0785 10.8446C9.83328 10.5993 9.50067 10.4615 9.15385 10.4615H6.2159C6.9639 6.15487 11.349 2.61538 17 2.61538C22.651 2.61538 27.0361 6.15487 27.7841 10.4615H24.8462C24.4993 10.4615 24.1667 10.5993 23.9215 10.8446C23.6762 11.0898 23.5385 11.4224 23.5385 11.7692V23.9744C23.5385 24.6962 24.1243 25.2821 24.8462 25.2821H27.7457C27.4513 26.5233 26.7467 27.629 25.7459 28.42C24.745 29.2111 23.5065 29.6413 22.2308 29.641H20.2344C19.9309 28.8908 19.3759 28.2695 18.6646 27.8836C17.9533 27.4977 17.1299 27.3712 16.3355 27.5257C15.5412 27.6803 14.8253 28.1064 14.3106 28.7309C13.7959 29.3554 13.5145 30.1395 13.5145 30.9487C13.5145 31.758 13.7959 32.5421 14.3106 33.1666C14.8253 33.7911 15.5412 34.2171 16.3355 34.3717C17.1299 34.5263 17.9533 34.3998 18.6646 34.0138C19.3759 33.6279 19.9309 33.0066 20.2344 32.2564H22.2308C26.4154 32.2564 29.8747 29.1528 30.4344 25.1234C31.4569 24.8522 32.361 24.2504 33.0059 23.4119C33.6508 22.5733 34.0003 21.5451 34 20.4872V15.2564C34.0002 14.2017 33.6527 13.1764 33.0112 12.3392C32.3698 11.502 31.4702 10.8997 30.4518 10.6254C29.7857 4.5159 23.8453 0 17 0C10.1547 0 4.21426 4.5159 3.5482 10.6254Z"/>
                    </svg>
                </a>
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

    <script src="assets/js/menu.js"></script>
    <script src="assets/js/web-speach-script.js"></script>