<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Maker Lab</title>
    <link rel="stylesheet" href="assets/css/design-system.css">
    <link rel="stylesheet" href="assets/css/home.css">
</head>

<body>
    <header class="site-header">
        <button class="menu-toggle" type="button" aria-label="Ouvrir le menu" aria-controls="mobile-menu" aria-expanded="false">
            <span></span>
            <span></span>
        </button>

        <nav class="desktop-nav" aria-label="Navigation principale">
            <ul class="desktop-nav__list">
                <li><a class="desktop-nav__link is-active" href="#">Accueil</a></li>
                <li><a class="desktop-nav__link" href="#about">À Propos</a></li>
                <li><a class="desktop-nav__link" href="#jobs">Métiers Du Digital</a></li>
                <li><a class="desktop-nav__link" href="#news">Actualités</a></li>
            </ul>
            <a class="desktop-nav__support" href="#" aria-label="Support">☎</a>
        </nav>
    </header>

    <nav class="mobile-menu" id="mobile-menu" aria-hidden="true">
        <button class="menu-close" type="button" aria-label="Fermer le menu">×</button>
        <ul class="mobile-menu__list">
            <li><a class="mobile-menu__link is-active" href="#">Accueil</a></li>
            <li><a class="mobile-menu__link" href="#about">À propos</a></li>
            <li><a class="mobile-menu__link" href="#jobs">Métier du digital</a></li>
            <li><a class="mobile-menu__link" href="#news">Actualités</a></li>
        </ul>
    </nav>

    <main class="home-page">
        <section class="hero" aria-labelledby="hero-title">
            <span class="hero__decor hero__decor--left"></span>
            <span class="hero__decor hero__decor--right"></span>
            <img class="hero__icon hero__icon--dev" src="assets/images/home/hero/icon-dev.svg" alt="" aria-hidden="true">
            <img class="hero__icon hero__icon--camera" src="assets/images/home/hero/icon-camera.svg" alt="" aria-hidden="true">
            <img class="hero__icon hero__icon--mac" src="assets/images/home/hero/icon-mac.svg" alt="" aria-hidden="true">
            <img class="hero__icon hero__icon--like" src="assets/images/home/hero/icon-like.svg" alt="" aria-hidden="true">
            <img class="hero__icon hero__icon--micro" src="assets/images/home/hero/icon-micro.svg" alt="" aria-hidden="true">

            <p class="hero__kicker">
                <span>Trouve ta voie dans</span>
                <strong>le digital</strong>
                <span>avec</span>
            </p>
            <h1 class="hero__logo" id="hero-title">
                <span>Digital</span>
                <span>Maker</span>
                <strong>Lab</strong>
            </h1>
            <a class="hero__cta" href="#jobs">Découvrez les métiers du digital</a>
        </section>

        <section class="home-section about" id="about" aria-labelledby="about-title">
            <p class="section-label">// 01</p>
            <h2 class="section-title" id="about-title">Digital Maker Lab c’est quoi ?</h2>
            <div class="section-content">
                <p>Le digital regroupe tous les métiers liés aux technologies numériques : création de sites web, applications, réseaux sociaux, vidéos, design, marketing ou encore intelligence artificielle.</br></br>
                    Média indépendant, nous décryptons les métiers du digital pour rendre l'information accessible à tous. Créé par des étudiants et pour des étudiants, notre média informe, guide et accompagne les jeunes dans leur orientation grâce à des contenus pédagogiques, des témoignages et des analyses du secteur numérique.</p>
            </div>
            <figure class="about__media">
                <img src="assets/images/placeholders/section-1.svg" alt="">
            </figure>
        </section>

        <section class="home-section jobs" id="jobs" aria-labelledby="jobs-title">
            <p class="section-label">// 02</p>
            <h2 class="section-title" id="jobs-title">Explore les grandes familles du digital</h2>
            <div class="jobs__slider" aria-label="Familles de métiers du digital">
                <figure class="job-card">
                    <img class="job-card__image" src="assets/images/home/cards/card-uxpo.svg" alt="">
                    <figcaption class="job-card__caption">
                        <strong>UXPO</strong>
                        <span>Concevoir des expériences intuitives.</span>
                    </figcaption>
                </figure>
                <figure class="job-card">
                    <img class="job-card__image" src="assets/images/home/cards/card-marketing.svg" alt="">
                    <figcaption class="job-card__caption">
                        <strong>Marketing</strong>
                        <span>Promouvoir des produits et analyser les audiences.</span>
                    </figcaption>
                </figure>
                <figure class="job-card">
                    <img class="job-card__image" src="assets/images/home/cards/card-video.svg" alt="">
                    <figcaption class="job-card__caption">
                        <strong>Vidéo</strong>
                        <span>Créer des contenus audiovisuels.</span>
                    </figcaption>
                </figure>
                <figure class="job-card">
                    <img class="job-card__image" src="assets/images/home/cards/card-dev.svg" alt="">
                    <figcaption class="job-card__caption">
                        <strong>Développement</strong>
                        <span>Créer des sites et applications.</span>
                    </figcaption>
                </figure>
                <figure class="job-card">
                    <img class="job-card__image" src="assets/images/home/cards/card-design.svg" alt="">
                    <figcaption class="job-card__caption">
                        <strong>Design</strong>
                        <span>Imaginer des interfaces visuelles.</span>
                    </figcaption>
                </figure>
            </div>
            <div class="jobs__pagination" aria-hidden="true">
                <span class="jobs__dot is-active"></span>
                <span class="jobs__dot"></span>
                <span class="jobs__dot"></span>
                <span class="jobs__dot"></span>
                <span class="jobs__dot"></span>
            </div>
        </section>
    </main>

    <script src="assets/js/home.js"></script>
</body>

</html>