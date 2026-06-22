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

    /**
     * Supprime une spécialité et redirige.
     *
     * @param integer $id
     * @return void
     */
    public function delete(int $id): void
    {
        try {
            // On essaie de supprimer la spécialité
            $this->specialtyModel->delete($id);
            
            // Si ça marche, on redirige vers la liste
            header('Location: /admin/specialties');
            exit;

        } catch (\PDOException $e) {
            // Le code 23000 correspond à une violation de clé étrangère dans MySQL
            if ($e->getCode() == '23000') {
                // On affiche un message d'erreur propre avec un bouton de retour
                echo "
                <div style='font-family: sans-serif; text-align: center; margin-top: 50px; color: white; background: #383838; padding: 30px; border-radius: 8px; max-width: 500px; margin-left: auto; margin-right: auto;'>
                    <h2 style='color: #ff4757;'>Action impossible</h2>
                    <p>Tu ne peux pas supprimer cette spécialité car <b>des métiers y sont encore liés</b>.</p>
                    <p>Pour la supprimer, tu dois d'abord modifier ces métiers pour leur attribuer une autre spécialité, ou les supprimer.</p>
                    <br>
                    <a href='/admin/specialties' style='color: black; text-decoration: none; background: #E1F7DF; padding: 10px 20px; border-radius: 5px;'>Retour aux spécialités</a>
                </div>
                ";
                exit;
            }
            
            // Si c'est une autre erreur BDD inattendue, on la laisse s'afficher
            throw $e;
        }
    }
}