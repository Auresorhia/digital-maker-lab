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

INSERT IGNORE INTO `orientation_answer` (`id_answer`, `question_id`, `answer_letter`, `answer_text`, `specialty_id`, `points`, `position`) VALUES
(1, 1, 'A', 'Creer quelque chose de visuel et d''esthetique', 1, 3, 1),
(2, 1, 'B', 'Resoudre des problemes techniques complexes', 2, 3, 2),
(3, 1, 'C', 'Echanger avec des gens et convaincre', 3, 3, 3),
(4, 1, 'D', 'Analyser des donnees pour comprendre des tendances', 4, 3, 4),

(5, 2, 'A', 'Le design et l''experience visuelle', 1, 3, 1),
(6, 2, 'B', 'La rapidite et la fluidite technique', 2, 3, 2),
(7, 2, 'C', 'La facon dont l''app est pensee pour vendre ou convertir', 3, 3, 3),
(8, 2, 'D', 'Les fonctionnalites de securite et de confidentialite', 5, 3, 4),

(9, 3, 'A', 'Celui qui propose les idees creatives', 1, 3, 1),
(10, 3, 'B', 'Celui qui resout les problemes techniques', 2, 3, 2),
(11, 3, 'C', 'Celui qui organise et coordonne l''equipe', 6, 3, 3),
(12, 3, 'D', 'Celui qui prend du recul pour analyser les resultats', 4, 3, 4),

(13, 4, 'A', 'Ca m''intrigue, j''ai envie de comprendre', 2, 2, 1),
(14, 4, 'B', 'Ca ne me fait pas peur, j''aime la logique', 2, 3, 2),
(15, 4, 'C', 'Ca ne m''attire pas particulierement', 1, 1, 3),
(16, 4, 'D', 'Je prefere qu''on me l''explique simplement', 6, 2, 4),

(17, 5, 'A', 'Un open space creatif avec beaucoup d''echanges', 1, 2, 1),
(18, 5, 'B', 'Un poste calme, concentre sur la technique', 2, 3, 2),
(19, 5, 'C', 'Un rythme dynamique avec des objectifs chiffres', 3, 3, 3),
(20, 5, 'D', 'Un cadre structure avec des process clairs', 6, 3, 4),

(21, 6, 'A', 'Le rendu visuel final', 1, 3, 1),
(22, 6, 'B', 'La performance technique de la solution', 2, 3, 2),
(23, 6, 'C', 'Les resultats chiffres obtenus (ventes, audience...)', 3, 3, 3),
(24, 6, 'D', 'La satisfaction des personnes concernees', 6, 2, 4),

(25, 7, 'A', 'Concevoir l''interface d''une application', 1, 3, 1),
(26, 7, 'B', 'Securiser un systeme contre des attaques', 5, 3, 2),
(27, 7, 'C', 'Faire connaitre un produit aupres du plus grand nombre', 3, 3, 3),
(28, 7, 'D', 'Construire un jeu video de A a Z', 7, 3, 4),

(29, 8, 'A', 'En testant plusieurs solutions creatives', 1, 3, 1),
(30, 8, 'B', 'En analysant les donnees pour comprendre la cause', 4, 3, 2),
(31, 8, 'C', 'En ecrivant du code pour automatiser une solution', 2, 3, 3),
(32, 8, 'D', 'En coordonnant les bonnes personnes pour le resoudre', 6, 3, 4),

(33, 9, 'A', 'Le design et la creativite visuelle', 1, 3, 1),
(34, 9, 'B', 'La technique et la resolution de problemes', 2, 3, 2),
(35, 9, 'C', 'La strategie et la communication', 3, 3, 3),
(36, 9, 'D', 'La donnee et l''analyse', 4, 3, 4),

(37, 10, 'A', 'Essentiel, j''ai besoin d''echanger en permanence', 3, 3, 1),
(38, 10, 'B', 'Important mais pas en continu', 6, 2, 2),
(39, 10, 'C', 'Peu important, je prefere me concentrer seul', 2, 3, 3),
(40, 10, 'D', 'Cela depend du projet', 6, 1, 4),

(41, 11, 'A', 'Avoir un impact creatif visible', 1, 3, 1),
(42, 11, 'B', 'Maitriser une expertise technique recherchee', 2, 3, 2),
(43, 11, 'C', 'Evoluer vers des responsabilites de gestion de projet', 6, 3, 3),
(44, 11, 'D', 'Avoir un metier qui evolue vite et innove sans cesse', 7, 2, 4),

(45, 12, 'A', 'Je veux une formation courte', 3, 1, 1),
(46, 12, 'B', 'Je dois rester proche de chez moi', 6, 1, 2),
(47, 12, 'C', 'Le budget de la formation est une contrainte importante', 6, 1, 3),
(48, 12, 'D', 'Je n''ai pas de contrainte particuliere', 2, 1, 4);

COMMIT;
