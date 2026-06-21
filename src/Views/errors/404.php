<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page introuvable - Digital Maker Lab</title>
    <link rel="stylesheet" href="assets/css/design-system.css">
    <link rel="stylesheet" href="assets/css/home.css">
</head>
<body>

<style>
    .error-page {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: calc(100vh - 80px);
        text-align: center;
        padding: 60px var(--spacing-lg) 80px;
        position: relative;
        overflow: hidden;
    }

    .error-page__icon {
        position: absolute;
        pointer-events: none;
        user-select: none;
    }

    .error-page__icon--dev    { top: 0px;   left: -10px;  width: 176px; transform: rotate(13.15deg); opacity: 0.7; }
    .error-page__icon--like   { top: 80px;  right: 60px;  width: 140px; transform: rotate(-25deg);   opacity: 0.7; }
    .error-page__icon--camera { bottom: 60px; right: -20px; width: 260px; opacity: 0.6; }
    .error-page__icon--micro  { bottom: 40px; left: -40px; width: 320px; transform: rotate(-2.69deg); opacity: 0.6; }
    .error-page__icon--mac    { top: 200px; left: 80px;   width: 90px;  transform: rotate(-21.39deg); opacity: 0.7; }

    .error-page__content {
        position: relative;
        z-index: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 24px;
        max-width: 600px;
    }

    .error-page__code {
        font-size: clamp(100px, 20vw, 180px);
        font-weight: 900;
        line-height: 1;
        background: var(--gradient-button-hover);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        letter-spacing: -4px;
    }

    .error-page__title {
        font-size: clamp(22px, 4vw, 32px);
        font-weight: 800;
        color: var(--color-dark);
    }

    .error-page__desc {
        font-size: 16px;
        color: #777;
        line-height: 1.6;
        max-width: 420px;
    }

    @media (max-width: 768px) {
        .error-page__icon--dev    { top: 0;    left: -10px; width: 120px; }
        .error-page__icon--like   { top: 60px; right: 10px; width: 100px; }
        .error-page__icon--camera { display: none; }
        .error-page__icon--micro  { bottom: 20px; left: -20px; width: 200px; }
        .error-page__icon--mac    { display: none; }
    }
</style>

<main class="error-page">

    <img class="error-page__icon error-page__icon--dev"    src="assets/images/home/hero/icon-dev.svg"     alt="" aria-hidden="true">
    <img class="error-page__icon error-page__icon--like"   src="assets/images/home/hero/icon-like.webp"   alt="" aria-hidden="true">
    <img class="error-page__icon error-page__icon--camera" src="assets/images/home/hero/icon-camera.webp" alt="" aria-hidden="true">
    <img class="error-page__icon error-page__icon--micro"  src="assets/images/home/hero/icon-micro.webp"  alt="" aria-hidden="true">
    <img class="error-page__icon error-page__icon--mac"    src="assets/images/home/hero/icon-mac.svg"     alt="" aria-hidden="true">

    <div class="error-page__content">
        <span class="error-page__code">404</span>
        <h1 class="error-page__title">Oops, page introuvable&nbsp;!</h1>
        <p class="error-page__desc">La page que vous cherchez n'existe pas ou a été déplacée. Pas de panique, retournez à l'accueil&nbsp;!</p>
        <a class="hero__cta" href="/">← Retour à l'accueil</a>
    </div>

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
            <a href="/#jobs">Les métiers du digital</a>
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

</body>
</html>
