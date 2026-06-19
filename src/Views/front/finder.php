<?php
$page_title       = 'Digital Maker Lab';
$page_css         = 'finder.css';
$extra_css        = '';
$header_class     = 'site-header';
$show_desktop_nav = true;
$nav_links = [
    ['label' => 'Accueil',                'href' => '../home.php/#hero',    'active' => true],
    ['label' => 'À propos',               'href' => '#about',   'active' => false],
    ['label' => 'Les métiers du digital', 'href' => '#jobs',    'active' => false],
    ['label' => 'Actualités',             'href' => '#news',    'active' => false],
];
require_once __DIR__ . '/../partials/header.php';
?>

<main class="finder-page">
    <button class="finder-sidebar__toggle" type="button" aria-label="Ouvrir les catégories" aria-controls="finder-sidebar" aria-expanded="false">
        <span aria-hidden="true">></span>
    </button>

    <div class="finder-sidebar-overlay" id="finder-sidebar-overlay" aria-hidden="true"></div>

    <aside class="finder-sidebar" id="finder-sidebar" aria-label="Catégories">
        <button class="finder-sidebar__close" type="button" aria-label="Fermer les catégories">
            <span aria-hidden="true">
                X
        </button>
        <a class="finder-sidebar__logo" href="home.php" aria-label="Retour à l'accueil">
            <img src="assets/images/logos/logo_digital_maker_lab_orange.webp" alt="Digital Maker Lab">
        </a>
        <h2 class="finder-sidebar__title">Catégories</h2>
        <ul class="finder-sidebar__list">
            <li><a href="#" data-category="marketing">Marketing</a></li>
            <li><a href="#" data-category="uxpo">UXPO</a></li>
            <li><a href="#" data-category="videos">Vidéos</a></li>
            <li><a href="#" data-category="design">Design</a></li>
            <li><a href="#" data-category="developpement">Développement</a></li>
        </ul>
    </aside>

    <aside class="finder-subsidebar" id="finder-subsidebar" aria-label="Métiers" aria-hidden="true">
        <button class="finder-subsidebar__back" type="button" aria-label="Retour aux catégories">
            <span aria-hidden="true">‹</span>
        </button>
        <button class="finder-subsidebar__heading" type="button" aria-expanded="false">
            <span class="finder-subsidebar__title" id="finder-subsidebar-title">Catégorie</span>
            <span aria-hidden="true">⌄</span>
        </button>
        <ul class="finder-subsidebar__list" id="finder-subsidebar-list">
            <!-- Métiers injectés par JS -->
        </ul>
    </aside>

    <section class="finder-hero" aria-labelledby="finder-hero-title">
        <img class="finder-hero__icon finder-hero__icon--mac" src="assets/images/finder/icon-mac.webp" alt="" aria-hidden="true">
        <img class="finder-hero__icon finder-hero__icon--like" src="assets/images/finder/icon-like.webp" alt="" aria-hidden="true">
        <img class="finder-hero__icon finder-hero__icon--cursor" src="assets/images/finder/icon-cursor.webp" alt="" aria-hidden="true">

        <h1 class="finder-hero__title" id="finder-hero-title">
            <span>Quel métier du digital</span>
            <span>est fait pour toi ?</span>
        </h1>
        <p class="finder-hero__intro">
            Explore les métiers par domaine ou fais notre test pour découvrir ceux qui te correspondent le mieux et trouver la spécialité dans laquelle tu peux vraiment t'épanouir.
        </p>
    </section>
</main>

<footer class="site-footer" id="footer">
    <div class="site-footer__brand">
        <img src="assets/images/logos/Logo_digital_maker_lab_rectangle_noir.webp" alt="Digital Maker Lab">
    </div>
    <div class="site-footer__logo">
        <img src="assets/images/logos/Logo_digital_maker_lab_rectangle_noir.webp" alt="Digital Maker Lab">
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
    <p class="site-footer__copy">Tous droits réservés. 2026 - made by DC Paris</p>
</footer>

<script src="assets/js/finder.js"></script>