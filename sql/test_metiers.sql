-- 1. Création de la nouvelle table avec ton nom personnalisé
CREATE TABLE IF NOT EXISTS `exemple_metiers` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `titre` VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,
    `specialite` VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Insertion des 8 métiers du quiz dedans
INSERT INTO `exemple_metiers` (`titre`, `description`, `specialite`) VALUES
('Créateur d''entreprise', 'Pilote et donne vie à des projets innovants en partant de zéro.', 'marketing'),
('Responsable CRM', 'Expert de la data et de la stratégie de fidélisation client.', 'marketing'),
('Consultant SEO', 'Spécialiste du référencement naturel pour dominer les moteurs de recherche.', 'marketing'),
('Game Designer', 'Architecte des règles, des mécaniques et de l''expérience de jeu.', 'ux/ui'),
('Développeur Web', 'Expert du code qui construit le moteur et l''interface des sites.', 'developpeur'),
('Community Manager', 'Gestionnaire et animateur des réseaux sociaux pour fédérer une communauté.', 'marketing'),
('Vidéaste', 'Professionnel de la captation, du montage et de la réalisation de contenus vidéo.', 'motion design'),
('Graphiste', 'Créateur d''identités visuelles et de supports de communication percutants.', 'designer');