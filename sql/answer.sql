SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

SET NAMES utf8mb4;

CREATE TABLE IF NOT EXISTS `orientation_answer` (
  `id_answer` int NOT NULL AUTO_INCREMENT,
  `question_id` int NOT NULL,
  `answer_letter` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  `answer_text` text COLLATE utf8mb4_general_ci NOT NULL,
  `specialty_id` int NOT NULL,
  `points` int NOT NULL DEFAULT 1,
  `position` int NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_answer`),
  KEY `question_id` (`question_id`),
  KEY `specialty_id` (`specialty_id`),
  CONSTRAINT `orientation_answer_question_fk` FOREIGN KEY (`question_id`) REFERENCES `orientation_question` (`id_question`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orientation_answer_specialty_fk` FOREIGN KEY (`specialty_id`) REFERENCES `specialty` (`id_specialty`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `orientation_answer` (`id_answer`, `question_id`, `answer_letter`, `answer_text`, `specialty_id`, `points`, `position`) VALUES
(1, 1, 'A', 'Creer une identite visuelle ou un support graphique', 1, 3, 1),
(2, 1, 'B', 'Developper un site ou une fonctionnalite web', 2, 3, 2),
(3, 1, 'C', 'Faire connaitre une marque et animer une communaute', 1, 3, 3),
(4, 1, 'D', 'Imaginer un concept de jeu ou lancer un projet', 1, 3, 4),

(5, 2, 'A', 'Le rendu visuel, les images et la composition', 1, 3, 1),
(6, 2, 'B', 'La fluidite technique et le fonctionnement du site', 2, 3, 2),
(7, 2, 'C', 'La visibilite sur Google et les mots utilises', 1, 3, 3),
(8, 2, 'D', 'La relation avec les utilisateurs ou clients', 1, 3, 4),

(9, 3, 'A', 'Celui qui propose des idees creatives et visuelles', 1, 3, 1),
(10, 3, 'B', 'Celui qui construit la solution technique', 2, 3, 2),
(11, 3, 'C', 'Celui qui organise, vend l''idee et prend des decisions', 1, 3, 3),
(12, 3, 'D', 'Celui qui communique, publie et fait vivre le projet', 1, 3, 4),

(13, 4, 'A', 'Rendre un message plus clair et plus attractif', 1, 3, 1),
(14, 4, 'B', 'Corriger un bug ou automatiser une action', 2, 3, 2),
(15, 4, 'C', 'Comprendre pourquoi un contenu ne performe pas', 1, 3, 3),
(16, 4, 'D', 'Transformer une idee en projet viable', 1, 3, 4),

(17, 5, 'A', 'Une affiche, un logo ou une charte graphique', 1, 3, 1),
(18, 5, 'B', 'Un site web fonctionnel', 2, 3, 2),
(19, 5, 'C', 'Une video ou un contenu pour les reseaux sociaux', 1, 3, 3),
(20, 5, 'D', 'Une strategie pour attirer et fideliser des clients', 1, 3, 4),

(21, 6, 'A', 'Designer des visuels et choisir une direction artistique', 1, 3, 1),
(22, 6, 'B', 'Coder, tester et ameliorer une interface web', 2, 3, 2),
(23, 6, 'C', 'Analyser des audiences, des mots-cles ou des campagnes', 1, 3, 3),
(24, 6, 'D', 'Concevoir des mecanismes de jeu ou une experience interactive', 1, 3, 4),

(25, 7, 'A', 'Un studio creatif avec de la production visuelle', 1, 3, 1),
(26, 7, 'B', 'Un environnement calme pour developper et resoudre des problemes', 2, 3, 2),
(27, 7, 'C', 'Une equipe marketing avec des objectifs de visibilite', 1, 3, 3),
(28, 7, 'D', 'Un contexte entrepreneurial avec des decisions rapides', 1, 3, 4),

(29, 8, 'A', 'Son image, son style et sa coherence visuelle', 1, 3, 1),
(30, 8, 'B', 'Son code, sa rapidite et ses fonctionnalites', 2, 3, 2),
(31, 8, 'C', 'Sa visibilite, son audience et son taux de conversion', 1, 3, 3),
(32, 8, 'D', 'Son concept, son positionnement ou son experience de jeu', 1, 3, 4),

(33, 9, 'A', 'J''aime transformer une idee en image forte', 1, 3, 1),
(34, 9, 'B', 'J''aime construire une solution qui fonctionne vraiment', 2, 3, 2),
(35, 9, 'C', 'J''aime comprendre les publics et optimiser une strategie', 1, 3, 3),
(36, 9, 'D', 'J''aime porter une vision et convaincre les autres', 1, 3, 4),

(37, 10, 'A', 'Photoshop, Illustrator, Figma ou Canva', 1, 3, 1),
(38, 10, 'B', 'VS Code, GitHub et un navigateur de test', 2, 3, 2),
(39, 10, 'C', 'Google Analytics, Search Console, CRM ou outils social media', 1, 3, 3),
(40, 10, 'D', 'Camera, logiciel de montage ou outil de game design', 1, 3, 4),

(41, 11, 'A', 'Un visuel professionnel que les gens retiennent', 1, 3, 1),
(42, 11, 'B', 'Un site rapide, stable et utile', 2, 3, 2),
(43, 11, 'C', 'Une campagne qui gagne en audience ou en clients', 1, 3, 3),
(44, 11, 'D', 'Un projet original qui donne envie d''etre explore', 1, 3, 4),

(45, 12, 'A', 'Creation graphique et direction artistique', 1, 3, 1),
(46, 12, 'B', 'Developpement web et logique technique', 2, 3, 2),
(47, 12, 'C', 'Marketing digital, SEO, CRM et reseaux sociaux', 1, 3, 3),
(48, 12, 'D', 'Video, jeu video ou entrepreneuriat', 1, 3, 4)
ON DUPLICATE KEY UPDATE
  `question_id` = VALUES(`question_id`),
  `answer_letter` = VALUES(`answer_letter`),
  `answer_text` = VALUES(`answer_text`),
  `specialty_id` = VALUES(`specialty_id`),
  `points` = VALUES(`points`),
  `position` = VALUES(`position`);

COMMIT;
