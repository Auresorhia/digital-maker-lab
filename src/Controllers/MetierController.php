<?php

require_once __DIR__ . '/../Models/MetierModel.php';

class MetierController {

    public function index(): void {
        $model   = new MetierModel();
        $metiers = $model->findAll();
        $jobId   = isset($_GET['job']) ? (int) $_GET['job'] : ($metiers[0]['id'] ?? 1);

        require_once __DIR__ . '/../Views/front/metiers/index.php';
    }
}
