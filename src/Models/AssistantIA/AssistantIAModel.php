<?php

namespace Models\AssistantIA;

use PDO;

class AssistantIAModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAppsByJobId(int $jobId): array
    {
        $stmt = $this->db->prepare(
            "SELECT id, app_name, tags, description, source
             FROM assistant_ia_apps
             WHERE job_id = :job_id
             ORDER BY display_order ASC
             LIMIT 3"
        );
        $stmt->execute(['job_id' => $jobId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllJobsExcept(int $excludeId): array
    {
        $stmt = $this->db->prepare(
            "SELECT id_job, job_name
             FROM job
             WHERE id_job != :exclude_id
             ORDER BY id_job ASC"
        );
        $stmt->execute(['exclude_id' => $excludeId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
