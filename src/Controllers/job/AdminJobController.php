<?php
namespace Controllers;

use Models\JobModel;
use Models\SpecialtyModel;
use PDO;

class AdminJobController
{
    private JobModel $jobModel;
    private PDO $db;

    /**
     * On instancie le modèle en lui passant la connexion à la base de données.
     *
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
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

    public function create(): void
    {
        // Instanciation du modèle des spécialités.
        $specialtyModel = new SpecialtyModel($this->db);
        
        // Récupèration de toutes les spécialités pour le menu déroulant.
        $specialties = $specialtyModel->findAll();

        // Chargement de la vue (qui aura maintenant accès à la variable $specialties)
        require_once __DIR__ . '/../../Views/admin/jobs/create.php';
    }
}