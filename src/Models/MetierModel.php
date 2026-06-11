<?php

require_once __DIR__ . '/../../config/database.php';

class MetierModel {

    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function rechercherParTitre(string $query): array {
        $stmt = $this->db->prepare(
            "SELECT id, titre, specialite 
             FROM metiers 
             WHERE titre LIKE :query 
             ORDER BY titre ASC 
             LIMIT 8"
        );
        $stmt->execute([':query' => '%' . $query . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
