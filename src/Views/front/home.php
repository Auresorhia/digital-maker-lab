<?php
$page_title       = 'Digital Maker Lab';
$page_css         = 'home.css';
$extra_css        = 'events.css';
$header_class     = 'site-header';
$show_desktop_nav = true;
$nav_links = [
    ['label' => 'Accueil',                'href' => '#hero',    'active' => true],
    ['label' => 'À propos',               'href' => '#about',   'active' => false],
    ['label' => 'Les métiers du digital', 'href' => '#jobs',    'active' => false],
    ['label' => 'Actualités',             'href' => '#news',    'active' => false],
    ['label' => 'Blog',                   'href' => '/blog',    'active' => false],
];
require_once __DIR__ . '/../partials/header.php';
?>

<main class="home-page audio-target">
    <section class="hero" id="hero" aria-labelledby="hero-title">
        <span class="hero__decor hero__decor--left"></span>
        <span class="hero__decor hero__decor--right"></span>
        <img class="hero__icon hero__icon--dev" src="assets/images/home/hero/icon-dev.svg" alt="" aria-hidden="true">
        <img class="hero__icon hero__icon--camera" src="assets/images/home/hero/icon-camera.webp" alt="" aria-hidden="true">
        <img class="hero__icon hero__icon--mac" src="assets/images/home/hero/icon-mac.svg" alt="" aria-hidden="true">
        <img class="hero__icon hero__icon--like" src="assets/images/home/hero/icon-like.webp" alt="" aria-hidden="true">
        <img class="hero__icon hero__icon--micro" src="assets/images/home/hero/icon-micro.webp" alt="" aria-hidden="true">

        <p class="hero__kicker">
            <span>Trouve ta voie dans</span>
            <strong>le digital</strong>
            <span>avec</span>
        </p>
        <h1 class="hero__logo" id="hero-title">
            <img class="hero__logo__img" src="assets/images/logos/hero/logo_digital_maker_lab_rectangle_orange.webp" alt="Digital Maker Lab">
            <img class="hero__logo__highlight" src="assets/images/logos/hero/effet-surligne.webp" alt="" aria-hidden="true">
        </h1>
        <a class="hero__cta" href="metiers">Découvrez les métiers du digital</a>
    </section>

    <section class="home-section about" id="about" aria-labelledby="about-title">
        <p class="section-label">// 01</p>
        <h2 class="section-title" id="about-title">Digital Maker Lab c’est quoi ?</h2>
        <div class="section-content audio-target">
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
                <figcaption class="job-card__caption audio-target">
                    <strong>UXPO</strong>
                    <span>Concevoir des expériences intuitives.</span>
                </figcaption>
            </figure>
            <figure class="job-card">
                <img class="job-card__image" src="assets/images/home/cards/card-marketing.svg" alt="">
                <figcaption class="job-card__caption audio-target">
                    <strong>Marketing</strong>
                    <span>Promouvoir des produits et analyser les audiences.</span>
                </figcaption>
            </figure>
            <figure class="job-card">
                <img class="job-card__image" src="assets/images/home/cards/card-video.svg" alt="">
                <figcaption class="job-card__caption audio-target">
                    <strong>Vidéo</strong>
                    <span>Créer des contenus audiovisuels.</span>
                </figcaption>
            </figure>
            <figure class="job-card">
                <img class="job-card__image" src="assets/images/home/cards/card-dev.svg" alt="">
                <figcaption class="job-card__caption audio-target">
                    <strong>Développement</strong>
                    <span>Créer des sites et applications.</span>
                </figcaption>
            </figure>
            <figure class="job-card">
                <img class="job-card__image" src="assets/images/home/cards/card-design.svg" alt="">
                <figcaption class="job-card__caption audio-target">
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

    <?php require_once __DIR__ . '/../partials/orientation-section.php'; ?>

    <?php require_once __DIR__ . '/../partials/events-section.php'; ?>
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
            <a href="#">Accueil</a>
            <a href="#about">À propos</a>
            <a href="#jobs">Les métiers du digital</a>
            <a href="#news">Actualités</a>
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

<script src="assets/js/home.js"></script>
</body>

</html>
