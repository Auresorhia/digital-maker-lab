SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

SET NAMES utf8mb4;

CREATE TABLE IF NOT EXISTS `orientation_question` (
  `id_question` int NOT NULL AUTO_INCREMENT,
  `question_key` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `question_text` text COLLATE utf8mb4_general_ci NOT NULL,
  `position` int NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_question`),
  UNIQUE KEY `question_key` (`question_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `orientation_question` (`id_question`, `question_key`, `question_text`, `position`) VALUES
(1, 'q1', 'Quel type de mission te motive le plus ?', 1),
(2, 'q2', 'Quand tu decouvres un site, une video ou une campagne, qu''est-ce qui attire ton attention ?', 2),
(3, 'q3', 'Dans un projet de groupe, quel role prends-tu naturellement ?', 3),
(4, 'q4', 'Quel probleme aimerais-tu le plus resoudre ?', 4),
(5, 'q5', 'Quel livrable aimerais-tu produire ?', 5),
(6, 'q6', 'Quelle activite te parait la plus naturelle ?', 6),
(7, 'q7', 'Quel environnement de travail te correspond le mieux ?', 7),
(8, 'q8', 'Si un projet ne fonctionne pas, que veux-tu ameliorer en premier ?', 8),
(9, 'q9', 'Quelle phrase te ressemble le plus ?', 9),
(10, 'q10', 'Avec quels outils aimerais-tu travailler le plus souvent ?', 10),
(11, 'q11', 'Quel resultat te rendrait le plus fier ?', 11),
(12, 'q12', 'Dans quel domaine aimerais-tu progresser en priorite ?', 12)
ON DUPLICATE KEY UPDATE
  `question_key` = VALUES(`question_key`),
  `question_text` = VALUES(`question_text`),
  `position` = VALUES(`position`);

COMMIT;
