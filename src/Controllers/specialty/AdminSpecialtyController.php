<?php
namespace Controllers;

use Models\SpecialtyModel;
use PDO;

class AdminSpecialtyController
{
    private SpecialtyModel $specialtyModel;

    /**
     * On instancie le modèle en lui passant la connexion à la base de données.
     *
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $this->specialtyModel = new SpecialtyModel($db);
    }

    /**
     * Récupération des données via le modèle.
     *
     * @return void
     */
    public function index(): void
    {
        $specialties = $this->specialtyModel->findAll();

        // Récupération de la vue.
        require_once __DIR__ . '/../../Views/admin/specialties/index.php';
    }

    public function create(): void
    {
        // On charge simplement la vue du formulaire
        require_once __DIR__ . '/../../Views/admin/specialties/create.php';
    }

    /**
     * Traite les données envoyées par le formulaire de création pour les insérer en BDD.
     */
    public function store(): void
    {
        // Vérification que la requête est bien en POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // Préparation des données du formulaire
            $data = [
                'specialty' => trim($_POST['specialty'] ?? ''),
                // Si le switch est coché, il vaut 1, sinon 0
                'display' => isset($_POST['is_visible']) ? 1 : 0
            ];

            if (empty($data['specialty'])) {
                die("Erreur : Le nom de la spécialité est obligatoire.");
            }

            // On demande au modèle d'insérer la nouvelle ligne en BDD
            $this->specialtyModel->create($data);

            // Redirection vers le listing des spécialités après l'ajout.
            header('Location: /admin/specialties');
            exit;
        }
    }

    /**
     * Affiche le formulaire de modification pré-rempli.
     */
    public function edit(int $id): void
    {
        // Récupération de la spécialité spécifique via son ID
        $specialty = $this->specialtyModel->findById($id);

        // Sécurité : Si l'ID tapé n'existe pas
        if (!$specialty) {
            die("Erreur 404 : Cette spécialité n'existe pas.");
        }

        // Chargement de la vue d'édition
        require_once __DIR__ . '/../../Views/admin/specialties/edit.php';
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
                'specialty' => trim($_POST['specialty'] ?? ''),
                'display'   => isset($_POST['is_visible']) ? 1 : 0
            ];

            if (empty($data['specialty'])) {
                die("Erreur : Le nom de la spécialité est obligatoire.");
            }

            // On demande au modèle de mettre à jour la BDD.
            $this->specialtyModel->update($id, $data);

            // Redirige l'utilisateur vers la liste des spécialités.
            header('Location: /admin/specialties');
            exit;
        }
    }

    /**
     * Traite la requête AJAX pour inverser la visibilité
     *
     * @param integer $id
     * @return void
     */
    public function toggle(int $id): void
    {
        // On vérifie que la requête vient bien en POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // On appelle la méthode du modèle
            $success = $this->specialtyModel->toggleDisplay($id);
            
            // On prévient le navigateur qu'on lui parle en JSON, pas en HTML
            header('Content-Type: application/json');
            
            // On renvoie un tableau converti en JSON : {"success": true}
            echo json_encode(['success' => $success]);
            
            // On arrête immédiatement le script pour ne pas afficher de HTML
            exit; 
        }
    }
}