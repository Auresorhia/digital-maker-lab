<?php

require_once __DIR__ . '/../../config/database.php';

class MetierModel {

    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function rechercherParTitre(string $query): array {
        $stmt = $this->db->prepare(
            "SELECT j.id_job AS id, j.job_name AS titre, s.specialty AS specialite 
             FROM job j
             JOIN specialty s ON j.specialty_id = s.id_specialty
             WHERE j.job_name LIKE :query 
             ORDER BY j.job_name ASC 
             LIMIT 5"
        );
        $stmt->execute([':query' => '%' . $query . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

        public function rechercherParContenu(string $query): array {
        $stmt = $this->db->prepare(
            "SELECT j.id_job AS id, j.job_name AS titre, s.specialty AS specialite,
                    jc.content AS contenu
             FROM job j
             JOIN specialty s ON j.specialty_id = s.id_specialty
             LEFT JOIN job_content jc ON jc.job_id = j.id_job
             WHERE j.job_name LIKE :query1 OR jc.content LIKE :query2
             GROUP BY j.id_job
             ORDER BY j.job_name ASC"
        );
        $like = '%' . $query . '%';
        $stmt->execute([':query1' => $like, ':query2' => $like]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
