-- 1. On vide la table pour éviter les conflits d'ID (si MySQL bloque à cause des clés étrangères, utilise TRUNCATE)
DELETE FROM `metiers`;

-- 2. On insère les 8 métiers du digital avec les ID exacts requis pour le quiz
INSERT INTO `metiers` (`id`, `titre`, `description`, `specialite`) VALUES
('Créateur d''entreprise', 'Pilote et donne vie à des projets innovants en partant de zéro.', 'marketing'),
('Responsable CRM', 'Expert de la data et de la stratégie de fidélisation client.', 'marketing'),
('Consultant SEO', 'Spécialiste du référencement naturel pour dominer les moteurs de recherche.', 'marketing'),
('Game Designer', 'Architecte des règles, des mécaniques et de l''expérience de jeu.', 'ux/ui'),
('Développeur Web', 'Expert du code qui construit le moteur et l''interface des sites.', 'developpeur'),
('Community Manager', 'Gestionnaire et animateur des réseaux sociaux pour fédérer une communauté.', 'marketing'),
('Vidéaste', 'Professionnel de la captation, du montage et de la réalisation de contenus vidéo.', 'motion design'),
('Graphiste', 'Créateur d''identités visuelles et de supports de communication percutants.', 'designer');