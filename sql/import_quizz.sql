-- =========================================================================
-- 1. NETTOYAGE & CRÉATION DES TABLES
-- =========================================================================

DROP TABLE IF EXISTS `quiz_metier_answer`;
DROP TABLE IF EXISTS `quiz_metier_question`;

-- Création de la table des questions
CREATE TABLE `quiz_metier_question` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `text_question` TEXT NOT NULL,
    `metier_id` INT NOT NULL,
    `État` VARCHAR(50) NOT NULL, -- 'easy', 'medium', 'hard'
    CONSTRAINT `fk_questions_metiers` 
        FOREIGN KEY (`metier_id`) REFERENCES `exemple_metiers`(`id`) 
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Création de la table des réponses
CREATE TABLE `quiz_metier_answer` (
    `id_answer` INT AUTO_INCREMENT PRIMARY KEY,
    `text_response` TEXT NOT NULL,
    `id_question` INT NOT NULL,
    `explication_response` TEXT NULL,
    `Texte` VARCHAR(50) NOT NULL, -- 'vrai' ou 'faux'
    CONSTRAINT `fk_answers_questions` 
        FOREIGN KEY (`id_question`) REFERENCES `quiz_metier_question`(`id`) 
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =========================================================================
-- 2. INITIALISATION DES DONNÉES (SEEDING - 80 QUESTIONS VRAI/FAUX)
-- =========================================================================

-- -------------------------------------------------------------------------
-- MÉTIER 1 : CRÉATEUR D'ENTREPRISE (ENTREPRENEUR)
-- -------------------------------------------------------------------------
INSERT INTO `quiz_metier_question` (`id`, `text_question`, `metier_id`, `État`) VALUES
(1, 'Un créateur d''entreprise doit obligatoirement avoir une idée révolutionnaire pour se lancer.', 1, 'easy'),
(2, 'Il est aujourd''hui possible de créer un produit technologique sans savoir coder.', 1, 'medium'),
(3, 'Le statut de micro-entrepreneur permet de réaliser un chiffre d''affaires illimité.', 1, 'easy'),
(4, 'L''étude de marché est une garantie absolue de la réussite du projet.', 1, 'medium'),
(5, 'Le "pitch" est un exercice de présentation réservé uniquement aux investisseurs.', 1, 'easy'),
(6, 'Un entrepreneur passe souvent par une phase de prototypage (MVP) pour tester son idée.', 1, 'hard'),
(7, 'Développer son réseau (networking) est facultatif dans la création d''entreprise.', 1, 'easy'),
(8, 'Un créateur d''entreprise est toujours le seul décisionnaire de sa société.', 1, 'medium'),
(9, 'Un entrepreneur doit obligatoirement déposer un brevet pour chaque idée qu''il a.', 1, 'hard'),
(10, 'L''échec d''une première entreprise interdit légalement d''en créer une nouvelle.', 1, 'easy');

INSERT INTO `quiz_metier_answer` (`id_question`, `text_response`, `explication_response`, `Texte`) VALUES
(1, 'Vrai', 'Beaucoup d''entreprises à succès se contentent d''améliorer un produit ou un service existant.', 'faux'),
(1, 'Faux', 'Beaucoup d''entreprises à succès se contentent d''améliorer un produit ou un service existant sur le marché.', 'vrai'),
(2, 'Vrai', 'Les outils "No-Code" (comme Bubble ou Make) permettent de développer des applications fonctionnelles sans taper de lignes de code.', 'vrai'),
(2, 'Faux', 'Les outils No-Code permettent aujourd''hui de concevoir des plateformes sans maîtriser la programmation.', 'faux'),
(3, 'Vrai', 'Le régime de la micro-entreprise est soumis à des seuils stricts de chiffre d''affaires.', 'faux'),
(3, 'Faux', 'Ce statut est soumis à des plafonds de chiffre d''affaires à ne pas dépasser.', 'vrai'),
(4, 'Vrai', 'L''étude de marché balise le terrain mais n''annule jamais totalement le risque entrepreneurial.', 'faux'),
(4, 'Faux', 'Elle limite grandement les risques, mais le succès dépend aussi de l''exécution, du timing et de la stratégie.', 'vrai'),
(5, 'Vrai', 'Le pitch s''adresse également aux futurs collaborateurs, partenaires et premiers clients.', 'faux'),
(5, 'Faux', 'Il sert tout autant à convaincre de potentiels clients, des associés ou des partenaires commerciaux.', 'vrai'),
(6, 'Vrai', 'Le Minimum Viable Product permet de confronter rapidement l''idée au marché avec un minimum de frais.', 'vrai'),
(6, 'Faux', 'Le développement d''un MVP est indispensable pour récolter les retours des premiers utilisateurs.', 'faux'),
(7, 'Vrai', 'Se priver de réseau ralentit considérablement l''accès aux opportunités et aux soutiens clés.', 'faux'),
(7, 'Faux', 'Le réseau est souvent le premier levier pour trouver des clients, des fournisseurs ou des associés.', 'vrai'),
(8, 'Vrai', 'La présence d''associés ou d''actionnaires implique un partage légal du pouvoir décisionnel.', 'faux'),
(8, 'Faux', 'S''il a des associés ou des investisseurs, les décisions stratégiques sont souvent partagées.', 'vrai'),
(9, 'Vrai', 'Une simple idée abstraite ne peut pas être brevetée, seule une invention technique concrète le peut.', 'faux'),
(9, 'Faux', 'Une idée seule ne se brevète pas (seule une invention technique le peut), et le brevet est coûteux.', 'vrai'),
(10, 'Vrai', 'Sauf interdiction judiciaire explicite, rebondir après un échec est un droit fondamental.', 'faux'),
(10, 'Faux', 'L''échec fait partie de l''apprentissage entrepreneurial (sauf interdiction de gestion prononcée par un juge).', 'vrai');

-- -------------------------------------------------------------------------
-- MÉTIER 2 : RESPONSABLE CRM (CUSTOMER RELATIONSHIP MANAGEMENT)
-- -------------------------------------------------------------------------
INSERT INTO `quiz_metier_question` (`id`, `text_question`, `metier_id`, `État`) VALUES
(11, 'L''objectif principal du responsable CRM est d''acquérir de nouveaux abonnés sur les réseaux sociaux.', 2, 'easy'),
(12, 'Il utilise la data pour personnaliser au maximum ses communications.', 2, 'easy'),
(13, 'Le RGPD (Règlement Général sur la Protection des Données) a un impact direct sur son travail.', 2, 'medium'),
(14, 'L''automatisation (Marketing Automation) est au cœur de son métier.', 2, 'easy'),
(15, 'Le responsable CRM s''intéresse uniquement aux clients qui achètent beaucoup.', 2, 'medium'),
(16, 'Le "taux de désabonnement" est un indicator qu''il ne prend pas en compte.', 2, 'easy'),
(17, 'Un outil CRM (comme Salesforce, HubSpot ou Brevo) est indispensable à sa mission.', 2, 'easy'),
(18, 'Il est fréquent que le CRM gère des campagnes par SMS.', 2, 'medium'),
(19, 'Le responsable CRM gère la création des campagnes publicitaires sur Meta Ads.', 2, 'hard'),
(20, 'Le "Lead Scoring" est une technique qu''il utilise pour évaluer la maturité d''un prospect.', 2, 'hard');

INSERT INTO `quiz_metier_answer` (`id_question`, `text_response`, `explication_response`, `Texte`) VALUES
(11, 'Vrai', 'L''acquisition d''audience externe est plutôt la mission du pôle Growth ou Social Media.', 'faux'),
(11, 'Faux', 'Son rôle principal est la fidélisation des clients existants et l''optimisation de leur valeur sur le long terme.', 'vrai'),
(12, 'Vrai', 'La segmentation de la base de données permet d''envoyer le bon message à la bonne personne.', 'vrai'),
(12, 'Faux', 'L''exploitation fine des profils d''achat permet d''éviter d''envoyer des messages génériques.', 'faux'),
(13, 'Vrai', 'Il doit s''assurer que la collecte et l''utilisation des adresses e-mail respectent le consentement des utilisateurs.', 'vrai'),
(13, 'Faux', 'La gestion des consentements (Opt-in) est l''un des piliers légaux indispensables à son activité.', 'faux'),
(14, 'Vrai', 'Il crée des scénarios automatisés (comme les e-mails de bienvenue ou de relance de panier abandonné).', 'vrai'),
(14, 'Faux', 'Sans l''automatisation, il serait impossible de gérer des parcours personnalisés à grande échelle.', 'faux'),
(15, 'Vrai', 'Les clients inactifs ou à faible valeur représentent un gisement de croissance qu''il doit réactiver.', 'faux'),
(15, 'Faux', 'Il crée des stratégies pour réactiver les clients "dormants" et fidéliser les nouveaux acheteurs.', 'vrai'),
(16, 'Vrai', 'Un taux de désabonnement élevé traduit une pression trop forte ou un contenu inadapté qu''il doit corriger.', 'faux'),
(16, 'Faux', 'C''est un KPI majeur. Un taux élevé indique que la pression marketing est trop forte ou le contenu non pertinent.', 'vrai'),
(17, 'Vrai', 'C''est le logiciel qui lui permet de centraliser la donnée client et de programmer ses campagnes.', 'vrai'),
(17, 'Faux', 'Centraliser l''historique et l''ensemble des interactions clients exige un progiciel dédié.', 'faux'),
(18, 'Vrai', 'Le CRM ne se limite pas à l''e-mail, il inclut tous les canaux de relation directe (SMS, notifications push).', 'vrai'),
(18, 'Faux', 'Le SMS marketing affiche des taux d''ouverture massifs très exploités en fidélisation.', 'faux'),
(19, 'Vrai', 'Les publicités payantes sur les réseaux relèvent de la responsabilité du Traffic Manager.', 'faux'),
(19, 'Faux', 'C''est rôle du Traffic Manager ou du Media Buyer.', 'vrai'),
(20, 'Vrai', 'Il attribue des points aux prospects selon leurs actions (clic sur un lien, téléchargement d''un document) pour les cibler efficacement.', 'vrai'),
(20, 'Faux', 'Le calcul d''un score de chaleur permet de transmettre le prospect aux commerciaux au moment opportun.', 'faux');

-- -------------------------------------------------------------------------
-- MÉTIER 3 : CONSULTANT SEO (SEARCH ENGINE OPTIMIZATION)
-- -------------------------------------------------------------------------
INSERT INTO `quiz_metier_question` (`id`, `text_question`, `metier_id`, `État`) VALUES
(21, 'Le SEO permet d''obtenir des résultats immédiats en quelques jours.', 3, 'easy'),
(22, 'L''optimisation technique de la structure d''un site web fait partie de ses missions.', 3, 'medium'),
(23, 'Le consultant SEO achète des mots-clés à Google pour que son site apparaisse en premier.', 3, 'easy'),
(24, 'L''autorité d''un domaine, acquise grâce aux "backlinks" (liens entrants), est un pilier du SEO.', 3, 'medium'),
(25, 'Pour être bien référencé, un texte doit répéter le mot-clé le plus de fois possible.', 3, 'easy'),
(26, 'Il analyse les volumes de recherche mensuels pour définir sa stratégie sémantique.', 3, 'medium'),
(27, 'La balise "Title" est l''un des éléments textuels les plus importants pour les moteurs de recherche.', 3, 'easy'),
(28, 'L''expérience utilisateur (UX) n''a aucune influence sur le référencement naturel.', 3, 'medium'),
(29, 'Le concept du "cocon sémantique" est une technique d''organisation du contenu.', 3, 'hard'),
(30, 'La recherche vocale (via smartphones ou enceintes connectées) ne concerne pas le SEO.', 3, 'hard');

INSERT INTO `quiz_metier_answer` (`id_question`, `text_response`, `explication_response`, `Texte`) VALUES
(21, 'Vrai', 'Le positionnement naturel demande du temps pour que l''indexation de Google se stabilise.', 'faux'),
(21, 'Faux', 'Le référencement naturel est une stratégie de moyen/long terme qui prend souvent plusieurs mois à porter ses fruits.', 'vrai'),
(22, 'Vrai', 'Vitesse de chargement, adaptation mobile et architecture des URL sont des prérequis SEO.', 'vrai'),
(22, 'Faux', 'Un site techniquement défaillant ou trop lent sera déclassé par les moteurs de recherche.', 'faux'),
(23, 'Vrai', 'L''achat d''annonces sponsorisées correspond au référencement payant (SEA).', 'faux'),
(23, 'Faux', 'L''achat de mots-clés relève du SEA (référencement payant). Le SEO concerne les résultats de recherche organiques (gratuits).', 'vrai'),
(24, 'Vrai', 'Plus des sites de confiance pointent vers le vôtre, plus Google considère votre site comme pertinent.', 'vrai'),
(24, 'Faux', 'Le netlinking reste un critère majeur d''évaluation de la popularité d''un nom de domaine.', 'faux'),
(25, 'Vrai', 'Le sur-optimisation sémantique est pénalisée par les algorithmes modernes au profit du confort de lecture.', 'faux'),
(25, 'Faux', 'Le "Keyword Stuffing" (bourrage de mots-clés) lourdement pénalisé par les algorithmes de Google aujourd''hui.', 'vrai'),
(26, 'Vrai', 'Cela lui permet de cibler des mots-clés que les internautes tapent réellement.', 'vrai'),
(26, 'Faux', 'Se positionner sur des expressions dénuées de trafic n''apportera aucune visite au site.', 'faux'),
(27, 'Vrai', 'C''est le titre cliquable bleu dans les résultats Google, essentiel pour la compréhension de la page par l''algorithme.', 'vrai'),
(27, 'Faux', 'Cette balise indique explicitement le sujet traité aux robots d''indexation.', 'faux'),
(28, 'Vrai', 'Un taux de rebond anormal indique à Google que la page répond mal à l''intention de recherche.', 'faux'),
(28, 'Faux', 'Google prend en compte le comportement des utilisateurs (taux de rebond, temps passé sur la page) pour classer les sites.', 'vrai'),
(29, 'Vrai', 'Il s''agit de mailler les pages d''un site entre elles de manière logique autour d''une thématique précise.', 'vrai'),
(29, 'Faux', 'Cette architecture de liens internes renforce la puissance sémantique des pages mères.', 'faux'),
(30, 'Vrai', 'Les utilisateurs s''exprimant de vive voix, les requêtes sémantiques deviennent plus longues et conversationnelles.', 'faux'),
(30, 'Faux', 'Le SEO s''adapte à la recherche vocale en ciblant des requêtes plus longues et formulées sous forme de questions directes.', 'vrai');

-- -------------------------------------------------------------------------
-- MÉTIER 4 : GAME DESIGNER
-- -------------------------------------------------------------------------
INSERT INTO `quiz_metier_question` (`id`, `text_question`, `metier_id`, `État`) VALUES
(31, 'Le Game Designer est la personne qui dessine et modélise les environnements en 3D.', 4, 'easy'),
(32, 'Son travail inclut la gestion de l''équilibrage de la difficulté.', 4, 'medium'),
(33, 'Il doit obligatoirement être un développeur expert et écrire tout le code du jeu.', 4, 'easy'),
(34, 'La psychologie du joueur est un élément central de sa réflexion.', 4, 'easy'),
(35, 'Il s''occupe de la gestion des campagnes publicitaires pour promouvoir le jeu.', 4, 'easy'),
(36, 'Le "Level Design" (la création des parcours dans les Étatx) est une branche de son domaine.', 4, 'medium'),
(37, 'Il rédige souvent un cahier des charges appelé "Game Design Document" (GDD).', 4, 'medium'),
(38, 'La création du système de loot (récompenses) fait partie de ses attributions.', 4, 'hard'),
(39, 'Le prototypage rapide est une perte de temps dans le cycle de production.', 4, 'medium'),
(40, 'Il compose la bande originale et crée les bruitages du jeu.', 4, 'easy');

INSERT INTO `quiz_metier_answer` (`id_question`, `text_response`, `explication_response`, `Texte`) VALUES
(31, 'Vrai', 'La dimension esthétique et visuelle est l''œuvre dédiée du pôle Game Art.', 'faux'),
(31, 'Faux', 'La création visuelle est le rôle des graphistes et modélisateurs. Le Game Designer conçoit les règles et les mécaniques du jeu.', 'vrai'),
(32, 'Vrai', 'Il s''assure que le jeu n''est ni trop frustrant, ni trop facile, pour maintenir l''engagement du joueur.', 'vrai'),
(32, 'Faux', 'Ajuster les statistiques de jeu pour préserver l''intérêt sans lasser est l''une de ses missions.', 'faux'),
(33, 'Vrai', 'La programmation pure de l''arborescence informatique du jeu revient aux développeurs.', 'faux'),
(33, 'Faux', 'Bien que des bases soient utiles, le développement est géré par les programmeurs.', 'vrai'),
(34, 'Vrai', 'Il doit comprendre ce qui motive les joueurs (récompense, exploration, compétition) pour adapter les mécaniques.', 'vrai'),
(34, 'Faux', 'L''analyse des moteurs de satisfaction de l''utilisateur guide l''ensemble des mécaniques de jeu.', 'faux'),
(35, 'Vrai', 'La mise en marché et les budgets promotionnels relèvent du pôle marketing ou de l''éditeur.', 'faux'),
(35, 'Faux', 'C''est le rôle de l''équipe marketing ou de l''éditeur du jeu.', 'vrai'),
(36, 'Vrai', 'Le Level Designer applique les règles du Game Design pour construire l''environnement interactif.', 'vrai'),
(36, 'Faux', 'L''agencement spatial des obstacles et des récompenses découle directement des règles globales.', 'faux'),
(37, 'Vrai', 'C''est la bible du jeu qui documente toutes les règles, les personnages et les mécaniques pour toute l''équipe de production.', 'vrai'),
(37, 'Faux', 'Ce document centralise l''ensemble des spécifications pour synchroniser l''équipe technique et artistique.', 'faux'),
(38, 'Vrai', 'Calculer les probabilités (RNG) et la rareté des objets est au cœur du Game Design, particulièrement dans les RPG.', 'vrai'),
(38, 'Faux', 'L''orchestration et l''équilibrage mathématique des récompenses font partie intégrante de ses tâches.', 'faux'),
(39, 'Vrai', 'Évaluer une idée via un prototype papier ou sommaire évite de dépenser inutilement des ressources.', 'faux'),
(39, 'Faux', 'C''est une étape cruciale pour tester si une mécanique est amusante avant d''y investir des mois de développement.', 'vrai'),
(40, 'Vrai', 'La conception sonore et musicale incombe exclusivement aux Sound Designers et compositeurs.', 'faux'),
(40, 'Faux', 'La création audio est confiée au Sound Designer ou au compositeur.', 'vrai');

-- -------------------------------------------------------------------------
-- MÉTIER 5 : DÉVELOPPEUR WEB
-- -------------------------------------------------------------------------
INSERT INTO `quiz_metier_question` (`id`, `text_question`, `metier_id`, `État`) VALUES
(41, 'Le développeur "Front-End" code tout ce qui est visible et interactif pour l''utilisateur.', 5, 'easy'),
(42, 'Les langages HTML et CSS sont considérés comme des langages Back-End.', 5, 'easy'),
(43, 'Le développeur "Back-End" s''occupe des serveurs, de la sécurité et des bases de données.', 5, 'easy'),
(44, 'Un développeur "Full-Stack" est capable d''intervenir à la fois sur le Front-End et le Back-End.', 5, 'medium'),
(45, 'Le rôle du développeur s''arrête dès que la première ligne de code est écrite.', 5, 'easy'),
(46, 'L''utilisation d''outils de versioning (comme Git/GitHub) est essentielle dans ce métier.', 5, 'medium'),
(47, 'Il est chargé de définir la ligne éditoriale et de rédiger les articles du site.', 5, 'easy'),
(48, 'L''optimisation du temps de chargement des pages fait partie de ses responsabilités.', 5, 'medium'),
(49, 'Un bon développeur n''utilise jamais de "Frameworks" (bibliothèques de code préexistantes).', 5, 'hard'),
(50, 'L''intégration en "Responsive Design" (adaptation aux écrans mobiles) est devenue optionnelle.', 5, 'easy');

INSERT INTO `quiz_metier_answer` (`id_question`, `text_response`, `explication_response`, `Texte`) VALUES
(41, 'Vrai', 'Il gère l''interface, le design d''interaction et l''intégration visuelle.', 'vrai'),
(41, 'Faux', 'Le Front-End traite l''ensemble de la logique s''exécutant côté client (navigateur).', 'faux'),
(42, 'Vrai', 'Ce sont des outils d''intégration d''interfaces interprétés directement par le navigateur (Front).', 'faux'),
(42, 'Faux', 'Ce sont les piliers du Front-End (structure et style de la page).', 'vrai'),
(43, 'Vrai', 'Il gère toute la machinerie invisible qui permet au site de fonctionner et de traiter les informations.', 'vrai'),
(43, 'Faux', 'Le traitement des données en base et la configuration serveur constituent son cœur de métier.', 'faux'),
(44, 'Vrai', 'C''est un profil polyvalent qui maîtrise l''ensemble de la chaîne de développement.', 'vrai'),
(44, 'Faux', 'Sa polyvalence lui permet d''assurer l''architecture globale d''une application.', 'faux'),
(45, 'Vrai', 'Le débogage, les audits de sécurité et la maintenance corrective occupent une place majeure.', 'faux'),
(45, 'Faux', 'Les phases de test (débogage) et de maintenance technique représentent une grande partie de son travail.', 'vrai'),
(46, 'Vrai', 'Cela permet de sauvegarder l''historique du code et de travailler à plusieurs développeurs sur un même projet sans conflits.', 'vrai'),
(46, 'Faux', 'Le contrôle de version est incontournable pour collaborer efficacement en équipe sans écraser le travail d''autrui.', 'faux'),
(47, 'Vrai', 'La création et l''animation des contenus relvèrent des équipes éditoriales ou marketing.', 'faux'),
(47, 'Faux', 'La création de contenu éditorial est gérée par les équipes marketing, les rédacteurs ou les CM.', 'vrai'),
(48, 'Vrai', 'Il doit écrire un code propre et minifier les ressources pour garantir des performances optimales.', 'vrai'),
(48, 'Faux', 'Minifier le code et optimiser les requêtes serveur sont indispensables à la fluidité du site.', 'faux'),
(49, 'Vrai', 'S''appuyer sur des architectures éprouvées accélère la production et renforce la sécurité des applications.', 'faux'),
(49, 'Faux', 'L''utilisation de Frameworks (comme React, Angular ou Laravel) est la norme pour gagner en temps et en sécurité.', 'vrai'),
(50, 'Vrai', 'L''adaptation mobile est un impératif majeur face aux exigences d''indexation et de trafic actuelles.', 'faux'),
(50, 'Faux', 'C''est une obligation technique absolue puisque la majorité du trafic web mondial se fait sur smartphone.', 'vrai');

-- -------------------------------------------------------------------------
-- MÉTIER 6 : COMMUNITY MANAGER
-- -------------------------------------------------------------------------
INSERT INTO `quiz_metier_question` (`id`, `text_question`, `metier_id`, `État`) VALUES
(51, 'L''unique but du Community Manager est d''obtenir un maximum de "likes".', 6, 'easy'),
(52, 'Il doit maîtriser l''art du "Copywriting" pour rédiger ses publications.', 6, 'medium'),
(53, 'La modération des commentaires (positifs et négatifs) fait partie de son quotidien.', 6, 'easy'),
(54, 'Le CM gère le budget d''achat d''espaces publicitaires télévisés.', 6, 'easy'),
(55, 'Le "Newsjacking" (rebondir sur un fait d''actualité) est une technique qu''il utilise régulièrement.', 6, 'medium'),
(56, 'Un bon Community Manager ne programme jamais ses posts à l''avance.', 6, 'easy'),
(57, 'Analyser les statistiques de performance (reach, partages) est essentiel pour ajuster sa stratégie.', 6, 'medium'),
(58, 'Le CM est responsable du développement technique du site web de l''entreprise.', 6, 'easy'),
(59, 'La veille stratégique et concurrentielle occupe une place importante dans son travail.', 6, 'medium'),
(60, 'Il est déconseillé pour un CM d''utiliser la vidéo courte, car c''est un format trop complexe.', 6, 'easy');

INSERT INTO `quiz_metier_answer` (`id_question`, `text_response`, `explication_response`, `Texte`) VALUES
(51, 'Vrai', 'L''engagement global, l''acquisition de prospects et l''image de marque priment sur la simple métrique de mentions J''aime.', 'faux'),
(51, 'Faux', 'Son rôle est de fédérer une communauté, de générer du trafic qualifié, d''engager la conversation et d''améliorer la notoriété.', 'vrai'),
(52, 'Vrai', 'L''accroche textuelle est fondamentale pour capter l''attention de l''audience.', 'vrai'),
(52, 'Faux', 'Savoir structurer une publication pour la rendre percutante et incitative est une compétence clé du poste.', 'faux'),
(53, 'Vrai', 'Il gère la relation client sur les réseaux sociaux et protège l''e-réputation de la marque.', 'vrai'),
(53, 'Faux', 'Protéger l''image de l''entreprise et désamorcer les tensions en commentaires est indispensable.', 'faux'),
(54, 'Vrai', 'Les campagnes publicitaires TV dépendent de budgets et de pôles de diffusion médias d''envergure différente.', 'faux'),
(54, 'Faux', 'Il se concentre sur les médias sociaux. Les médias traditionnels relèvent des acheteurs médias classiques.', 'vrai'),
(55, 'Vrai', 'C''est une excellente stratégie pour générer de la viralité de manière organique.', 'vrai'),
(55, 'Faux', 'S''approprier avec humour ou pertinence un sujet tendance booste l''exposition de sa marque.', 'faux'),
(56, 'Vrai', 'Planifier permet d''assurer une présence régulière et structurée via des calendriers éditoriaux.', 'faux'),
(56, 'Faux', 'Il utilise des outils de programmation et s''appuie sur un calendrier éditorial pour anticiper ses actions.', 'vrai'),
(57, 'Vrai', 'La donnée permet de comprendre ce qui fonctionne et d''optimiser les futurs contenus (logique de Test & Learn).', 'vrai'),
(57, 'Faux', 'Sans mesure fine des retours statistiques, l''optimisation de la stratégie social media reste impossible.', 'faux'),
(58, 'Vrai', 'L''écriture informatique et la structure applicative du site incombent aux ingénieurs ou développeurs web.', 'faux'),
(58, 'Faux', 'C''est le rôle de l''équipe de développement web.', 'vrai'),
(59, 'Vrai', 'Il doit constamment surveiller les tendances (trends), les nouveaux formats et les actions de ses concurrents.', 'vrai'),
(59, 'Faux', 'Une veille constante permet d''adopter les nouveaux formats algorithmiques avant ses concurrents.', 'faux'),
(60, 'Vrai', 'Les algorithmes actuels privilégient massivement les formats vidéos verticaux et courts pour accroître la portée.', 'faux'),
(60, 'Faux', 'Les formats vidéos courts (Reels, Shorts, TikTok) sont aujourd''hui indispensables dans une stratégie Social Media.', 'vrai');

-- -------------------------------------------------------------------------
-- MÉTIER 7 : VIDÉASTE
-- -------------------------------------------------------------------------
INSERT INTO `quiz_metier_question` (`id`, `text_question`, `metier_id`, `État`) VALUES
(61, 'Sur le web, le vidéaste est souvent un profil polyvalent (cadreur, monteur, réalisateur).', 7, 'easy'),
(62, 'Acheter la caméra la plus chère du marché garantit automatiquement une bonne vidéo.', 7, 'easy'),
(63, 'L''étape du "dérushage" consiste à trier et sélectionner les meilleures prises avant le montage.', 7, 'easy'),
(64, 'L''étalonnage est l''action de rajouter de la musique sur une vidéo.', 7, 'medium'),
(65, 'En vidéo, si l''image est parfaite, le spectateur pardonnera facilement une mauvaise qualité sonore.', 7, 'easy'),
(66, 'Le "storyboard" est un outil visuel servant à planifier les plans avant le tournage.', 7, 'medium'),
(67, 'Les formats verticaux (9:16) n''ont aucun intérêt pour un vidéaste professionnel.', 7, 'easy'),
(68, 'Le "B-roll" désigne les plans de coupe d''illustration utilisés pour dynamiser un montage.', 7, 'hard'),
(69, 'Un vidéaste n''a jamais besoin de compétences relationnelles, il travaille seul derrière son écran.', 7, 'medium'),
(70, 'Le vidéaste peut utiliser n''importe quelle musique connue en fond de ses vidéos commerciales sans demander d''autorisation.', 7, 'easy');

INSERT INTO `quiz_metier_answer` (`id_question`, `text_response`, `explication_response`, `Texte`) VALUES
(61, 'Vrai', 'Les agences digitales et les marques recherchent souvent des profils "couteau suisse" capables de gérer un projet vidéo de A à Z.', 'vrai'),
(61, 'Faux', 'Le format de production web exige fréquemment une autonomie complète sur l''ensemble du flux créatif.', 'faux'),
(62, 'Vrai', 'Une gestion approximative du cadre, du son et de l''éclairage gâchera le rendu d''un matériel coûteux.', 'faux'),
(62, 'Faux', 'La maîtrise de la lumière (l''éclairage), du son et du cadrage est bien plus importante que le boîtier utilisé.', 'vrai'),
(63, 'Vrai', 'C''est une étape préparatoire indispensable pour organiser le montage fluide de la vidéo.', 'vrai'),
(63, 'Faux', 'Organiser ses fichiers d''illustration et isoler les bonnes prises structure efficacement la phase de découpe.', 'faux'),
(64, 'Vrai', 'La pose de la piste musicale et le traitement acoustique correspondent à l''univers du mixage sonore.', 'faux'),
(64, 'Faux', 'L''étalonnage consiste à équilibrer et donner un style artistique aux couleurs de l''image (colorimétrie).', 'vrai'),
(65, 'Vrai', 'Un son inaudible ou saturé détériore instantanément l''attention et déclenche l''abandon du visionnage.', 'faux'),
(65, 'Faux', 'Un son saturé ou inaudible fera fuir l''audience beaucoup plus vite qu''une image de basse qualité.', 'vrai'),
(66, 'Vrai', 'Il ressemble à une bande dessinée et permet de gagner un temps précieux sur le plateau de tournage.', 'vrai'),
(66, 'Faux', 'Ce découpage dessiné permet de matérialiser les axes de caméra requis avant de tourner.', 'faux'),
(67, 'Vrai', 'La captation et l''adaptation au format vertical constituent des leviers d''audience mobiles indispensables.', 'faux'),
(67, 'Faux', 'Avec l''explosion de TikTok et des Reels Instagram, savoir tourner et monter à la verticale est devenu une compétence très demandée.', 'vrai'),
(68, 'Vrai', 'Ces plans secondaires viennent illustrer le discours principal (le "A-roll") et couvrir les coupes au montage.', 'vrai'),
(68, 'Faux', 'Ces visuels contextuels permettent de rythmer le montage et d''éviter la monotonie d''un plan fixe.', 'faux'),
(69, 'Vrai', 'Savoir diriger les intervenants et installer un climat de confiance sur le plateau est impératif.', 'faux'),
(69, 'Faux', 'Il doit savoir diriger des intervenants, mettre à l''aise des personnes qui n''ont pas l''habitude de la caméra, et collaborer avec les équipes.', 'vrai'),
(70, 'Vrai', 'L''exploitation de morceaux commerciaux requiert obligatoirement l''acquisition de droits ou des accords de licence synchro.', 'faux'),
(70, 'Faux', 'Le respect des droits d''auteur est strict. Il doit utiliser des banques de musiques libres de droits ou payer des licences.', 'vrai');

-- -------------------------------------------------------------------------
-- MÉTIER 8 : GRAPHISTE
-- -------------------------------------------------------------------------
INSERT INTO `quiz_metier_question` (`id`, `text_question`, `metier_id`, `État`) VALUES
(71, 'Un graphiste doit impérativement respecter la charte graphique de la marque pour laquelle il travaille.', 8, 'easy'),
(72, 'La typographie (le choix des polices de caractères) a très peu d''impact sur le message d''un visuel.', 8, 'easy'),
(73, 'Le mode colorimétrique RVB (Rouge, Vert, Bleu) est utilisé pour les créations destinées à l''impression papier.', 8, 'medium'),
(74, 'L''objectif principal d''un graphiste marketing est de faire du design "purement artistique".', 8, 'medium'),
(75, 'Une image vectorielle permet d''être agrandie à l''infini sans jamais perdre en qualité.', 8, 'easy'),
(76, 'Le graphiste travaille souvent de manière isolée, sans tenir compte du texte.', 8, 'easy'),
(77, 'Les logiciels de la suite Adobe (Photoshop, Illustrator, InDesign) sont ses outils de référence.', 8, 'easy'),
(78, 'Le "Mockup" permet de présenter une création graphique mise en situation réaliste.', 8, 'medium'),
(79, 'Un graphiste passe la majority de son temps à imprimer des affiches.', 8, 'easy'),
(80, 'La psychologie des couleurs est un concept que le graphiste intègre dans ses créations.', 8, 'medium');

INSERT INTO `quiz_metier_answer` (`id_question`, `text_response`, `explication_response`, `Texte`) VALUES
(71, 'Vrai', 'Il doit garantir la coherence visuelle (couleurs, polices, logo) pour que la marque reste identifiable.', 'vrai'),
(71, 'Faux', 'S''affranchir de la charte brise la reconnaissance visuelle de l''entreprise auprès du public.', 'faux'),
(72, 'Vrai', 'Le choix typographique oriente la lisibilité et exprime graphiquement la tonalité éditoriale du message.', 'faux'),
(72, 'Faux', 'La typographie est au cœur du design. Elle transmet une émotion, hiérarchise l''information et définit l''identité visuelle.', 'vrai'),
(73, 'Vrai', 'Le profil RVB caractérise les affichages sur écran, l''impression physique exige le traitement en CMJN.', 'faux'),
(73, 'Faux', 'Le RVB est conçu pour les écrans (web). L''impression utilise le mode CMJN (Cyan, Magenta, Jaune, Noir).', 'vrai'),
(74, 'Vrai', 'L''efficacité, la hiérarchisation de l''information et l''utilité commerciale prévalent sur l''expression artistique pure.', 'faux'),
(74, 'Faux', 'Son travail doit servir un objectif clair (vendre, informer, attirer l''attention). L''utilité et la lisibilité priment sur l''art pur.', 'vrai'),
(75, 'Vrai', 'Contrairement aux images matricielles (pixels), le vectoriel est calculé mathématiquement (idéal pour les logos).', 'vrai'),
(75, 'Faux', 'Le calcul vectoriel préserve la netteté absolue des tracés, quelle que soit la taille de sortie.', 'faux'),
(76, 'Vrai', 'Il collabore étroitement avec les concepteurs-rédacteurs pour aligner le visuel et le texte.', 'faux'),
(76, 'Faux', 'Le design et le texte sont indissociables pour livrer un message clair et percutant.', 'vrai'),
(77, 'Vrai', 'Ces outils restent le standard de l''industrie professionnelle de l''image et du design numérique.', 'vrai'),
(77, 'Faux', 'Bien que Figma ou Canva gagnent du terrain, la suite Adobe demeure la référence incontournable du métier.', 'faux'),
(78, 'Vrai', 'Il simule l''impression sur un support physique (t-shirt, packaging, affiche) ou l''affichage sur un écran.', 'vrai'),
(78, 'Faux', 'C''est un outil indispensable pour aider le client à se projeter avant la production finale.', 'faux'),
(79, 'Vrai', 'L''impression physique dépend du pôle imprimerie. Le graphiste gère uniquement la conception informatique des fichiers.', 'faux'),
(79, 'Faux', 'C''est un métier purement numérique. Les impressions sont confiées à des imprimeurs professionnels.', 'vrai'),
(80, 'Vrai', 'Chaque nuance évoque des émotions ou des codes culturels précis (ex: le bleu pour la confiance).', 'vrai'),
(80, 'Faux', 'Le choix des teintes répond à des critères psychologiques précis pour influencer la perception de la marque.', 'faux');