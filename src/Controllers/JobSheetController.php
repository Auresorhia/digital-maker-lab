<?php
namespace Controllers;

use Models\JobModel;

class JobSheetController
{
    public function show(string $slug): void
    {
        $jobModel = new JobModel(\Database::getInstance());

        $job_data = $jobModel->findBySlug($slug);

        if (!$job_data) {
            http_response_code(404);
            require_once '../src/Views/errors/404.php';
            return;
        }

        $specialtiesWithJobs = $jobModel->findVisibleGroupedBySpecialty();

        $job_name        = $job_data['job_name'];
        $seo_title       = $job_name . ' | Digital Maker Lab';
        $seo_desc        = 'Découvrez le métier de ' . strtolower($job_name) . ' : missions, compétences et salaires. Formez-vous avec Digital Maker Lab.';
        $seo_canonical   = 'https://digitalmakerlab.kevin-castanho.fr/metiers/' . $slug;
        $active_job_slug = $slug;
        $assets_prefix   = '../';
        $nav_prefix      = '../../';

        require_once '../src/Views/front/finder.php';
    }
}
