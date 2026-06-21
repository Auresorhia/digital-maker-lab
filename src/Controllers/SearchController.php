<?php

require_once __DIR__ . '/../Models/MetierModel.php';
require_once __DIR__ . '/../core/Controller.php';

class SearchController extends Controller {

    public function autocomplete(): void {
        header('Content-Type: application/json; charset=utf-8');

        $query = trim($_GET['q'] ?? '');

        if (mb_strlen($query) < 1) {
            echo json_encode([]);
            return;
        }

        $model = new MetierModel();
        $resultats = $model->rechercherParTitre($query);

        echo json_encode($resultats);
    }

    public function results(): void {
        $query    = trim($_GET['q'] ?? '');
        $resultats = [];

        if (mb_strlen($query) >= 1) {
            $model    = new MetierModel();
            $resultats = $model->rechercherParContenu($query);
        }

        require_once __DIR__ . '/../Views/front/search-results.php';
    }
}
