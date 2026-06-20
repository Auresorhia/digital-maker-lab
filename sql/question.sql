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

INSERT IGNORE INTO `orientation_question` (`id_question`, `question_key`, `question_text`, `position`) VALUES
(1, 'q1', 'Qu''est-ce qui te donne le plus envie de te lever le matin pour travailler ?', 1),
(2, 'q2', 'Quand tu utilises une application ou un site, qu''est-ce qui attire le plus ton attention ?', 2),
(3, 'q3', 'Dans un projet de groupe, quel role prends-tu naturellement ?', 3),
(4, 'q4', 'Comment reagis-tu face a une ligne de code ou a un langage technique ?', 4),
(5, 'q5', 'Quel type d''environnement de travail te correspond le mieux ?', 5),
(6, 'q6', 'Qu''est-ce qui te rend le plus fier dans un projet termine ?', 6),
(7, 'q7', 'Si tu devais choisir une mission, laquelle te tente le plus ?', 7),
(8, 'q8', 'Face a un probleme complexe, comment preferes-tu agir ?', 8),
(9, 'q9', 'Qu''est-ce qui t''interesse le plus dans le digital ?', 9),
(10, 'q10', 'Quelle importance a le contact avec les autres dans ton travail ideal ?', 10),
(11, 'q11', 'Quelle ambition te motive le plus dans ta future carriere ?', 11),
(12, 'q12', 'As-tu des contraintes pratiques qui orientent ton choix de formation ou de metier ?', 12);

COMMIT;
