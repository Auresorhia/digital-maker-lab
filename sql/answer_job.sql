SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

SET NAMES utf8mb4;

CREATE TABLE IF NOT EXISTS `orientation_answer_job` (
  `id_answer_job` int NOT NULL AUTO_INCREMENT,
  `answer_id` int NOT NULL,
  `job_id` int NOT NULL,
  `points` int NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_answer_job`),
  UNIQUE KEY `answer_job_unique` (`answer_id`, `job_id`),
  KEY `answer_id` (`answer_id`),
  KEY `job_id` (`job_id`),
  CONSTRAINT `orientation_answer_job_answer_fk` FOREIGN KEY (`answer_id`) REFERENCES `orientation_answer` (`id_answer`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orientation_answer_job_job_fk` FOREIGN KEY (`job_id`) REFERENCES `job` (`id_job`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `orientation_answer_job` (`answer_id`, `job_id`, `points`) VALUES
(1, 8, 5), (1, 7, 3), (1, 4, 2),
(2, 5, 5), (2, 4, 2),
(3, 6, 5), (3, 3, 3), (3, 2, 2),
(4, 4, 5), (4, 1, 4),
(5, 8, 5), (5, 7, 3), (5, 4, 2),
(6, 5, 5),
(7, 3, 5), (7, 6, 2), (7, 2, 2),
(8, 2, 5), (8, 6, 3), (8, 1, 2),
(9, 8, 5), (9, 7, 3), (9, 4, 2),
(10, 5, 5), (10, 4, 2),
(11, 1, 5), (11, 2, 4),
(12, 6, 5), (12, 7, 2), (12, 3, 2),
(13, 8, 4), (13, 6, 3), (13, 7, 2),
(14, 5, 5),
(15, 3, 5), (15, 2, 4), (15, 6, 2),
(16, 1, 5), (16, 2, 3),
(17, 8, 5), (17, 7, 2),
(18, 5, 5),
(19, 7, 5), (19, 6, 4), (19, 8, 2),
(20, 2, 5), (20, 3, 4), (20, 1, 3),
(21, 8, 5), (21, 7, 3),
(22, 5, 5),
(23, 3, 5), (23, 2, 5), (23, 6, 2),
(24, 4, 5), (24, 5, 2),
(25, 8, 5), (25, 7, 4),
(26, 5, 5),
(27, 3, 5), (27, 6, 5), (27, 2, 3),
(28, 1, 5), (28, 2, 3),
(29, 8, 5), (29, 7, 4),
(30, 5, 5),
(31, 3, 5), (31, 2, 5), (31, 6, 3),
(32, 4, 5), (32, 1, 3),
(33, 8, 5), (33, 7, 3),
(34, 5, 5),
(35, 3, 5), (35, 2, 4), (35, 6, 3),
(36, 1, 5), (36, 2, 3), (36, 6, 2),
(37, 8, 5), (37, 7, 2),
(38, 5, 5),
(39, 2, 5), (39, 3, 5), (39, 6, 4),
(40, 7, 5), (40, 4, 5),
(41, 8, 5), (41, 7, 3),
(42, 5, 5),
(43, 3, 5), (43, 6, 4), (43, 2, 3),
(44, 4, 5), (44, 1, 3),
(45, 8, 5), (45, 7, 3),
(46, 5, 5),
(47, 3, 5), (47, 2, 5), (47, 6, 4),
(48, 7, 5), (48, 4, 4), (48, 1, 4)
ON DUPLICATE KEY UPDATE
  `points` = VALUES(`points`);

COMMIT;
