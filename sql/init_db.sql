-- 1. On vide la table pour éviter les conflits d'ID (si MySQL bloque à cause des clés étrangères, utilise TRUNCATE)
DELETE FROM `metiers`;

-- 2. On insère les 8 métiers du digital avec les ID exacts requis pour le quiz
INSERT INTO `metiers` (`id`, `titre`, `description`, `specialite`) VALUES
(1, 'Créateur d''entreprise', 'Pilote et donne vie à des projets innovants en partant de zéro.', 'Entrepreneuriat'),
(2, 'Responsable CRM', 'Expert de la data et de la stratégie de fidélisation client.', 'Marketing'),
(3, 'Consultant SEO', 'Spécialiste du référencement naturel pour dominer les moteurs de recherche.', 'Marketing'),
(4, 'Game Designer', 'Architecte des règles, des mécaniques et de l''expérience de jeu.', 'Jeux Vidéo'),
(5, 'Développeur Web', 'Expert du code qui construit le moteur et l''interface des sites.', 'Développement'),
(6, 'Community Manager', 'Gestionnaire et animateur des réseaux sociaux pour fédérer une communauté.', 'Communication'),
(7, 'Vidéaste', 'Professionnel de la captation, du montage et de la réalisation de contenus vidéo.', 'Audiovisuel'),
(8, 'Graphiste', 'Créateur d''identités visuelles et de supports de communication percutants.', 'Design');