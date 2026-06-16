<?php

namespace Controllers\AssistantIA;

use Models\AssistantIA\AssistantIAModel;
use PDO;

class AssistantIAController
{
    private AssistantIAModel $model;

    public function __construct(PDO $db)
    {
        $this->model = new AssistantIAModel($db);
    }

    /**
     * Route : GET /api/assistant/{metier_id}
     * Retourne un JSON avec les 3 applications du métier demandé.
     *
     * @param int $jobId
     * @return void
     */
    public function getApps(int $jobId): void
    {
        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');

        if ($jobId <= 0) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Identifiant de métier invalide.']);
            return;
        }

        $apps = $this->model->getAppsByJobId($jobId);

        if (empty($apps)) {
            http_response_code(404);
            echo json_encode(['success' => false, 'error' => 'Aucune application trouvée pour ce métier.']);
            return;
        }

        echo json_encode([
            'success' => true,
            'metier_id' => $jobId,
            'apps' => $apps
        ], JSON_UNESCAPED_UNICODE);
    }
}
