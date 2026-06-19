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
    <aside class="finder-sidebar" aria-label="Catégories">
        <a class="finder-sidebar__logo" href="home.php" aria-label="Retour à l'accueil">
            <img src="assets/images/logos/logo_digital_maker_lab_orange.webp" alt="Digital Maker Lab">
        </a>
        <h2 class="finder-sidebar__title">Catégories</h2>
        <ul class="finder-sidebar__list">
            <li><a href="#">Marketing</a></li>
            <li><a href="#">UXPO</a></li>
            <li><a href="#">Vidéos</a></li>
            <li><a href="#">Design</a></li>
            <li><a href="#">Développement</a></li>
        </ul>
    </aside>
</main>

<script src="assets/js/finder.js"></script>