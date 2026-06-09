-- Test de la création de la table des métiers
CREATE TABLE IF NOT EXISTS `metiers` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `titre` VARCHAR(100) NOT NULL,
    `description` TEXT NOT NULL,
    `specialite` VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Test d'affichage
INSERT INTO `metiers` (`titre`, `description`, `specialite`) VALUES
('Développeur Web', 'Expert du code qui construit le moteur et l''interface des sites.', 'Developpement'),
('UX Designer', 'Spécialiste de l''expérience utilisateur et des parcours fluides.', 'Design'),
('Chef de Projet Marketing', 'Pilote de la stratégie digitale et de la visibilité.', 'Marketing');
