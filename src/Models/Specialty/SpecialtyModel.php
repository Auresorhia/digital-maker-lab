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
        $sql = "SELECT id_specialty, specialty FROM specialty ORDER BY created_at DESC";
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
        $sql = "SELECT id_specialty, specialty FROM specialty WHERE id_specialty = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    /**
     * Ajoute en base de données la nouvelle spécialité créée.
     *
     * @param array $data
     * @return boolean
     */
    public function create(array $data): bool
    {
        $sql = "INSERT INTO specialty (specialty) 
                VALUES (:specialty)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'specialty' => $data['specialty']
        ]);
    }

    /**
     * Modifie en base de données la cellule de la spécialité identifiée grâce à son id.
     * Cellule modifiée par les données récupérées par le formulaire.
     *
     * @param integer $id
     * @param array $data
     * @return boolean
     */
    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE specialty 
                SET specialty = :specialty, updated_at = NOW()
                WHERE id_specialty = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'id'        => $id,
            'specialty' => $data['specialty']
        ]);
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