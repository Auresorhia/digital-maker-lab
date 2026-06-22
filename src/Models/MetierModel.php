<?php

require_once __DIR__ . '/../../config/database.php';

class MetierModel {

    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public static function slugify(string $text): string
    {
        $text    = mb_strtolower($text, 'UTF-8');
        $search  = ['à','â','ä','é','è','ê','ë','î','ï','ô','ö','ù','û','ü','ç','ñ','æ','œ',"'"];
        $replace = ['a','a','a','e','e','e','e','i','i','o','o','u','u','u','c','n','ae','oe','-'];
        $text    = str_replace($search, $replace, $text);
        $text    = preg_replace('/[^a-z0-9]+/', '-', $text);
        return trim($text, '-');
    }

    public function rechercherParTitre(string $query): array {
        $stmt = $this->db->prepare(
            "SELECT j.id_job AS id, j.job_name AS titre, s.specialty AS specialite 
             FROM job j
             JOIN specialty s ON j.specialty_id = s.id_specialty
             WHERE j.job_name LIKE :query AND j.display = 1
             ORDER BY j.job_name ASC 
             LIMIT 5"
        );
        $stmt->execute([':query' => '%' . $query . '%']);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rows as &$row) {
            $row['slug'] = self::slugify($row['titre']);
        }
        return $rows;
    }

    public function rechercherParContenu(string $query): array {
        $stmt = $this->db->prepare(
            "SELECT j.id_job AS id, j.job_name AS titre, s.specialty AS specialite,
                    jc.content AS contenu
             FROM job j
             JOIN specialty s ON j.specialty_id = s.id_specialty
             LEFT JOIN job_content jc ON jc.job_id = j.id_job
             WHERE (j.job_name LIKE :query1 OR jc.content LIKE :query2) AND j.display = 1
             GROUP BY j.id_job
             ORDER BY j.job_name ASC"
        );
        $like = '%' . $query . '%';
        $stmt->execute([':query1' => $like, ':query2' => $like]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rows as &$row) {
            $row['slug'] = self::slugify($row['titre']);
        }
        return $rows;
    }
}
