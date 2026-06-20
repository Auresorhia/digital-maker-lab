SET FOREIGN_KEY_CHECKS=0;

-- Suppression de toutes les tables (ordre inverse des dépendances)
DROP TABLE IF EXISTS `orientation_answer_job`;
DROP TABLE IF EXISTS `orientation_answer`;
DROP TABLE IF EXISTS `orientation_question`;
DROP TABLE IF EXISTS `quiz_job_answer`;
DROP TABLE IF EXISTS `quiz_job_question`;
DROP TABLE IF EXISTS `job_content`;
DROP TABLE IF EXISTS `job`;
DROP TABLE IF EXISTS `specialty`;
DROP TABLE IF EXISTS `admins`;
DROP TABLE IF EXISTS `events`;

CREATE TABLE `events` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `date_start` DATETIME NOT NULL,
    `date_end` DATETIME NULL,
    `location` VARCHAR(150),
    `format` ENUM('presentiel', 'online', 'hybride') NOT NULL DEFAULT 'online',
    `themes` VARCHAR(255),
    `link` VARCHAR(500),
    `image` VARCHAR(500),
    `organizer` VARCHAR(100),
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- ============================================
-- Fichier SQL pour la fonctionnalité Login Admin
-- Auteur: [Votre nom]
-- Date: 2026-06-01
-- ============================================
-- 
-- Ce fichier contient les requêtes SQL nécessaires
-- pour la fonctionnalité de connexion administrateur
-- 
-- À MENTIONNER dans la Pull Request pour intégration
-- dans le fichier init_db.sql principal
-- ============================================

-- Création de la table admins
DROP TABLE IF EXISTS admins;
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    reset_code VARCHAR(255) NULL,
    reset_expires DATETIME NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertion d'un compte admin par défaut (à modifier en production)
-- Email: leo.duriezj@gmail.com
-- Mot de passe: Admin123! (à changer immédiatement après la première connexion)
INSERT IGNORE INTO admins (email, password) VALUES
('leo.duriezj@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');




-- =========================================================================
-- 1. CRÉATION DES TABLES
-- =========================================================================



--
-- Structure de la table `specialty`
--

