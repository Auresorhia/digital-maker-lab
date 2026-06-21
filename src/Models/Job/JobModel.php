<?php
namespace Models;

use PDO;

class JobModel
{
    private PDO $db;

    /**
     * Connexion à la base de données.
     *
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Récupération de la totalité des métiers.
     * Rangés par date de création de manière décroissante.
     *
     * @return array
     */
    public function findAll(): array
    {
        $sql = "SELECT id_job, job_name, specialty_id FROM job ORDER BY created_at DESC";
        $stmt = $this->db->query($sql);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupérer un métier en fonction de son id.
     *
     * @param integer $id
     * @return array|null
     */
    public function findById(int $id): ?array
    {
        $sql = "SELECT id_job, job_name, specialty_id FROM job WHERE id_job = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    /**
     * Récupérer un métier en fonction de sa spécialité.
     *
     * @param integer $specialtyId
     * @return array
     */
    public function findBySpecialtyId(int $specialtyId): array
    {
        $sql = "SELECT id_job, job_name, specialty_id FROM job WHERE specialty_id = :specialty_id ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['specialty_id' => $specialtyId]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Créer un nouveau métier (une nouvelle ligne) dans la base de données.
     *
     * @param array $data
     * @return boolean
     */
    public function create(array $data): bool
    {
        $sql = "INSERT INTO job (job_name, specialty_id) 
                VALUES (:job_name, :specialty_id)";
        
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            'job_name'     => $data['job_name'],
            'specialty_id' => $data['specialty_id']
        ]);
    }

    /**
     * Mettre à jour les données d'un métier en base de données.
     *
     * @param integer $id
     * @param array $data
     * @return boolean
     */
    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE job 
                SET job_name = :job_name, 
                    specialty_id = :specialty_id, 
                    updated_at = NOW() 
                WHERE id_job = :id";
        
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            'id'           => $id,
            'job_name'     => $data['job_name'],
            'specialty_id' => $data['specialty_id']
        ]);
    }

    /**
     * Supprimer un métier en fonction de son id.
     *
     * @param integer $id
     * @return boolean
     */
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM job WHERE id_job = :id";
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute(['id' => $id]);
    }
}