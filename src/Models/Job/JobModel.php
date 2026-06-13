<?php
namespace Models;

use PDO;

class JobModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function findAll(): array
    {
        $sql = "SELECT id_job, job_name, specialty_id FROM job ORDER BY created_at DESC";
        $stmt = $this->db->query($sql);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $id): ?array
    {
        $sql = "SELECT id_job, job_name, specialty_id FROM job WHERE id_job = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function findBySpecialtyId(int $specialtyId): array
    {
        $sql = "SELECT id_job, job_name, specialty_id FROM job WHERE specialty_id = :specialty_id ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['specialty_id' => $specialtyId]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

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

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM job WHERE id_job = :id";
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute(['id' => $id]);
    }
}