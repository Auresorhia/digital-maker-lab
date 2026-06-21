<?php

class HomeController
{

    // Méthode par défaut pour la page d'accueil
    public function index()
    {
        $seo_title     = 'Digital Maker Lab | École des Métiers du Digital';
        $seo_desc      = 'Digital Maker Lab forme aux métiers du digital : marketing, UX design, développement web et vidéo. Trouve la formation qui te correspond.';
        $seo_canonical = 'https://digitalmakerlab.kevin-castanho.fr/';

        // On appelle la vue correspondante
        require_once '../src/Views/front/home.php';
    }
}
