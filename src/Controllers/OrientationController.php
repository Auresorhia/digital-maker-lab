<?php
namespace Controllers;

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../Models/Test-dorientation/OrientationQuestionnaireModel.php';

use Models\Bot\OrientationQuestionnaireModel;

class OrientationController
{
    private OrientationQuestionnaireModel $model;

    public function __construct()
    {
        $this->model = new OrientationQuestionnaireModel(\Database::getInstance());
    }

    public function questions(): void
    {
        try {
            $this->jsonResponse([
                'questions' => $this->model->findAllQuestionsWithAnswers(),
            ]);
        } catch (\Throwable $exception) {
            $this->jsonResponse([
                'error' => 'Questionnaire indisponible. Verifie que les scripts SQL ont ete importes.',
                'debug' => $exception->getMessage(),
            ], 500);
        }
    }

    public function result(): void
    {
        $payload = json_decode(file_get_contents('php://input'), true);
        $answerIds = $payload['answer_ids'] ?? [];

        if (!is_array($answerIds) || empty($answerIds)) {
            $this->jsonResponse(['error' => 'Aucune reponse recue.'], 400);
            return;
        }

        try {
            $result = $this->model->calculateResult($answerIds, 1);
        } catch (\Throwable $exception) {
            $this->jsonResponse([
                'error' => 'Resultat indisponible. Verifie que les scripts SQL ont ete importes.',
                'debug' => $exception->getMessage(),
            ], 500);
            return;
        }

        if ($result === null) {
            $this->jsonResponse(['error' => 'Resultat impossible a calculer.'], 422);
            return;
        }

        $this->jsonResponse($result);
    }

    private function jsonResponse(array $data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}
