<?php
class JobSheetController
{
    private array $jobs = [
        'consultant-seo' => [
            'seo_title'     => 'Le métier de Consultant SEO | Digital Maker Lab',
            'seo_desc'      => 'Découvrez le métier de consultant SEO : missions, compétences, outils et salaires. Formez-vous en référencement naturel avec Digital Maker Lab.',
            'seo_canonical' => 'https://digitalmakerlab.kevin-castanho.fr/metiers/consultant-seo',
        ],
        // Ajouter les prochains métiers ici quand le CMS sera prêt
    ];

    public function show(string $slug): void
    {
        if (!isset($this->jobs[$slug])) {
            http_response_code(404);
            require_once '../src/Views/errors/404.php';
            return;
        }

        $job             = $this->jobs[$slug];
        $seo_title       = $job['seo_title'];
        $seo_desc        = $job['seo_desc'];
        $seo_canonical   = $job['seo_canonical'];
        $active_job_slug = $slug;
        $assets_prefix   = '../';
        $nav_prefix      = '../../';

        require_once '../src/Views/front/finder.php';
    }
}
