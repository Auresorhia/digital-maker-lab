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

COMMIT;
