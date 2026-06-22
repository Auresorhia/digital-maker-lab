<?php

require_once __DIR__ . '/../../config/database.php';

class MetierModel {

    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function findAll(): array {
        $stmt = $this->db->query(
            "SELECT j.id_job AS id, j.job_name AS titre, s.specialty AS specialite
             FROM job j
             JOIN specialty s ON j.specialty_id = s.id_specialty
             ORDER BY j.id_job ASC"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function rechercherParTitre(string $query): array {
        $stmt = $this->db->prepare(
            "SELECT j.id_job AS id, j.job_name AS titre, s.specialty AS specialite 
             FROM job j
             JOIN specialty s ON j.specialty_id = s.id_specialty
             WHERE j.job_name LIKE :query 
             ORDER BY j.job_name ASC 
             LIMIT 8"
        );
        $stmt->execute([':query' => '%' . $query . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
