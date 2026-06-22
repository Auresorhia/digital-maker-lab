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
     * Traite les données envoyées par le formulaire de création d'un métier.
     */
    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // Les données principales pour la table `job`.
            $jobData = [
                // Le formulaire envoie 'main_title', on le met dans 'job_name'.
                'job_name'     => $_POST['main_title'] ?? '', 
                'specialty_id' => $_POST['specialty_id'] ?? null,
                'display'      => 1 // Par défaut visible
            ];

            // Les données de contenu pour la table `job_content`.
            $contentData = [
                'specialty_icon'           => $_POST['specialty_icon'] ?? '',
                'explainer_title'          => $_POST['explainer_title'] ?? '',
                'explainer_text'           => $_POST['explainer_text'] ?? '',
                'interview_pro_title'      => $_POST['interview_pro_title'] ?? '',
                'interview_pro_link'       => $_POST['interview_pro_link'] ?? '',
                'qualities_title'          => $_POST['qualities_title'] ?? '',
                'quality_1_title'          => $_POST['quality_1_title'] ?? '',
                'quality_1_text'           => $_POST['quality_1_text'] ?? '',
                'quality_2_title'          => $_POST['quality_2_title'] ?? '',
                'quality_2_text'           => $_POST['quality_2_text'] ?? '',
                'quality_3_title'          => $_POST['quality_3_title'] ?? '',
                'quality_3_text'           => $_POST['quality_3_text'] ?? '',
                'working_site_title'       => $_POST['working_site_title'] ?? '',
                'working_site_text'        => $_POST['working_site_text'] ?? '',
                'student_video_title'      => $_POST['student_video_title'] ?? '',
                'student_video_link'       => $_POST['student_video_link'] ?? '',
                'money_title'              => $_POST['money_title'] ?? '',
                'money_text'               => $_POST['money_text'] ?? '',
                'career_development_title' => $_POST['career_development_title'] ?? ''
            ];

            if (empty($jobData['job_name']) || empty($jobData['specialty_id'])) {
                die("Erreur : Le titre principal et la spécialité sont obligatoires.");
            }

            // On envoie les deux tableaux au modèle.
            $this->jobModel->createWithContent($jobData, $contentData);

            header('Location: /admin/jobs');
            exit;
        }
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
            header('Location: /admin/jobs');
            exit;
        }
    }
}