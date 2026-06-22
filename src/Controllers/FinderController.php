<?php
namespace Controllers;

class FinderController
{
    public function index(): void
    {
        $seo_title     = 'Les Métiers du Digital | Digital Maker Lab';
        $seo_desc      = 'Explore les métiers du digital : SEO, UX design, développement, motion design et plus. Trouve le métier qui te correspond avec Digital Maker Lab.';
        $seo_canonical = 'https://digitalmakerlab.kevin-castanho.fr/metiers';

        require_once '../src/Views/front/finder.php';
    }
}
