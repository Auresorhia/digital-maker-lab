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
}