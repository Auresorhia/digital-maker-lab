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

    /**
     * Affiche le formulaire de modification pré-rempli.
     */
    public function edit(int $id): void
    {
        // Récupération du métier spécifique via son ID
        $job = $this->jobModel->findById($id);

        // Sécurité : Si l'ID tapé dans l'URL n'existe pas en BDD
        if (!$job) {
            die("Erreur 404 : Ce métier n'existe pas.");
        }

        // Récupération de toutes les spécialités pour le select.
        $specialtyModel = new \Models\SpecialtyModel($this->db);
        $specialties = $specialtyModel->findAll();

        // Chargement de la vue d'édition.
        require_once __DIR__ . '/../../Views/admin/jobs/edit.php';
    }

    /**
     * Traite les données envoyées par le formulaire de modification.
     */
    public function update(int $id): void
    {
        // Vérification que la requête est bien en POST.
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // Préparation du tableau de données avec ce qui vient du formulaire.
            $data = [
                'job_name'     => $_POST['job_name'],
                'specialty_id' => $_POST['specialty_id']
            ];

            // On demande au modèle de mettre à jour la BDD.
            $this->jobModel->update($id, $data);

            // Redirige l'utilisateur vers la liste des métiers.
            // (Ajuste l'URL de redirection en fonction de tes fichiers de test actuels)
            header('Location: /test_admin_jobs.php');
            exit;
        }
    }
}