<?php

// On charge manuellement la configuration de la base de données
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../core/Model.php';

class AdminModel extends Model
{
    /**
     * Recherche un administrateur par son ID
     * 
     * @param int $id
     * @return array|false
     */
    public function findById(int $id): array|false
    {
        $query = "SELECT id, email, created_at 
                  FROM admins 
                  WHERE id = :id 
                  LIMIT 1";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Crée un nouvel administrateur
     * 
     * @param string $identifiant
     * @param string $password (en clair, sera hashé)
     * @return bool
     */
    public function create(string $email, string $password): bool
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $query = "INSERT INTO admins (email, password) 
                  VALUES (:email, :password)";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        
        return $stmt->execute();
    }

    /**
     * Recherche un administrateur par son email
     * 
     * @param string $email
     * @return array|false
     */
    public function findByEmail(string $email): array|false
    {
        $query = "SELECT id, email, password, reset_code, reset_expires 
                  FROM admins 
                  WHERE email = :email 
                  LIMIT 1";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Enregistre un code de réinitialisation (hashé) avec sa date d'expiration
     * 
     * @param string $email
     * @param string $code Code à 4 chiffres en clair (sera hashé)
     * @param int $minutes Durée de validité en minutes
     * @return bool
     */
    public function saveResetCode(string $email, string $code, int $minutes = 10): bool
    {
        $hashedCode = password_hash($code, PASSWORD_DEFAULT);
        $expires = (new \DateTime())->modify("+{$minutes} minutes")->format('Y-m-d H:i:s');

        $query = "UPDATE admins 
                  SET reset_code = :code, reset_expires = :expires 
                  WHERE email = :email";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':code', $hashedCode, PDO::PARAM_STR);
        $stmt->bindParam(':expires', $expires, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        return $stmt->execute();
    }

    /**
     * Vérifie qu'un code de réinitialisation est valide et non expiré
     * 
     * @param string $email
     * @param string $code Code à 4 chiffres en clair
     * @return bool
     */
    public function verifyResetCode(string $email, string $code): bool
    {
        $admin = $this->findByEmail($email);

        if (!$admin || empty($admin['reset_code']) || empty($admin['reset_expires'])) {
            return false;
        }

        // Code expiré ?
        if (new \DateTime() > new \DateTime($admin['reset_expires'])) {
            return false;
        }

        return password_verify($code, $admin['reset_code']);
    }

    /**
     * Met à jour le mot de passe à partir de l'email et efface le code de réinitialisation
     * 
     * @param string $email
     * @param string $newPassword Mot de passe en clair (sera hashé)
     * @return bool
     */
    public function updatePasswordByEmail(string $email, string $newPassword): bool
    {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $query = "UPDATE admins 
                  SET password = :password, reset_code = NULL, reset_expires = NULL 
                  WHERE email = :email";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        return $stmt->execute();
    }
}