DROP TABLE IF EXISTS `specialty`;
CREATE TABLE `specialty` (
  `id_specialty` int NOT NULL,
  `specialty` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `display` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `specialty` (`id_specialty`, `specialty`, `display`, `created_at`, `updated_at`) VALUES
(1, 'UXPO', 0, '2026-06-13 14:10:08', '2026-06-13 14:10:08'),
(2, 'DEV', 0, '2026-06-13 14:21:24', '2026-06-13 14:21:24');

ALTER TABLE `specialty`
  ADD PRIMARY KEY (`id_specialty`);

ALTER TABLE `specialty`
  MODIFY `id_specialty` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Structure de la table `job`
--

DROP TABLE IF EXISTS `job`;
CREATE TABLE `job` (
  `id_job` int NOT NULL,
  `job_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `display` tinyint(1) NOT NULL DEFAULT '1',
  `specialty_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `job` (`id_job`, `job_name`, `display`, `specialty_id`, `created_at`, `updated_at`) VALUES
(1, 'Créateur d''Entreprise', 1, 1, '2026-06-13 00:00:00', '2026-06-13 00:00:00'),
(2, 'Responsable CRM', 1, 1, '2026-06-13 00:00:00', '2026-06-13 00:00:00'),
(3, 'Consultant SEO', 1, 1, '2026-06-13 00:00:00', '2026-06-13 00:00:00'),
(4, 'Game Designer', 1, 1, '2026-06-13 00:00:00', '2026-06-13 00:00:00'),
(5, 'Développeur Web', 1, 2, '2026-06-13 00:00:00', '2026-06-13 00:00:00'),
(6, 'Community Manager', 1, 1, '2026-06-13 00:00:00', '2026-06-13 00:00:00'),
(7, 'Vidéaste', 1, 1, '2026-06-13 00:00:00', '2026-06-13 00:00:00'),
(8, 'Graphiste', 1, 1, '2026-06-13 00:00:00', '2026-06-13 00:00:00');

ALTER TABLE `job`
  ADD PRIMARY KEY (`id_job`),
  ADD KEY `fk_specialty` (`specialty_id`);

ALTER TABLE `job`
  MODIFY `id_job` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `job`
  ADD CONSTRAINT `fk_specialty` FOREIGN KEY (`specialty_id`) REFERENCES `specialty` (`id_specialty`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Structure de la table `job_content`
--

DROP TABLE IF EXISTS `job_content`;
CREATE TABLE `job_content` (
  `id_element` int NOT NULL,
  `job_id` int DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `job_content`
  ADD PRIMARY KEY (`id_element`),
  ADD KEY `FK` (`job_id`);

ALTER TABLE `job_content`
  MODIFY `id_element` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `job_content`
  ADD CONSTRAINT `FK` FOREIGN KEY (`job_id`) REFERENCES `job` (`id_job`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Structure des tables du quiz d'orientation
--

CREATE TABLE `orientation_question` (
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

CREATE TABLE `orientation_answer` (
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

CREATE TABLE `orientation_answer_job` (
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

--
-- Structure des tables du quiz métier
--

DROP TABLE IF EXISTS `quiz_job_answer`;
DROP TABLE IF EXISTS `quiz_job_question`;
CREATE TABLE `quiz_job_question` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `question_text` TEXT NOT NULL,
    `job_id` INT NOT NULL,
    `level` VARCHAR(50) NOT NULL,
    CONSTRAINT `fk_quiz_job_question_job` 
        FOREIGN KEY (`job_id`) REFERENCES `job`(`id_job`) 
        ON DELETE CASCADE 
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- =========================================================================
-- 2. TABLE DES RÉPONSES DU QUIZ
-- =========================================================================


CREATE TABLE `quiz_job_answer` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `answer_text` TEXT NOT NULL,
    `question_id` INT NOT NULL,
    `explanation` TEXT NULL,
    `is_correct` TINYINT(1) NOT NULL DEFAULT 0,
    CONSTRAINT `fk_quiz_job_answer_quiz_job_question` 
        FOREIGN KEY (`question_id`) REFERENCES `quiz_job_question`(`id`) 
        ON DELETE CASCADE 
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =========================================================================
-- 2. SEEDING DES DONNÉES (80 QUESTIONS SANS ID MANUELS)
-- =========================================================================

-- -------------------------------------------------------------------------
-- MÉTIER 1 : CRÉATEUR D'ENTREPRISE (ENTREPRENEUR)
-- -------------------------------------------------------------------------
INSERT INTO `quiz_job_question` (`question_text`, `job_id`, `level`) VALUES
('Un créateur d''entreprise doit obligatoirement avoir une idée révolutionnaire pour se lancer.', 1, 'easy'),
('Il est aujourd''hui possible de créer un produit technologique sans savoir coder.', 1, 'medium'),
('Le statut de micro-entrepreneur permet de réaliser un chiffre d''affaires illimité.', 1, 'easy'),
('L''étude de marché est une garantie absolue de la réussite du projet.', 1, 'medium'),
('Le "pitch" est un exercice de présentation réservé uniquement aux investisseurs.', 1, 'easy'),
('Un entrepreneur passe souvent par une phase de prototypage (MVP) pour tester son idée.', 1, 'hard'),
('Développer son réseau (networking) est facultatif dans la création d''entreprise.', 1, 'easy'),
('Un créateur d''entreprise est toujours le seul décisionnaire de sa société.', 1, 'medium'),
('Un entrepreneur doit obligatoirement déposer un brevet pour chaque idée qu''il a.', 1, 'hard'),
('L''échec d''une première entreprise interdit légalement d''en créer une nouvelle.', 1, 'easy');

INSERT INTO `quiz_job_answer` (`question_id`, `answer_text`, `explanation`, `is_correct`) VALUES
(1, 'Vrai', 'Beaucoup d''entreprises à succès se contentent d''améliorer un produit ou un service existant.', 0),
(1, 'Faux', 'Beaucoup d''entreprises à succès se contentent d''améliorer un produit ou un service existant sur le marché.', 1),
(2, 'Vrai', 'Les outils "No-Code" (comme Bubble ou Make) permettent de développer des applications fonctionnelles sans taper de lignes de code.', 1),
(2, 'Faux', 'Les outils No-Code permettent aujourd''hui de concevoir des plateformes sans maîtriser la programmation.', 0),
(3, 'Vrai', 'Le régime de la micro-entreprise est soumis à des seuils stricts de chiffre d''affaires.', 0),
(3, 'Faux', 'Ce statut est soumis à des plafonds de chiffre d''affaires à ne pas dépasser.', 1),
(4, 'Vrai', 'L''étude de marché balise le terrain mais n''annule jamais totalement le risque entrepreneurial.', 0),
(4, 'Faux', 'Elle limite grandement les risques, mais le succès dépend aussi de l''exécution, du timing et de la stratégie.', 1),
(5, 'Vrai', 'Le pitch s''adresse également aux futurs collaborateurs, partenaires et premiers clients.', 0),
(5, 'Faux', 'Il sert tout autant à convaincre de potentiels clients, des associés ou des partenaires commerciaux.', 1),
(6, 'Vrai', 'Le Minimum Viable Product permet de confronter rapidement l''idée au marché avec un minimum de frais.', 1),
(6, 'Faux', 'Le développement d''un MVP est indispensable pour récolter les retours des premiers utilisateurs.', 0),
(7, 'Vrai', 'Se priver de réseau ralentit considérablement l''accès aux opportunités et aux soutiens clés.', 0),
(7, 'Faux', 'Le réseau est souvent le premier levier pour trouver des clients, des fournisseurs ou des associés.', 1),
(8, 'Vrai', 'La présence d''associés ou d''actionnaires implique un partage légal du pouvoir décisionnel.', 0),
(8, 'Faux', 'S''il a des associés ou des investisseurs, les décisions stratégiques sont souvent partagées.', 1),
(9, 'Vrai', 'Une simple idée abstraite ne peut pas être brevetée, seule une invention technique concrète le peut.', 0),
(9, 'Faux', 'Une idée seule ne se brevète pas (seule une invention technique le peut), et le brevet est coûteux.', 1),
(10, 'Vrai', 'Sauf interdiction judiciaire explicite, rebondir après un échec est un droit fondamental.', 0),
(10, 'Faux', 'L''échec fait partie de l''apprentissage entrepreneurial (sauf interdiction de gestion prononcée par un juge).', 1);

-- -------------------------------------------------------------------------
-- MÉTIER 2 : RESPONSABLE CRM
-- -------------------------------------------------------------------------
INSERT INTO `quiz_job_question` (`question_text`, `job_id`, `level`) VALUES
('L''objectif principal du responsable CRM est d''acquérir de nouveaux abonnés sur les réseaux sociaux.', 2, 'easy'),
('Il utilise la data pour personnaliser au maximum ses communications.', 2, 'easy'),
('Le RGPD (Règlement Général sur la Protection des Données) a un impact direct sur son travail.', 2, 'medium'),
('L''automatisation (Marketing Automation) est au cœur de son métier.', 2, 'easy'),
('Le responsable CRM s''intéresse uniquement aux clients qui achètent beaucoup.', 2, 'medium'),
('Le "taux de désabonnement" est un indicateur qu''il ne prend pas en compte.', 2, 'easy'),
('Un outil CRM (comme Salesforce, HubSpot ou Brevo) est indispensable à sa mission.', 2, 'easy'),
('Il est frequent que le CRM gère des campagnes par SMS.', 2, 'medium'),
('Le responsable CRM gère la création des campagnes publicitaires sur Meta Ads.', 2, 'hard'),
('Le "Lead Scoring" est une technique qu''il utilise pour évaluer la maturité d''un prospect.', 2, 'hard');

INSERT INTO `quiz_job_answer` (`question_id`, `answer_text`, `explanation`, `is_correct`) VALUES
(11, 'Vrai', 'L''acquisition d''audience externe est plutôt la mission du pôle Growth ou Social Media.', 0),
(11, 'Faux', 'Son rôle principal est la fidélisation des clients existants et l''optimisation de leur valeur sur le long terme.', 1),
(12, 'Vrai', 'La segmentation de la base de données permet d''envoyer le bon message à la bonne personne.', 1),
(12, 'Faux', 'L''exploitation fine des profils d''achat permet d''éviter d''envoyer des messages génériques.', 0),
(13, 'Vrai', 'Il doit s''assurer que la collecte et l''utilisation des adresses e-mail respectent le consentement des utilisateurs.', 1),
(13, 'Faux', 'La gestion des consentements (Opt-in) est l''un des piliers légaux indispensables à son activité.', 0),
(14, 'Vrai', 'Il crée des scénarios automatisés (comme les e-mails de bienvenue ou de relance de panier abandonné).', 1),
(14, 'Faux', 'Sans l''automatisation, il serait impossible de gérer des parcours personnalisés à grande échelle.', 0),
(15, 'Vrai', 'Les clients inactifs ou à faible valeur représentent un gisement de croissance qu''il doit réactiver.', 0),
(15, 'Faux', 'Il crée des stratégies pour réactiver les clients "dormants" et fidéliser les nouveaux acheteurs.', 1),
(16, 'Vrai', 'Un taux de désabonnement élevé traduit une pression trop forte ou un contenu inadapté qu''il doit corriger.', 0),
(16, 'Faux', 'C''est un KPI majeur. Un taux élevé indique que la pression marketing est trop forte ou le contenu non pertinent.', 1),
(17, 'Vrai', 'C''est le logiciel qui lui permet de centraliser la donnée client et de programmer ses campagnes.', 1),
(17, 'Faux', 'Centraliser l''historique et l''ensemble des interactions clients exige un progiciel dédié.', 0),
(18, 'Vrai', 'Le CRM ne se limite pas à l''e-mail, il inclut tous les canaux de relation directe (SMS, notifications push).', 1),
(18, 'Faux', 'Le SMS marketing affiche des taux d''ouverture massifs très exploités en fidélisation.', 0),
(19, 'Vrai', 'Les publicités payantes sur les réseaux relèvent de la responsabilité du Traffic Manager.', 0),
(19, 'Faux', 'C''est rôle du Traffic Manager ou du Media Buyer.', 1),
(20, 'Vrai', 'Il attribue des points aux prospects selon leurs actions (clic sur un lien, téléchargement d''un document) pour les cibler efficacement.', 1),
(20, 'Faux', 'Le calcul d''un score de chaleur permet de transmettre le prospect aux commerciaux au moment opportun.', 0);

-- -------------------------------------------------------------------------
-- MÉTIER 3 : CONSULTANT SEO
-- -------------------------------------------------------------------------
INSERT INTO `quiz_job_question` (`question_text`, `job_id`, `level`) VALUES
('Le SEO permet d''obtenir des résultats immédiats en quelques jours.', 3, 'easy'),
('L''optimisation technique de la structure d''un site web fait partie de ses missions.', 3, 'medium'),
('Le consultant SEO achète des mots-clés à Google pour que son site apparaisse en premier.', 3, 'easy'),
('L''autorité d''un domaine, acquise grâce aux "backlinks" (liens entrants), est un pilier du SEO.', 3, 'medium'),
('Pour être bien référencé, un texte doit répéter le mot-clé le plus de fois possible.', 3, 'easy'),
('Il analyse les volumes de recherche mensuels pour définir sa stratégie sémantique.', 3, 'medium'),
('La balise "Title" est l''un des éléments textuels les plus importants pour les moteurs de recherche.', 3, 'easy'),
('L''expérience utilisateur (UX) n''a aucune influence sur le référencement naturel.', 3, 'medium'),
('Le concept du "cocon sémantique" est une technique d''organisation du contenu.', 3, 'hard'),
('La recherche vocale (via smartphones ou enceintes connectées) ne concerne pas le SEO.', 3, 'hard');

INSERT INTO `quiz_job_answer` (`question_id`, `answer_text`, `explanation`, `is_correct`) VALUES
(21, 'Vrai', 'Le positionnement naturel demande du temps pour que l''indexation de Google se stabilise.', 0),
(21, 'Faux', 'Le référencement naturel est une stratégie de moyen/long terme qui prend souvent plusieurs mois à porter ses fruits.', 1),
(22, 'Vrai', 'Vitesse de chargement, adaptation mobile et architecture des URL sont des prérequis SEO.', 1),
(22, 'Faux', 'Un site techniquement défaillant ou trop lent sera déclassé par les moteurs de recherche.', 0),
(23, 'Vrai', 'L''achat d''annonces sponsorisées correspond au référencement payant (SEA).', 0),
(23, 'Faux', 'L''achat de mots-clés relève du SEA (référencement payant). Le SEO concerne les résultats de recherche organiques (gratuits).', 1),
(24, 'Vrai', 'Plus des sites de confiance pointent vers le vôtre, plus Google considère votre site comme pertinent.', 1),
(24, 'Faux', 'Le netlinking reste un critère majeur d''évaluation de la popularité d''un nom de domaine.', 0),
(25, 'Vrai', 'Le sur-optimisation sémantique est pénalisée par les algorithmes modernes au profit du confort de lecture.', 0),
(25, 'Faux', 'Le "Keyword Stuffing" (bourrage de mots-clés) lourdement pénalisé par les algorithmes de Google aujourd''hui.', 1),
(26, 'Vrai', 'Cela lui permet de cibler des mots-clés que les internautes tapent réellement.', 1),
(26, 'Faux', 'Se positionner sur des expressions dénuées de trafic n''apportera aucune visite au site.', 0),
(27, 'Vrai', 'C''est le titre cliquable bleu dans les résultats Google, essentiel pour la compréhension de la page par l''algorithme.', 1),
(27, 'Faux', 'Cette balise indique explicitement le sujet traité aux robots d''indexation.', 0),
(28, 'Vrai', 'Un taux de rebond anormal indique à Google que la page répond mal à l''intention de recherche.', 0),
(28, 'Faux', 'Google prend en compte le comportement des utilisateurs (taux de rebond, temps passé sur la page) pour classer les sites.', 1),
(29, 'Vrai', 'Il s''agit de mailler les pages d''un site entre elles de manière logique autour d''une thématique précise.', 1),
(29, 'Faux', 'Cette architecture de liens internes renforce la puissance sémantique des pages mères.', 0),
(30, 'Vrai', 'Les utilisateurs s''exprimant de vive voix, les requêtes sémantiques deviennent plus longues et conversationnelles.', 0),
(30, 'Faux', 'Le SEO s''adapte à la recherche vocale en ciblant des requêtes plus longues et formulées sous forme de questions directes.', 1);

-- -------------------------------------------------------------------------
-- MÉTIER 4 : GAME DESIGNER
-- -------------------------------------------------------------------------
INSERT INTO `quiz_job_question` (`question_text`, `job_id`, `level`) VALUES
('Le Game Designer est la personne qui dessine et modélise les environnements en 3D.', 4, 'easy'),
('Son travail inclut la gestion de l''équilibrage de la difficulté.', 4, 'medium'),
('Il doit obligatoirement être un développeur expert et écrire tout le code du jeu.', 4, 'easy'),
('La psychologie du joueur est un élément central de sa réflexion.', 4, 'easy'),
('Il s''occupe de la gestion des campagnes publicitaires pour promouvoir le jeu.', 4, 'easy'),
('Le "Level Design" (la création des parcours dans les niveaux) est une branche de son domaine.', 4, 'medium'),
('Il rédige souvent un cahier des charges appelé "Game Design Document" (GDD).', 4, 'medium'),
('La création du système de loot (récompenses) fait partie de ses attributions.', 4, 'hard'),
('Le prototypage rapide est une perte de temps dans le cycle de production.', 4, 'medium'),
('Il compose la bande originale et crée les bruitages du jeu.', 4, 'easy');

INSERT INTO `quiz_job_answer` (`question_id`, `answer_text`, `explanation`, `is_correct`) VALUES
(31, 'Vrai', 'La dimension esthétique et visuelle est l''œuvre dédiée du pôle Game Art.', 0),
(31, 'Faux', 'La création visuelle est le rôle des graphistes et modélisateurs. Le Game Designer conçoit les règles et les mécaniques du jeu.', 1),
(32, 'Vrai', 'Il s''assure que le jeu n''est ni trop frustrant, ni trop facile, pour maintenir l''engagement du joueur.', 1),
(32, 'Faux', 'Ajuster les statistiques de jeu pour préserver l''intérêt sans lasser est l''une de ses missions.', 0),
(33, 'Vrai', 'La programmation pure de l''arborescence informatique du jeu revient aux développeurs.', 0),
(33, 'Faux', 'Bien que des bases soient utiles, le développement est géré par les programmeurs.', 1),
(34, 'Vrai', 'Il doit comprendre ce qui motive les joueurs (récompense, exploration, compétition) pour adapter les mécaniques.', 1),
(34, 'Faux', 'L''analyse des moteurs de satisfaction de l''utilisateur guide l''ensemble des mécaniques de jeu.', 0),
(35, 'Vrai', 'La mise en marché et les budgets promotionnels relèvent du pôle marketing ou de l''éditeur.', 0),
(35, 'Faux', 'C''est le rôle de l''équipe marketing ou de l''éditeur du jeu.', 1),
(36, 'Vrai', 'Le Level Designer applique les règles du Game Design pour construire l''environnement interactif.', 1),
(36, 'Faux', 'L''agencement spatial des obstacles et des récompenses découle directement des règles globales.', 0),
(37, 'Vrai', 'C''est la bible du jeu qui documente toutes les règles, les personnages et les mécaniques pour toute l''équipe de production.', 1),
(37, 'Faux', 'Ce document centralise l''ensemble des spécifications pour synchroniser l''équipe technique et artistique.', 0),
(38, 'Vrai', 'Calculer les probabilités (RNG) et la rareté des objets est au cœur du Game Design, particulièrement dans les RPG.', 1),
(38, 'Faux', 'L''orchestration et l''équilibrage mathématique des récompenses font partie intégrante de ses tâches.', 0),
(39, 'Vrai', 'Évaluer une idée via un prototype papier ou sommaire évite de dépenser inutilement des ressources.', 0),
(39, 'Faux', 'C''est une étape cruciale pour tester si une mécanique est amusante avant d''y investir des mois de développement.', 1),
(40, 'Vrai', 'La conception sonore et musicale incombe exclusivement aux Sound Designers et compositeurs.', 0),
(40, 'Faux', 'La création audio est confiée au Sound Designer ou au compositeur.', 1);

-- -------------------------------------------------------------------------
-- MÉTIER 5 : DÉVELOPPEUR WEB
-- -------------------------------------------------------------------------
INSERT INTO `quiz_job_question` (`question_text`, `job_id`, `level`) VALUES
('Le développeur "Front-End" code tout ce qui est visible et interactif pour l''utilisateur.', 5, 'easy'),
('Les langages HTML et CSS sont considérés comme des langages Back-End.', 5, 'easy'),
('Le développeur "Back-End" s''occupe des serveurs, de la sécurité et des bases de données.', 5, 'easy'),
('Un développeur "Full-Stack" est capable d''intervenir à la fois sur le Front-End et le Back-End.', 5, 'medium'),
('Le rôle du développeur s''arrête dès que la première ligne de code est écrite.', 5, 'easy'),
('L''utilisation d''outils de versioning (comme Git/GitHub) est essentielle dans ce métier.', 5, 'medium'),
('Il est chargé de définir la ligne éditoriale et de rédiger les articles du site.', 5, 'easy'),
('L''optimisation du temps de chargement des pages fait partie de ses responsabilités.', 5, 'medium'),
('Un bon développeur n''utilise jamais de "Frameworks" (bibliothèques de code préexistantes).', 5, 'hard'),
('L''intégration en "Responsive Design" (adaptation aux écrans mobiles) est devenue optionnelle.', 5, 'easy');

INSERT INTO `quiz_job_answer` (`question_id`, `answer_text`, `explanation`, `is_correct`) VALUES
(41, 'Vrai', 'Il gère l''interface, le design d''interaction et l''intégration visuelle.', 1),
(41, 'Faux', 'Le Front-End traite l''ensemble de la logique s''exécutant côté client (navigateur).', 0),
(42, 'Vrai', 'Ce sont des outils d''intégration d''interfaces interprétés directement par le navigateur (Front).', 0),
(42, 'Faux', 'Ce sont les piliers du Front-End (structure et style de la page).', 1),
(43, 'Vrai', 'Il gère toute la machinerie invisible qui permet au site de fonctionner et de traiter les informations.', 1),
(43, 'Faux', 'Le traitement des données en base et la configuration serveur constituent son cœur de métier.', 0),
(44, 'Vrai', 'C''est un profil polyvalent qui maîtrise l''ensemble de la chaîne de développement.', 1),
(44, 'Faux', 'Sa polyvalence lui permet d''assurer l''architecture globale d''une application.', 0),
(45, 'Vrai', 'Le débogage, les audits de sécurité et la maintenance corrective occupent une place majeure.', 0),
(45, 'Faux', 'Les phases de test (débogage) et de maintenance technique représentent une grande partie de son travail.', 1),
(46, 'Vrai', 'Cela permet de sauvegarder l''historique du code et de travailler à plusieurs développeurs sur un même projet sans conflits.', 1),
(46, 'Faux', 'Le contrôle de version est incontournable pour collaborer efficacement en équipe sans écraser le travail d''autrui.', 0),
(47, 'Vrai', 'La création et l''animation des contenus relèvent des équipes éditoriales ou marketing.', 0),
(47, 'Faux', 'La création de contenu éditorial est gérée par les équipes marketing, les rédacteurs ou les CM.', 1),
(48, 'Vrai', 'Il doit écrire un code propre et minifier les ressources pour garantir des performances optimales.', 1),
(48, 'Faux', 'Minifier le code et optimiser les requêtes serveur sont indispensables à la fluidité du site.', 0),
(49, 'Vrai', 'S''appuyer sur des architectures éprouvées accélère la production et renforce la sécurité des applications.', 0),
(49, 'Faux', 'L''utilisation de Frameworks (comme React, Angular ou Laravel) est la norme pour gagner en temps et en sécurité.', 1),
(50, 'Vrai', 'L''adaptation mobile est un impératif majeur face aux exigences d''indexation et de trafic actuelles.', 0),
(50, 'Faux', 'C''est une obligation technique absolue puisque la majorité du trafic web mondial se fait sur smartphone.', 1);

-- -------------------------------------------------------------------------
-- MÉTIER 6 : COMMUNITY MANAGER
-- -------------------------------------------------------------------------
INSERT INTO `quiz_job_question` (`question_text`, `job_id`, `level`) VALUES
('L''unique but du Community Manager est d''obtenir un maximum de "likes".', 6, 'easy'),
('Il doit maîtriser l''art du "Copywriting" pour rédiger ses publications.', 6, 'medium'),
('La modération des commentaires (positifs et négatifs) fait partie de son quotidien.', 6, 'easy'),
('Le CM gère le budget d''achat d''espaces publicitaires télévisés.', 6, 'easy'),
('Le "Newsjacking" (rebondir sur un fait d''actualité) est une technique qu''il utilise régulièrement.', 6, 'medium'),
('Un bon Community Manager ne programme jamais ses posts à l''avance.', 6, 'easy'),
('Analyser les statistiques de performance (reach, partages) est essentiel pour ajuster sa stratégie.', 6, 'medium'),
('Le CM est responsable du développement technique du site web de l''entreprise.', 6, 'easy'),
('La veille stratégique et concurrentielle occupe une place importante dans son travail.', 6, 'medium'),
('Il est déconseillé pour un CM d''utiliser la vidéo courte, car c''est un format trop complexe.', 6, 'easy');

INSERT INTO `quiz_job_answer` (`question_id`, `answer_text`, `explanation`, `is_correct`) VALUES
(51, 'Vrai', 'L''engagement global, l''acquisition de prospects et l''image de marque priment sur la simple métrique de mentions J''aime.', 0),
(51, 'Faux', 'Son rôle est de fédérer une communauté, de générer du trafic qualifié, d''engager la conversation et d''améliorer la notoriété.', 1),
(52, 'Vrai', 'L''accroche textuelle est fondamentale pour capter l''attention de l''audience.', 1),
(52, 'Faux', 'Savoir structurer une publication pour la rendre percutante et incitative est une compétence clé du poste.', 0),
(53, 'Vrai', 'Il gère la relation client sur les réseaux sociaux et protège l''e-réputation de la marque.', 1),
(53, 'Faux', 'Protéger l''image de l''entreprise et désamorcer les tensions en commentaires est indispensable.', 0),
(54, 'Vrai', 'Les campagnes publicitaires TV dépendent de budgets et de pôles de diffusion médias d''envergure différente.', 0),
(54, 'Faux', 'Il se concentre sur les médias sociaux. Les médias traditionnels relèvent des acheteurs médias classiques.', 1),
(55, 'Vrai', 'C''est une excellente stratégie pour générer de la viralité de manière organique.', 1),
(55, 'Faux', 'S''approprier avec humour ou pertinence un sujet tendance booste l''exposition de sa marque.', 0),
(56, 'Vrai', 'Planifier permet d''assurer une présence régulière et structurée via des calendriers éditoriaux.', 0),
(56, 'Faux', 'Il utilise des outils de programmation et s''appuie sur un calendrier éditorial pour anticiper ses actions.', 1),
(57, 'Vrai', 'La donnée permet de comprendre ce qui fonctionne et d''optimiser les futurs contenus (logique de Test & Learn).', 1),
(57, 'Faux', 'Sans mesure fine des retours statistiques, l''optimisation de la stratégie social media reste impossible.', 0),
(58, 'Vrai', 'L''écriture informatique et la structure applicative du site incombent aux ingénieurs ou développeurs web.', 0),
(58, 'Faux', 'C''est le rôle de l''équipe de développement web.', 1),
(59, 'Vrai', 'Il doit constamment surveiller les tendances (trends), les nouveaux formats et les actions de ses concurrents.', 1),
(59, 'Faux', 'Une veille constante permet d''adopter les nouveaux formats algorithmiques avant ses concurrents.', 0),
(60, 'Vrai', 'Les algorithmes actuels privilégient massivement les formats vidéos verticaux et courts pour accroître la portée.', 0),
(60, 'Faux', 'Les formats vidéos courts (Reels, Shorts, TikTok) sont aujourd''hui indispensables dans une stratégie Social Media.', 1);

-- -------------------------------------------------------------------------
-- MÉTIER 7 : VIDÉASTE
-- -------------------------------------------------------------------------
INSERT INTO `quiz_job_question` (`question_text`, `job_id`, `level`) VALUES
('Sur le web, le vidéaste est souvent un profil polyvalent (cadreur, monteur, réalisateur).', 7, 'easy'),
('Acheter la caméra la plus chère du marché garantit automatiquement une bonne vidéo.', 7, 'easy'),
('L''étape du "dérushage" consiste à trier et sélectionner les meilleures prises avant le montage.', 7, 'easy'),
('L''étalonnage est l''action de rajouter de la musique sur une vidéo.', 7, 'medium'),
('En vidéo, si l''image est parfaite, le spectateur pardonnera facilement une mauvaise qualité sonore.', 7, 'easy'),
('Le "storyboard" est un outil visuel servant à planifier les plans avant le tournage.', 7, 'medium'),
('Les formats verticaux (9:16) n''ont aucun intérêt pour un vidéaste professionnel.', 7, 'easy'),
('Le "B-roll" désigne les plans de coupe d''illustration utilisés pour dynamiser un montage.', 7, 'hard'),
('Un vidéaste n''a jamais besoin de compétences relationnelles, il travaille seul derrière son écran.', 7, 'medium'),
('Le vidéaste peut utiliser n''importe quelle musique connue en fond de ses vidéos commerciales sans demander d''autorisation.', 7, 'easy');

INSERT INTO `quiz_job_answer` (`question_id`, `answer_text`, `explanation`, `is_correct`) VALUES
(61, 'Vrai', 'Les agences digitales et les marques recherchent souvent des profils "couteau suisse" capables de gérer un projet vidéo de A à Z.', 1),
(61, 'Faux', 'Le format de production web exige fréquemment une autonomie complète sur l''ensemble du flux créatif.', 0),
(62, 'Vrai', 'Une gestion approximative du cadre, du son et de l''éclairage gâchera le rendu d''un matériel coûteux.', 0),
(62, 'Faux', 'La maîtrise de la lumière (l''éclairage), du son et du cadrage est bien plus importante que le boîtier utilisé.', 1),
(63, 'Vrai', 'C''est une étape préparatoire indispensable pour organiser le montage fluide de la vidéo.', 1),
(63, 'Faux', 'Organiser ses fichiers d''illustration et isoler les bonnes prises structure efficacement la phase de découpe.', 0),
(64, 'Vrai', 'La pose de la piste musicale et le traitement acoustique correspondent à l''univers du mixage sonore.', 0),
(64, 'Faux', 'L''étalonnage consiste à équilibrer et donner un style artistique aux couleurs de l''image (colorimétrie).', 1),
(65, 'Vrai', 'Un son inaudible ou saturé détériore instantanément l''attention et déclenche l''abandon du visionnage.', 0),
(65, 'Faux', 'Un son saturé ou inaudible fera fuir l''audience beaucoup plus vite qu''une image de basse qualité.', 1),
(66, 'Vrai', 'Il ressemble à une bande dessinée et permet de gagner un temps précieux sur le plateau de tournage.', 1),
(66, 'Faux', 'Ce découpage dessiné permet de matérialiser les axes de caméra requis avant de tourner.', 0),
(67, 'Vrai', 'La captation et l''adaptation au format vertical constituent des leviers d''audience mobiles indispensables.', 0),
(67, 'Faux', 'Avec l''explosion de TikTok et des Reels Instagram, savoir tourner et monter à la verticale est devenu une compétence très demandée.', 1),
(68, 'Vrai', 'Ces plans secondaires viennent illustrer le discours principal (le "A-roll") et couvrir les coupes au montage.', 1),
(68, 'Faux', 'Ces visuels contextuels permettent de rythmer le montage et d''éviter la monotonie d''un plan fixe.', 0),
(69, 'Vrai', 'Savoir diriger les intervenants et installer un climat de confiance sur le plateau est impératif.', 0),
(69, 'Faux', 'Il doit savoir diriger des intervenants, mettre à l''aise des personnes qui n''ont pas l''habitude de la caméra, et collaborer avec les équipes.', 1),
(70, 'Vrai', 'L''exploitation de morceaux commerciaux requiert obligatoirement l''acquisition de droits ou des accords de licence synchro.', 0),
(70, 'Faux', 'Le respect des droits d''auteur est strict. Il doit utiliser des banques de musiques libres de droits ou payer des licences.', 1);

-- -------------------------------------------------------------------------
-- MÉTIER 8 : GRAPHISTE
-- -------------------------------------------------------------------------
INSERT INTO `quiz_job_question` (`question_text`, `job_id`, `level`) VALUES
('Un graphiste doit impérativement respecter la charte graphique de la marque pour laquelle il travaille.', 8, 'easy'),
('La typographie (le choix des polices de caractères) a très peu d''impact sur le message d''un visuel.', 8, 'easy'),
('Le mode colorimétrique RVB (Rouge, Vert, Bleu) est utilisé pour les créations destinées à l''impression papier.', 8, 'medium'),
('L''objectif principal d''un graphiste marketing est de faire du design "purement artistique".', 8, 'medium'),
('Une image vectorielle permet d''être agrandie à l''infini sans jamais perdre en qualité.', 8, 'easy'),
('Le graphiste travaille souvent de manière isolée, sans tenir compte du texte.', 8, 'easy'),
('Les logiciels de la suite Adobe (Photoshop, Illustrator, InDesign) sont ses outils de référence.', 8, 'easy'),
('Le "Mockup" permet de présenter une création graphique mise en situation réaliste.', 8, 'medium'),
('Un graphiste passe la majority de son temps à imprimer des affiches.', 8, 'easy'),
('La psychologie des couleurs est un concept que le graphiste intègre dans ses créations.', 8, 'medium');

INSERT INTO `quiz_job_answer` (`question_id`, `answer_text`, `explanation`, `is_correct`) VALUES
(71, 'Vrai', 'Il doit garantir la cohérence visuelle (couleurs, polices, logo) pour que la marque reste identifiable.', 1),
(71, 'Faux', 'S''affranchir de la charte brise la reconnaissance visuelle de l''entreprise auprès du public.', 0),
(72, 'Vrai', 'Le choix typographique oriente la lisibilité et exprime graphiquement la tonalité éditoriale du message.', 0),
(72, 'Faux', 'La typographie est au cœur du design. Elle transmet une émotion, hiérarchise l''information et définit l''identité visuelle.', 1),
(73, 'Vrai', 'Le profil RVB caractérise les affichages sur écran, l''impression physique exige le traitement en CMJN.', 0),
(73, 'Faux', 'Le RVB est conçu pour les écrans (web). L''impression utilise le mode CMJN (Cyan, Magenta, Jaune, Noir).', 1),
(74, 'Vrai', 'L''efficacité, la hiérarchisation de l''information et l''utilité commerciale prévalent sur l''expression artistique pure.', 0),
(74, 'Faux', 'Son travail doit servir un objectif clair (vendre, informer, attirer l''attention). L''utilité et la lisibilité priment sur l''art pur.', 1),
(75, 'Vrai', 'Contrairement aux images matricielles (pixels), le vectoriel est calculé mathématiquement (idéal pour les logos).', 1),
(75, 'Faux', 'Le calcul vectoriel préserve la netteté absolue des tracés, quelle que soit la taille de sortie.', 0),
(76, 'Vrai', 'Il collabore étroitement avec les concepteurs-rédacteurs pour aligner la force du texte au design.', 0),
(76, 'Faux', 'Il travaille en synergie étroite avec les rédacteurs, les UX Designers et les Community Managers pour intégrer le message au visuel.', 1),
(77, 'Vrai', 'Ils sont le standard de l''industrie pour la retouche photo, l''illustration vectorielle et la mise en page.', 1),
(77, 'Faux', 'Ces outils constituent l''environnement logiciel de référence adopté par la majorité des studios.', 0),
(78, 'Vrai', 'Cela permet au client de visualiser à quoi ressemblera le logo sur un tee-shirt, un ordinateur ou une carte de visite.', 1),
(78, 'Faux', 'Mettre en scène le design sur un support physique virtuel permet de valider le produit avant impression.', 0),
(79, 'Vrai', 'Le design interactif, les maquettes web et les supports pour les réseaux sociaux représentent aujourd''hui l''essentiel de la demande.', 0),
(79, 'Faux', 'Aujourd''hui, une grande majorité des besoins graphiques concerne le digital (réseaux sociaux, bannières web, interfaces).', 1),
(80, 'Vrai', 'Les couleurs véhiculent des messages inconscients (le bleu pour la confiance, le vert pour la nature) qu''il utilise stratégiquement.', 1),
(80, 'Faux', 'Chaque nuance chromatique possède une symbolique culturelle et psychologique qu''il exploite à des fins d''impact.', 0);




SET FOREIGN_KEY_CHECKS=1;