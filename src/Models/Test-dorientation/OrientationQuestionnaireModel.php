<?php

namespace Models\Bot;

use PDO;

class OrientationQuestionnaireModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function findAllQuestionsWithAnswers(): array
    {
        $sql = "
            SELECT
                q.id_question,
                q.question_key,
                q.question_text,
                q.position AS question_position,
                a.id_answer,
                a.answer_letter,
                a.answer_text,
                a.position AS answer_position
            FROM orientation_question q
            LEFT JOIN orientation_answer a ON a.question_id = q.id_question
            ORDER BY q.position ASC, a.position ASC
        ";

        $stmt = $this->db->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $questions = [];

        foreach ($rows as $row) {
            $questionId = (int) $row['id_question'];

            if (!isset($questions[$questionId])) {
                $questions[$questionId] = [
                    'id_question' => $questionId,
                    'question_key' => $row['question_key'],
                    'question_text' => $row['question_text'],
                    'position' => (int) $row['question_position'],
                    'answers' => [],
                ];
            }

            if ($row['id_answer'] !== null) {
                $questions[$questionId]['answers'][] = [
                    'id_answer' => (int) $row['id_answer'],
                    'answer_letter' => $row['answer_letter'],
                    'answer_text' => $row['answer_text'],
                    'position' => (int) $row['answer_position'],
                ];
            }
        }

        return array_values($questions);
    }

    public function calculateResult(array $answerIds, int $jobLimit = 5): ?array
    {
        $answerIds = $this->cleanAnswerIds($answerIds);

        if (empty($answerIds)) {
            return null;
        }

        $specialtyScores = $this->calculateSpecialtyScores($answerIds);

        if (empty($specialtyScores)) {
            return null;
        }

        $mainSpecialty = $specialtyScores[0];
        $topJobs = $this->calculateJobScores($answerIds, $jobLimit);

        if (empty($topJobs)) {
            $topJobs = $this->findTopJobsBySpecialtyId(
                (int) $mainSpecialty['id_specialty'],
                $jobLimit,
                (int) $mainSpecialty['compatibility_percent']
            );
        }

        return [
            'main_specialty' => $mainSpecialty,
            'specialty_scores' => $specialtyScores,
            'top_jobs' => $topJobs,
        ];
    }

    public function calculateSpecialtyScores(array $answerIds): array
    {
        $answerIds = $this->cleanAnswerIds($answerIds);

        if (empty($answerIds)) {
            return [];
        }

        $placeholders = implode(',', array_fill(0, count($answerIds), '?'));

        $totalSql = "SELECT SUM(points) FROM orientation_answer WHERE id_answer IN ($placeholders)";
        $totalStmt = $this->db->prepare($totalSql);
        $totalStmt->execute($answerIds);
        $totalPoints = (int) $totalStmt->fetchColumn();

        if ($totalPoints <= 0) {
            return [];
        }

        $sql = "
            SELECT
                s.id_specialty,
                s.specialty,
                SUM(a.points) AS score
            FROM orientation_answer a
            INNER JOIN specialty s ON s.id_specialty = a.specialty_id
            WHERE a.id_answer IN ($placeholders)
            GROUP BY s.id_specialty, s.specialty
            ORDER BY score DESC, s.specialty ASC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($answerIds);
        $scores = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($scores as &$score) {
            $score['score'] = (int) $score['score'];
            $score['compatibility_percent'] = (int) round(($score['score'] / $totalPoints) * 100);
        }

        return $scores;
    }

    public function calculateJobScores(array $answerIds, int $limit = 5): array
    {
        $answerIds = $this->cleanAnswerIds($answerIds);
        $limit = max(1, min($limit, 10));

        if (empty($answerIds)) {
            return [];
        }

        $placeholders = implode(',', array_fill(0, count($answerIds), '?'));

        $sql = "
            SELECT
                j.id_job,
                j.job_name,
                j.specialty_id,
                s.specialty,
                SUM(oaj.points) AS score
            FROM orientation_answer_job oaj
            INNER JOIN job j ON j.id_job = oaj.job_id
            INNER JOIN specialty s ON s.id_specialty = j.specialty_id
            WHERE oaj.answer_id IN ($placeholders)
            GROUP BY j.id_job, j.job_name, j.specialty_id, s.specialty
            ORDER BY score DESC, j.job_name ASC
            LIMIT $limit
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($answerIds);
        $jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($jobs)) {
            return [];
        }

        $maxScore = max(array_map(fn (array $job): int => (int) $job['score'], $jobs));

        foreach ($jobs as $index => &$job) {
            $job['rank'] = $index + 1;
            $job['score'] = (int) $job['score'];
            $job['compatibility_percent'] = $this->calculateCompatibilityPercent($job['score'], $maxScore);
        }

        return $jobs;
    }

    public function findTopJobsBySpecialtyId(int $specialtyId, int $limit = 5, int $compatibilityPercent = 0): array
    {
        $limit = max(1, min($limit, 10));

        $sql = "
            SELECT
                j.id_job,
                j.job_name,
                j.specialty_id,
                s.specialty
            FROM job j
            INNER JOIN specialty s ON s.id_specialty = j.specialty_id
            WHERE j.specialty_id = :specialty_id
            ORDER BY j.id_job ASC
            LIMIT :limit
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':specialty_id', $specialtyId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        $jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($jobs as $index => &$job) {
            $job['rank'] = $index + 1;
            $job['score'] = null;
            $job['compatibility_percent'] = $compatibilityPercent;
        }

        return $jobs;
    }

    private function calculateCompatibilityPercent(int $score, int $maxScore): int
    {
        if ($maxScore <= 0) {
            return 0;
        }

        return (int) round(60 + (($score / $maxScore) * 40));
    }

    private function cleanAnswerIds(array $answerIds): array
    {
        $answerIds = array_map('intval', $answerIds);
        $answerIds = array_filter($answerIds, fn (int $id): bool => $id > 0);

        return array_values(array_unique($answerIds));
    }
}
