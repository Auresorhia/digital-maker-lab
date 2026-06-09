-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mar. 09 juin 2026 à 21:02
-- Version du serveur : 8.0.35
-- Version de PHP : 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `digital_maker_lab`
--

-- --------------------------------------------------------

--
-- Structure de la table `job`
--

CREATE TABLE `job` (
  `id_job` int NOT NULL,
  `job_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `specialty_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_content`
--

CREATE TABLE `job_content` (
  `id_element` int NOT NULL,
  `job_id` int DEFAULT NULL,
  `title_h1` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `thumbnail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `job_description` text COLLATE utf8mb4_general_ci NOT NULL,
  `study_title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `study_description` text COLLATE utf8mb4_general_ci NOT NULL,
  `salary_title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `salary_description` text COLLATE utf8mb4_general_ci NOT NULL,
  `video_1` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `video_2` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `video_3` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `specialty`
--

CREATE TABLE `specialty` (
  `id_specialty` int NOT NULL,
  `specialty` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`id_job`),
  ADD KEY `fk_specialty` (`specialty_id`);

--
-- Index pour la table `job_content`
--
ALTER TABLE `job_content`
  ADD PRIMARY KEY (`id_element`),
  ADD KEY `FK` (`job_id`);

--
-- Index pour la table `specialty`
--
ALTER TABLE `specialty`
  ADD PRIMARY KEY (`id_specialty`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `job`
--
ALTER TABLE `job`
  MODIFY `id_job` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `job_content`
--
ALTER TABLE `job_content`
  MODIFY `id_element` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `specialty`
--
ALTER TABLE `specialty`
  MODIFY `id_specialty` int NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `fk_specialty` FOREIGN KEY (`specialty_id`) REFERENCES `specialty` (`id_specialty`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `job_content`
--
ALTER TABLE `job_content`
  ADD CONSTRAINT `FK` FOREIGN KEY (`job_id`) REFERENCES `job` (`id_job`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
