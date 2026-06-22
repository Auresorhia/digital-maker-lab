CREATE TABLE IF NOT EXISTS `assistant_ia_apps` (
    `id`            INT AUTO_INCREMENT PRIMARY KEY,
    `job_id`        INT NOT NULL,
    `app_name`      VARCHAR(255) NOT NULL,
    `tags`          VARCHAR(500) NOT NULL,
    `description`   TEXT NOT NULL,
    `source`        VARCHAR(500) NULL,
    `display_order` TINYINT UNSIGNED NOT NULL DEFAULT 1,
    `created_at`    TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT `fk_assistant_job`
        FOREIGN KEY (`job_id`) REFERENCES `job` (`id_job`)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `assistant_ia_apps` (`job_id`, `app_name`, `tags`, `description`, `source`, `display_order`) VALUES
(1, 'Notion', 'Organisation, Documentation, Roadmap',
 'Notion est l\'outil tout-en-un adopté par de nombreux entrepreneurs pour structurer leur projet. Il permet de rédiger son business plan, de créer sa roadmap produit, de gérer ses tâches et de centraliser toute la documentation de son entreprise en un seul espace. Sa flexibilité et sa collaboration en temps réel en font l\'outil idéal pour coordonner une petite équipe en démarrage.',
 'notion.so', 1),
(1, 'LinkedIn', 'Réseau professionnel, Prospection, Personal Branding',
 'LinkedIn est le réseau social professionnel incontournable pour tout créateur d\'entreprise. Il permet de construire sa notoriété via le personal branding, de trouver des associés, des clients ou des investisseurs, et de rester informé des tendances de son secteur. Partager ses avancées et ses apprentissages sur LinkedIn peut ouvrir des portes et accélérer la croissance d\'un projet entrepreneurial.',
 'linkedin.com', 2),
(1, 'Canva', 'Pitch Deck, Communication, Design No-code',
 'Canva est un outil de design No-Code qui permet à l\'entrepreneur de créer des présentations (pitch deck), des supports marketing et des visuels professionnels sans recourir à un graphiste. Grâce à ses templates adaptés aux présentations d\'entreprise, il est possible de concevoir un pitch convaincant pour des investisseurs ou des concours de startups rapidement et à moindre coût.',
 'canva.com', 3);

INSERT INTO `assistant_ia_apps` (`job_id`, `app_name`, `tags`, `description`, `source`, `display_order`) VALUES
(2, 'HubSpot', 'CRM, Email Marketing, Automation',
 'HubSpot est l\'un des CRM les plus complets et accessibles du marché. Il centralise toutes les interactions clients (emails, appels, formulaires), permet de créer des campagnes d\'email marketing ciblées et d\'automatiser des séquences de communication. Sa version gratuite très fournie en fait un choix populaire pour les PME qui débutent leur stratégie CRM.',
 'hubspot.com', 1),
(2, 'Brevo', 'Emailing, SMS, Automation',
 'Brevo (anciennement Sendinblue) est une plateforme française de marketing automation spécialisée dans l\'email et le SMS marketing. Elle permet de créer des campagnes segmentées, d\'automatiser des scénarios (email de bienvenue, relance de panier abandonné) et d\'analyser les taux d\'ouverture et de clics. Très utilisée en France, elle se distingue par son rapport qualité-prix et sa conformité RGPD.',
 'brevo.com', 2),
(2, 'Salesforce', 'CRM Enterprise, Pipeline, Reporting',
 'Salesforce est le leader mondial des CRM d\'entreprise. Il centralise l\'ensemble des données clients, gère les pipelines de vente, automatise les processus métier et génère des rapports analytiques avancés. Sa puissance et sa personnalisation extrêmes en font l\'outil de référence dans les grandes organisations. Maîtriser Salesforce est un atout majeur sur le marché du travail CRM.',
 'salesforce.com', 3);

INSERT INTO `assistant_ia_apps` (`job_id`, `app_name`, `tags`, `description`, `source`, `display_order`) VALUES
(3, 'SEMrush', 'Mots-clés, Audit SEO, Analyse concurrence',
 'SEMrush est l\'une des suites SEO les plus complètes du marché. Elle permet d\'analyser les mots-clés sur lesquels se positionnent ses concurrents, d\'auditer techniquement un site, de suivre ses positions dans les résultats Google et d\'identifier des opportunités de contenu. C\'est l\'outil de référence pour construire une stratégie de référencement naturel basée sur la data.',
 'semrush.com', 1),
(3, 'Google Search Console', 'Indexation, Performance, Google',
 'La Google Search Console est l\'outil officiel de Google pour surveiller la présence d\'un site dans ses résultats de recherche. Elle indique quelles pages sont indexées, quels mots-clés génèrent des impressions et des clics, et alerte sur les erreurs techniques (pages non indexées, problèmes de Core Web Vitals). Gratuite et directement connectée à Google, c\'est la première ressource à consulter pour tout consultant SEO.',
 'search.google.com/search-console', 2),
(3, 'Screaming Frog', 'Audit technique, Crawl, SEO On-page',
 'Screaming Frog est un crawler SEO qui explore un site web comme le ferait le robot de Google. Il identifie les erreurs techniques : liens cassés, balises Title dupliquées, pages en 404, redirections en boucle, temps de chargement excessifs... Son rapport exhaustif est le point de départ de tout audit SEO technique sérieux.',
 'screamingfrog.co.uk', 3);

INSERT INTO `assistant_ia_apps` (`job_id`, `app_name`, `tags`, `description`, `source`, `display_order`) VALUES
(4, 'Unity', 'Moteur de jeu, Prototype, 3D',
 'Unity est le moteur de jeu le plus utilisé dans le monde indépendant et mobile. Il permet de prototyper rapidement des mécaniques de jeu, de tester des idées en 2D ou 3D, et de déployer sur toutes les plateformes (PC, console, mobile). Pour un Game Designer, Unity est l\'outil idéal pour créer des prototypes jouables sans être un développeur expert, grâce à son interface visuelle et ses ressources communautaires.',
 'unity.com', 1),
(4, 'Notion', 'GDD, Documentation, Collaboration',
 'Notion est devenu l\'outil de prédilection des équipes de jeu pour rédiger et centraliser le Game Design Document (GDD). Il permet de structurer les règles du jeu, les profils de personnages, les mécaniques, les niveaux et tous les documents de référence en un seul endroit accessible à toute l\'équipe. Sa flexibilité (pages, bases de données, tableaux Kanban) en fait un compagnon idéal pour organiser la complexité d\'un projet de jeu.',
 'notion.so', 2),
(4, 'Miro', 'Brainstorming, Prototypage, Collaboration',
 'Miro est un tableau blanc collaboratif en ligne qui permet aux Game Designers de visualiser leurs idées, créer des mind maps, dessiner des flowcharts de gameplay et prototyper des structures de niveaux. Il facilite les sessions de brainstorming à distance avec l\'équipe et permet de transformer des idées abstraites en représentations visuelles partagées avant de coder quoi que ce soit.',
 'miro.com', 3);

INSERT INTO `assistant_ia_apps` (`job_id`, `app_name`, `tags`, `description`, `source`, `display_order`) VALUES
(5, 'VS Code', 'IDE, Éditeur de code, Extensions',
 'VS Code est l\'éditeur de code le plus utilisé au monde par les développeurs web. Gratuit et open source, il offre une autocomplétion intelligente, un débogueur intégré et un écosystème d\'extensions qui s\'adapte à tous les langages (HTML, CSS, JavaScript, PHP...). Son terminal intégré et son intégration Git en font le centre de commandement du développeur.',
 'code.visualstudio.com', 1),
(5, 'GitHub', 'Versioning, Collaboration, CI/CD',
 'GitHub est la plateforme de référence pour héberger, partager et collaborer sur du code. Basé sur Git, il permet de versionner son code, de travailler en équipe via les branches et pull requests, et de déployer des projets. Avec ses fonctionnalités de CI/CD (GitHub Actions), il est devenu indispensable dans tout workflow de développement professionnel.',
 'github.com', 2),
(5, 'Chrome DevTools', 'Debug, Performance, Front-End',
 'Les outils de développement intégrés à Chrome permettent d\'inspecter le DOM, de déboguer le JavaScript, d\'analyser les performances de chargement et d\'auditer l\'accessibilité d\'un site. Accessibles via F12, ils sont le couteau suisse du développeur front-end pour tester, mesurer et corriger en temps réel sans quitter le navigateur.',
 'developer.chrome.com', 3);

INSERT INTO `assistant_ia_apps` (`job_id`, `app_name`, `tags`, `description`, `source`, `display_order`) VALUES
(6, 'Canva', 'Création visuelle, Templates, Réseaux sociaux',
 'Canva est un outil de design No-Code qui permet au Community Manager de créer des visuels professionnels pour les réseaux sociaux sans compétences en graphisme. Grâce à ses milliers de templates prêts à l\'emploi, il est possible de produire des posts, stories, bannières et infographies en quelques minutes tout en respectant la charte graphique de la marque.',
 'canva.com', 1),
(6, 'Hootsuite', 'Planification, Programmation, Analyse',
 'Hootsuite est une plateforme de gestion des réseaux sociaux qui centralise tous les comptes (Instagram, Facebook, LinkedIn, X...) en un seul tableau de bord. Elle permet de programmer les publications à l\'avance, de surveiller les mentions de la marque, de répondre aux messages et d\'analyser les performances des contenus. Indispensable pour gérer plusieurs communautés simultanément.',
 'hootsuite.com', 2),
(6, 'Meta Business Suite', 'Facebook, Instagram, Publicité',
 'Meta Business Suite est l\'interface officielle de Meta pour gérer les comptes Facebook et Instagram d\'une entreprise. Elle permet de créer et programmer des publications, de gérer les messages et commentaires, et de consulter des statistiques détaillées sur les audiences. Pour tout Community Manager actif sur les réseaux Meta, c\'est l\'outil de pilotage central du quotidien.',
 'business.facebook.com', 3);

INSERT INTO `assistant_ia_apps` (`job_id`, `app_name`, `tags`, `description`, `source`, `display_order`) VALUES
(7, 'Adobe Premiere Pro', 'Montage, Timeline, Exportation',
 'Adobe Premiere Pro est le logiciel de montage vidéo professionnel le plus répandu dans l\'industrie. Sa timeline multipiste permet d\'assembler images, sons et effets avec précision. Il s\'intègre nativement avec After Effects et Audition pour un flux de production complet. Maîtriser Premiere Pro est souvent une exigence de base pour tout poste de vidéaste en agence ou en entreprise.',
 'adobe.com/premiere', 1),
(7, 'DaVinci Resolve', 'Étalonnage, Color Grading, Montage',
 'DaVinci Resolve est la référence mondiale pour l\'étalonnage colorimétrique (color grading). Utilisé pour les films, séries et publicités, il permet de donner une identité visuelle cohérente à une vidéo en travaillant les couleurs avec une précision professionnelle. Sa version gratuite très complète, incluant un module de montage, en fait un incontournable pour tout vidéaste soucieux de la qualité d\'image.',
 'blackmagicdesign.com/davinci', 2),
(7, 'After Effects', 'Motion Design, VFX, Animation',
 'After Effects est le logiciel de référence pour le motion design et les effets visuels. Il permet de créer des animations graphiques, des génériques, des transitions dynamiques et des effets spéciaux qui habillent les vidéos. Travaillant en synergie avec Premiere Pro, il est l\'outil qu\'utilisent les vidéastes pour donner vie à des visuels impossibles à tourner en conditions réelles.',
 'adobe.com/after-effects', 3);

INSERT INTO `assistant_ia_apps` (`job_id`, `app_name`, `tags`, `description`, `source`, `display_order`) VALUES
(8, 'Adobe Photoshop', 'Retouche photo, Composition, Bitmap',
 'Photoshop est le logiciel de référence pour la retouche d\'images et la création visuelle. Il permet de manipuler des photos, créer des compositions multicouches, concevoir des visuels marketing et préparer des fichiers pour le web ou l\'impression. Incontournable en studio, sa maîtrise est souvent exigée dans les offres d\'emploi en graphisme.',
 'adobe.com/photoshop', 1),
(8, 'Figma', 'UI Design, Collaboration, Prototype',
 'Figma a révolutionné le design d\'interface en proposant un outil entièrement dans le navigateur, collaboratif en temps réel. Il permet de créer des maquettes UI, des prototypes interactifs et des design systems partagés avec toute l\'équipe. Sa capacité à regrouper designers, développeurs et clients sur un même fichier en fait l\'outil de collaboration design le plus adopté du marché.',
 'figma.com', 2),
(8, 'Adobe Illustrator', 'Vectoriel, Illustration, Logo',
 'Illustrator est la référence pour la création graphique vectorielle. Logos, icônes, illustrations, chartes graphiques : tout ce qui doit rester net quelle que soit la taille est conçu dans Illustrator. Contrairement à Photoshop (pixels), le vectoriel peut être redimensionné à l\'infini sans perte de qualité, ce qui le rend indispensable pour l\'identité visuelle.',
 'adobe.com/illustrator', 3);
