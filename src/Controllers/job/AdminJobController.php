<?php
namespace Controllers;

use Models\JobModel;
use PDO;

class AdminJobController
{
    private JobModel $jobModel;

    /**
     * On instancie le modèle en lui passant la connexion à la base de données.
     *
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $this->jobModel = new JobModel($db);
    }

    /**
     * Récupération des données via le modèle.
     *
     * @return void
     */
    public function index(): void
    {
        $jobs = $this->jobModel->findAll();

        // Récupération de la vue.
        require_once __DIR__ . '/../../Views/admin/jobs/index.php';
    }
}