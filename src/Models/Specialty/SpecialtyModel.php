<?php
namespace Models;

use PDO;

class SpecialtyModel
{
    private PDO $db;

    /**
     * Connexion à la base de données
     *
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Récupère la totalité des spécialités avec leur id associé.
     * Les ranges par ordre décroissant
     *
     * @return array
     */
    public function findAll(): array
    {
        $sql = "SELECT id_specialty, specialty, display FROM specialty ORDER BY created_at DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère une spécialité avec son id associé, en fonction de son id.
     *
     * @param integer $id
     * @return array|null
     */
    public function findById(int $id): ?array
    {
        $sql = "SELECT id_specialty, specialty, display FROM specialty WHERE id_specialty = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    /**
     * Insère une nouvelle spécialité
     *
     * @param array $data
     * @return boolean
     */
    public function create(array $data): bool
    {
        $sql = "INSERT INTO specialty (specialty, display) 
                VALUES (:specialty, :display)";
        
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            'specialty' => $data['specialty'],
            'display'   => $data['display']
        ]);
    }

    /**
     * Met à jour une spécialité existante.
     *
     * @param integer $id
     * @param array $data
     * @return boolean
     */
    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE specialty 
                SET specialty = :specialty, 
                    display = :display, 
                    updated_at = NOW() 
                WHERE id_specialty = :id";
        
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            'specialty' => $data['specialty'],
            'display'   => $data['display'],
            'id'        => $id
        ]);
    }

    /**
     * Inverse le statut de visibilité d'une spécialité (0 devient 1, 1 devient 0)
     *
     * @param integer $id
     * @return boolean
     */
    public function toggleDisplay(int $id): bool
    {
        $sql = "UPDATE specialty 
                SET display = 1 - display, updated_at = NOW() 
                WHERE id_specialty = :id";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Supprime en base de données la spécialité identifiée par son id.
     *
     * @param integer $id
     * @return boolean
     */
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM specialty WHERE id_specialty = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}