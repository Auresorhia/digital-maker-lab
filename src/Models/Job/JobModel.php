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
        $sql = "SELECT id_job, job_name, display, specialty_id FROM job ORDER BY created_at DESC";
        $stmt = $this->db->query($sql);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère un métier et TOUT son contenu associé.
     *
     * @param integer $id
     * @return array|null
     */
    public function findById(int $id): ?array
    {
        // On récupère d'abord les infos principales de la table `job`.
        $sqlJob = "SELECT id_job, job_name, display, specialty_id FROM job WHERE id_job = :id";
        $stmtJob = $this->db->prepare($sqlJob);
        $stmtJob->execute(['id' => $id]);
        $job = $stmtJob->fetch(PDO::FETCH_ASSOC);

        // Si le métier n'existe pas, on s'arrête là.
        if (!$job) {
            return null;
        }

        // On fait correspondre 'job_name' avec le 'main_title' attendu par ta vue.
        $job['main_title'] = $job['job_name'];

        // On va chercher toutes les lignes de contenu dans `job_content`.
        $sqlContent = "SELECT section_name, content FROM job_content WHERE job_id = :id";
        $stmtContent = $this->db->prepare($sqlContent);
        $stmtContent->execute(['id' => $id]);
        $contents = $stmtContent->fetchAll(PDO::FETCH_ASSOC);

        // On reconstruit le tableau pour la vue.
        foreach ($contents as $row) {
            // Si section_name vaut 'explainer_title', ça crée : $job['explainer_title'] = 'Le contenu...'
            $job[$row['section_name']] = $row['content'];
        }

        return $job;
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
     * Permet la création des lignes de contenus dans les tables job et job_content.
     *
     * @param array $jobData
     * @param array $contentData
     * @return boolean
     */
    public function createWithContent(array $jobData, array $contentData): bool
    {
        try {
            // On démarre la transaction (mode "Tout ou Rien")
            $this->db->beginTransaction();

            // Insertion dans la table `job`.
            $sqlJob = "INSERT INTO job (job_name, specialty_id, display) 
                       VALUES (:job_name, :specialty_id, :display)";
            
            $stmtJob = $this->db->prepare($sqlJob);
            $stmtJob->execute([
                'job_name'     => $jobData['job_name'],
                'specialty_id' => $jobData['specialty_id'],
                'display'      => $jobData['display']
            ]);

            // On récupère l'ID du métier qui vient tout juste d'être créé.
            $jobId = $this->db->lastInsertId();

            // Insertion dans la table `job_content`.
            $sqlContent = "INSERT INTO job_content (job_id, section_name, content) 
                           VALUES (:job_id, :section_name, :content)";
            
            $stmtContent = $this->db->prepare($sqlContent);

            // On boucle sur chaque élément du formulaire pour créer une ligne par champ.
            foreach ($contentData as $key => $value) {
                // Ne pas insérer en base si le champ a été laissé vide.
                if ($value !== '') {
                    $stmtContent->execute([
                        'job_id'      => $jobId,
                        'section_name' => $key,
                        'content'     => $value
                    ]);
                }
            }

            // Tout s'est bien passé, on valide
            $this->db->commit();
            return true;

        } catch (\Exception $e) {
            // En cas d'erreur, on annule tout ce qui a été fait
            $this->db->rollBack();
            // On relance l'erreur pour pouvoir l'afficher à l'écran
            throw $e; 
        }
    }

    /**
     * Met à jour un métier et tout son contenu associé (Transaction SQL).
     *
     * @param integer $id
     * @param array $jobData
     * @param array $contentData
     * @return boolean
     */
    public function updateWithContent(int $id, array $jobData, array $contentData): bool
    {
        try {
            $this->db->beginTransaction();

            // Mise à jour de la table `job` (Nom et Display)
            $sqlJob = "UPDATE job 
                       SET job_name = :job_name, display = :display, updated_at = NOW() 
                       WHERE id_job = :id";
            
            $stmtJob = $this->db->prepare($sqlJob);
            $stmtJob->execute([
                'job_name' => $jobData['job_name'],
                'display'  => $jobData['display'],
                'id'       => $id
            ]);

            // On supprime les anciens contenus
            $sqlDelete = "DELETE FROM job_content WHERE job_id = :job_id";
            $stmtDelete = $this->db->prepare($sqlDelete);
            $stmtDelete->execute(['job_id' => $id]);

            // On insère les nouveaux contenus
            $sqlContent = "INSERT INTO job_content (job_id, section_name, content, created_at, updated_at) 
                           VALUES (:job_id, :section_name, :content, NOW(), NOW())";
            
            $stmtContent = $this->db->prepare($sqlContent);

            foreach ($contentData as $key => $value) {
                // On n'insère que les champs qui ne sont pas vides
                if ($value !== '') {
                    $stmtContent->execute([
                        'job_id'       => $id,
                        'section_name' => $key,
                        'content'      => $value
                    ]);
                }
            }

            // Tout s'est bien passé, on valide !
            $this->db->commit();
            return true;

        } catch (\Exception $e) {
            $this->db->rollBack();
            throw $e; 
        }
    }

    /**
     * Inverse le statut de visibilité d'un métier (0 devient 1, 1 devient 0)
     *
     * @param integer $id
     * @return boolean
     */
    public function toggleDisplay(int $id): bool
    {
        $sql = "UPDATE job SET display = 1 - display, updated_at = NOW() WHERE id_job = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Supprime un métier ET tout son contenu associé.
     *
     * @param integer $id
     * @return boolean
     */
    public function delete(int $id): bool
    {
        try {
            $this->db->beginTransaction();

            // On supprime d'abord les contenus enfants pour éviter les erreurs SQL
            $sqlContent = "DELETE FROM job_content WHERE job_id = :id";
            $stmtContent = $this->db->prepare($sqlContent);
            $stmtContent->execute(['id' => $id]);

            // Ensuite, on supprime le métier parent
            $sqlJob = "DELETE FROM job WHERE id_job = :id";
            $stmtJob = $this->db->prepare($sqlJob);
            $stmtJob->execute(['id' => $id]);

            // Tout est bon, on valide !
            $this->db->commit();
            return true;

        } catch (\Exception $e) {
            $this->db->rollBack();
            throw $e; 
        }
    }
}