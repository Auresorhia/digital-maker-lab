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

    /**
     * Retourne les 3 applications associées à un métier, triées par display_order.
     *
     * @param int $jobId
     * @return array
     */
    public function getAppsByJobId(int $jobId): array
    {
        $sql = "SELECT id, app_name, tags, description, source
                FROM assistant_ia_apps
                WHERE job_id = :job_id
                ORDER BY display_order ASC
                LIMIT 3";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['job_id' => $jobId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
