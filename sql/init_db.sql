-- 1. On supprime proprement l'ancienne table si elle existe (CORRECTION : DROP au lieu de DELETE)
DROP TABLE IF EXISTS `metiers`;

-- 2. Création de la table des métiers avec sa structure
CREATE TABLE `metiers` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `titre` VARCHAR(100) NOT NULL,
    `description` TEXT NOT NULL,
    `specialite` VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Insertion de test (uniquement tes 3 métiers avec les bonnes spécialités)
INSERT INTO `metiers` (`titre`, `description`, `specialite`) VALUES
('Développeur Web', 'Expert du code qui construit le moteur et l''interface des sites.', 'developpeur'),
('UX Designer', 'Spécialiste de l''expérience utilisateur et des parcours fluides.', 'ux/ui'),
('Chef de Projet Marketing', 'Pilote de la stratégie digitale et de la visibilité.', 'marketing');