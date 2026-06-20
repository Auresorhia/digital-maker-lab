<?php
$page_title       = 'Digital Maker Lab';
$page_css         = 'finder.css';
$extra_css        = '';
$header_class     = 'site-header';
$show_desktop_nav = true;
$nav_links = [
    ['label' => 'Accueil',                'href' => '../home.php/#hero',    'active' => true],
    ['label' => 'À propos',               'href' => '#about',   'active' => false],
    ['label' => 'Les métiers du digital', 'href' => '#jobs',    'active' => false],
    ['label' => 'Actualités',             'href' => '#news',    'active' => false],
];
require_once __DIR__ . '/../partials/header.php';
?>
<link rel="stylesheet" href="assets/css/orientation.css">

<main class="finder-page">
    <button class="finder-sidebar__toggle" type="button" aria-label="Ouvrir les catégories" aria-controls="finder-sidebar" aria-expanded="false">
        <span aria-hidden="true">></span>
    </button>

    <div class="finder-sidebar-overlay" id="finder-sidebar-overlay" aria-hidden="true"></div>

    <aside class="finder-sidebar" id="finder-sidebar" aria-label="Catégories">
        <button class="finder-sidebar__close" type="button" aria-label="Fermer les catégories">
            <span aria-hidden="true">
                X
        </button>
        <a class="finder-sidebar__logo" href="home.php" aria-label="Retour à l'accueil">
            <img src="assets/images/logos/logo_digital_maker_lab_orange.webp" alt="Digital Maker Lab">
        </a>
        <?php require_once __DIR__ . '/searchbar/searchbar.php'; ?>
        <h2 class="finder-sidebar__title">Catégories</h2>
        <ul class="finder-sidebar__list">
            <li><a href="#" data-category="marketing">Marketing</a></li>
            <li><a href="#" data-category="uxpo">UXPO</a></li>
            <li><a href="#" data-category="videos">Vidéos</a></li>
            <li><a href="#" data-category="design">Design</a></li>
            <li><a href="#" data-category="developpement">Développement</a></li>
        </ul>
    </aside>

    <aside class="finder-subsidebar" id="finder-subsidebar" aria-label="Métiers" aria-hidden="true">
        <button class="finder-subsidebar__back" type="button" aria-label="Retour aux catégories">
            <span aria-hidden="true">‹</span>
        </button>
        <button class="finder-subsidebar__heading" type="button" aria-expanded="false">
            <span class="finder-subsidebar__title" id="finder-subsidebar-title">Catégorie</span>
            <span aria-hidden="true">⌄</span>
        </button>
        <ul class="finder-subsidebar__list" id="finder-subsidebar-list">
            <!-- Métiers injectés par JS -->
        </ul>
    </aside>

    <section class="finder-hero" aria-labelledby="finder-hero-title">
        <img class="finder-hero__icon finder-hero__icon--mac" src="assets/images/finder/icon-mac.webp" alt="" aria-hidden="true">
        <img class="finder-hero__icon finder-hero__icon--like" src="assets/images/finder/icon-like.webp" alt="" aria-hidden="true">
        <img class="finder-hero__icon finder-hero__icon--cursor" src="assets/images/finder/icon-cursor.webp" alt="" aria-hidden="true">

        <h1 class="finder-hero__title" id="finder-hero-title">
            <span>Quel métier du digital</span>
            <span>est fait pour toi ?</span>
        </h1>
        <p class="finder-hero__intro">
            Explore les métiers par domaine ou fais notre test pour découvrir ceux qui te correspondent le mieux et trouver la spécialité dans laquelle tu peux vraiment t'épanouir.
        </p>
        <button class="orientation-preview__button finder-orientation-button" type="button">Faire le test&nbsp;!</button>
    </section>

    <article class="finder-job-sheet" id="finder-job-sheet" aria-labelledby="finder-job-sheet-title" aria-hidden="true">
        <header class="finder-job-sheet__hero">
            <h1 class="finder-job-sheet__title" id="finder-job-sheet-title">Le métier de consultant SEO</h1>
        </header>

        <section class="finder-job-sheet__intro">
            <h2 class="finder-job-sheet__section-title">titre H2</h2>
            <p>Consultant SEO, spécialiste SEO, expert SEO, référenceur web… Ce métier peut porter plusieurs noms différents, mais dans la finalité, sa mission reste la même : celle d’augmenter la visibilité et le trafic des sites web.</p>
            <p>Alors, si tu aimes manier les mots, découvrir comment fonctionne le web, analyser des données et comprendre pourquoi certains contenus apparaissent sur les moteurs de recherche et d’autres non…</p>
            <p>Peut-être que le métier de consultant SEO est fait pour toi !</p>
        </section>

        <section class="finder-job-sheet__what">
            <h2 class="finder-job-sheet__section-title">Le métier de consultant SEO, c’est quoi ?</h2>
            <span class="finder-job-sheet__tag">Explainer</span>
        </section>

        <section class="finder-job-sheet__video">
            </br>
            <a href="https://youtu.be/xwTPvcPYaOo?si=Pm-ZLxWgLddEjjY9" target="_blank" rel="noopener noreferrer" aria-label="Youtube">Voir la vidéo explicative</a>
        </section>

        <section class="finder-job-sheet__post-video">
            <p>Quand tu es consultant SEO, tu es un expert du référencement naturel : tu aides les sites à gagner en visibilité sur les moteurs de recherche comme Google.</p>
            <p>Grâce à des mots-clés bien choisis et à une stratégie SEO bien définie, tu permets aux entreprises d'attirer des visiteurs et de les transformer en clients.</p>
        </section>

        <section class="finder-job-sheet__missions">
            <h2 class="finder-job-sheet__section-title">Tes missions en tant que consultant SEO</h2>
            <p class="finder-job-sheet__missions-lead">Ta mission principale consiste à améliorer la position des sites dans les résultats de recherche afin d’attirer davantage de visiteurs. De plus, même si Google reste le moteur de recherche le plus utilisé, tu peux aussi être amené à travailler la visibilité sur Bing, DuckDuckGo ou d'autres moteurs selon les objectifs des entreprises.</p>

            <div class="finder-job-sheet__accordion">
                <button class="finder-job-sheet__accordion-trigger" type="button" aria-expanded="false" aria-controls="mission-1">
                    <span>Optimiser la visibilité des sites</span>
                    <span aria-hidden="true">∧</span>
                </button>
                <div class="finder-job-sheet__accordion-panel" id="mission-1">
                    <p>En tant que consultant SEO, tu dois comprendre ce qui fonctionne déjà et ce qui freine les performances d’un site.</p>
                    <p>Pour cela, tu seras amené à :</p>
                    <ul>
                        <li>Analyser les pages existantes du site</li>
                        <li>Étudier son positionnement sur les moteurs de recherche</li>
                        <li>Identifier les contenus à améliorer</li>
                        <li>Optimiser la structure du site</li>
                    </ul>
                    <p>L'objectif est de proposer une expérience claire et pertinente aux visiteurs tout en aidant les moteurs de recherche à mieux comprendre le contenu du site. En améliorant la visibilité des sites, tu contribues à renforcer leur image et leur crédibilité en ligne.</p>
                </div>

                <button class="finder-job-sheet__accordion-trigger" type="button" aria-expanded="false" aria-controls="mission-2">
                    <span>Définir une stratégie de référencement</span>
                    <span aria-hidden="true">∧</span>
                </button>
                <div class="finder-job-sheet__accordion-panel" id="mission-2">
                    <p>Avec l’analyse du site, tu construis une stratégie SEO adaptée aux objectifs de l’entreprise qui peut inclure :</p>
                    <ul>
                        <li>La recherche de mots-clés pertinents</li>
                        <li>L’optimisation sémantique des contenus</li>
                        <li>L’amélioration de certaines pages</li>
                        <li>La mise en place d’une stratégie de netlinking (liens provenant d’autres sites qui pointent vers ton site)</li>
                        <li>L’optimisation des balises (titres, descriptions, images, etc.)</li>
                    </ul>
                    <p>Chaque projet étant différent, il n’y a pas de méthodologie universelle. C’est à toi de t’adapter aux objectifs et aux contraintes des entreprises afin de cibler les bonnes choses à faire.</p>
                </div>

                <button class="finder-job-sheet__accordion-trigger" type="button" aria-expanded="false" aria-controls="mission-3">
                    <span>Analyser les résultats et s’adapter en continu</span>
                    <span aria-hidden="true">∧</span>
                </button>
                <div class="finder-job-sheet__accordion-panel" id="mission-3">
                    <p>Une fois que la stratégie est mise en place, il te faudra évaluer son efficacité en analysant :</p>
                    <ul>
                        <li>L’évolution du trafic</li>
                        <li>La position des pages sur les moteurs de recherche</li>
                        <li>Les conversions générées</li>
                        <li>Les performances des concurrents</li>
                        <li>Les opportunités d’amélioration</li>
                    </ul>
                    <p>Ces données t'aideront à ajuster ta stratégie SEO en continu car les moteurs de recherche évoluent constamment. En tant que consultant, la capacité d'analyse et d'adaptation est essentielle pour continuer à améliorer les performances d’un site sur le long terme.</p>
                </div>
            </div>
        </section>

        <section class="finder-job-sheet__interview">
            <span class="finder-job-sheet__tag">Interview pro</span>
            </br>
            <a href="https://youtu.be/xwTPvcPYaOo?si=Pm-ZLxWgLddEjjY9" target="_blank" rel="noopener noreferrer" aria-label="Youtube">Voir l'interview pro</a>
        </section>

        <section class="finder-job-sheet__skills">
            <h2 class="finder-job-sheet__section-title">Les compétences indispensables pour être consultant SEO</h2>

            <div class="finder-job-sheet__accordion">
                <button class="finder-job-sheet__accordion-trigger" type="button" aria-expanded="false" aria-controls="skill-1">
                    <span>Les qualités incontournables</span>
                    <span aria-hidden="true">∧</span>
                </button>
                <div class="finder-job-sheet__accordion-panel" id="skill-1">
                    <p>Pour faire ce métier, certaines qualités humaines sont essentielles comme :</p>
                    <ul>
                        <li>La curiosité</li>
                        <li>L’esprit d’analyse</li>
                        <li>La rigueur</li>
                        <li>La capacité d’adaptation</li>
                    </ul>
                    <p>Comme le monde du digital évolue constamment et rapidement, il faut être prêt à apprendre continuellement. D’autant plus qu’une grande partie du métier consiste à comprendre pourquoi une page fonctionne, pourquoi une autre stagne et quelles actions peuvent améliorer les résultats.</p>
                </div>

                <button class="finder-job-sheet__accordion-trigger" type="button" aria-expanded="false" aria-controls="skill-2">
                    <span>Les compétences techniques</span>
                    <span aria-hidden="true">∧</span>
                </button>
                <div class="finder-job-sheet__accordion-panel" id="skill-2">
                    <p>En termes de compétences techniques, une bonne compréhension des algorithmes de recherche est nécessaire car tu devras :</p>
                    <ul>
                        <li>Optimiser des contenus</li>
                        <li>Rechercher des mots-clés pertinents</li>
                        <li>Comprendre le fonctionnement des moteurs de recherche</li>
                        <li>Analyser les performances d'un site web</li>
                    </ul>
                    <p>Aussi, tu devras te familiariser avec les concepts de balisage, d'indexation et d'analyse des résultats de recherche. Mais rassure-toi, même si certains jargons peuvent sembler intimidants au début, tout ça deviendra naturel avec le temps et la pratique.</p>
                </div>

                <button class="finder-job-sheet__accordion-trigger" type="button" aria-expanded="false" aria-controls="skill-3">
                    <span>Les outils que tu vas utiliser</span>
                    <span aria-hidden="true">∧</span>
                </button>
                <div class="finder-job-sheet__accordion-panel" id="skill-3">
                    <p>Tu auras l'occasion d'utiliser divers outils qui faciliteront ton travail, comme par exemple :</p>
                    <ul>
                        <li>Google Analytics pour suivre le trafic des sites</li>
                        <li>Google Search Console pour surveiller les performances</li>
                        <li>SEMrush ou Ahrefs pour analyser la concurrence</li>
                        <li>SE Ranking pour suivre le positionnement</li>
                    </ul>
                    <p>Il existe encore plein d’autres outils que tu pourras utiliser, ils deviendront tes alliés pour optimiser les performances de tes clients.</p>
                </div>
            </div>
        </section>

        <section class="finder-job-sheet__text-block">
            <h2 class="finder-job-sheet__section-title">Où travaille un consultant SEO ?</h2>
            <p>En tant que consultant SEO, tu peux travailler dans différents environnements :</p>
            <ul>
                <li>En agence : tu accompagnes plusieurs clients de secteurs différents</li>
                <li>Au sein d’une entreprise : tu travailles sur la visibilité d’une seule marque ou d’un seul site</li>
                <li>En freelance : tu gères tes propres clients et organises ton activité de manière autonome</li>
            </ul>
            <p>Selon l’environnement, tu peux être amené à collaborer avec des développeurs, des rédacteurs web, des UX designers, des chefs de projet ou encore des responsables marketing.</p>
        </section>

        <section class="finder-job-sheet__text-block">
            <h2 class="finder-job-sheet__section-title">Où se former pour devenir consultant SEO ?</h2>
            <p>Il n'existe pas un seul parcours pour devenir consultant SEO : selon ton profil, ton temps disponible et ton budget, plusieurs options s'offrent à toi.</p>
            <p>Si tu souhaites construire des bases solides dans le digital, tu peux t'orienter vers des formations spécialisées en marketing digital. Certaines écoles proposent des cursus complets qui permettent de découvrir progressivement le SEO ainsi que d'autres compétences comme la communication digitale, l'acquisition de trafic ou l'analyse de données.</p>
            <p>Par exemple, tu peux intégrer un Bachelor en marketing digital pour acquérir les fondamentaux du secteur, puis poursuivre avec un Mastère afin de te spécialiser davantage et développer une expertise plus avancée.</p>
            <p>Si tu es en reconversion professionnelle ou que tu souhaites découvrir le métier avant de t'engager dans une formation longue, il existe également de nombreuses formations en ligne, certifications et ressources gratuites qui permettent d'apprendre les bases du référencement naturel à ton rythme.</p>
            <p>Quel que soit le parcours choisi, la pratique reste essentielle. Créer un site, réaliser des audits SEO ou tester différentes stratégies sur des projets concrets est souvent le meilleur moyen de progresser et de développer ses compétences.</p>
        </section>

        <section class="finder-job-sheet__interview finder-job-sheet__interview--student">
            <span class="finder-job-sheet__tag">Interview étudiant</span>
            </br>
            <a href="https://youtu.be/xwTPvcPYaOo?si=Pm-ZLxWgLddEjjY9" target="_blank" rel="noopener noreferrer" aria-label="Youtube">Voir l'interview étudiant</a>
        </section>

        <section class="finder-job-sheet__text-block finder-job-sheet__article-link">
            <p>Si tu es intéressé par la freelance, découvre les différentes façons d’exercer le métier et la réalité de la freelance dans <a href="#">notre article</a>.</p>
        </section>

        <section class="finder-job-sheet__text-block">
            <h2 class="finder-job-sheet__section-title">Combien gagne un consultant SEO ?</h2>
            <p>La rémunération d'un consultant SEO peut varier en fonction de ton expérience et de l'environnement de travail. En début de carrière, selon les données de Hellowork, tu peux t'attendre à un salaire moyen entre 26 000 à 33 800 euros bruts par an. Avec plus d'expérience, la rémunération peut grimper jusqu’à 50 000 euros ou plus.</p>
        </section>

        <section class="finder-job-sheet__text-block">
            <h2 class="finder-job-sheet__section-title">Quelles sont les évolutions possibles après quelques années d’expérience ?</h2>
            <p>Après quelques années, les opportunités d'évolution professionnelle en tant que consultant SEO sont nombreuses.</p>
            <p>Si tu souhaites continuer dans ce domaine uniquement, tu peux devenir :</p>
            <ul>
                <li>Responsable SEO</li>
                <li>Manager SEO</li>
                <li>Head of SEO</li>
            </ul>
            <p>Ou bien, tu peux également t’ouvrir à une autre expertise et continuer d’utiliser le SEO comme levier complémentaire. À ce moment-là, tu peux devenir :</p>
            <ul>
                <li>Consultant en stratégie digitale</li>
                <li>Responsable marketing digital</li>
                <li>Directeur marketing</li>
                <li>Growth Hacker</li>
                <li>Product Marketing manager</li>
                <li>Web analyst</li>
                <li>Data analyst</li>
            </ul>
            <p>Certains experts choisissent de se spécialiser dans des niches, comme le SEO international ou le marketing de contenu, tandis que d'autres se tournent vers des postes de direction dans le domaine du marketing digital.</p>
        </section>

        <section class="finder-job-sheet__lead-magnet">
            <h2 class="finder-job-sheet__section-title">Tu veux savoir si le métier de consultant SEO est vraiment fait pour toi ?</h2>
            <p>Découvrir un métier ne suffit pas toujours pour savoir si l'on peut s'y projeter, alors on te propose notre guide « Consultant SEO : est-ce vraiment un métier pour toi ? ».</p>
            <p>Tu y découvriras 10 situations du quotidien pour t’aider à savoir s’il te correspond !</p>
            <a class="finder-job-sheet__cta" href="#">Télécharger le guide</a>
        </section>
    </article>
</main>

<footer class="site-footer" id="footer">
    <div class="site-footer__brand">
        <img src="assets/images/logos/Logo_digital_maker_lab_rectangle_noir.webp" alt="Digital Maker Lab">
    </div>
    <div class="site-footer__logo">
        <img src="assets/images/logos/Logo_digital_maker_lab_rectangle_noir.webp" alt="Digital Maker Lab">
    </div>
    <div class="site-footer__content">
        <nav class="site-footer__nav" aria-label="Navigation pied de page">
            <a href="#">Accueil</a>
            <a href="#about">À propos</a>
            <a href="#jobs">Les métiers du digital</a>
            <a href="#news">Actualités</a>
        </nav>
        <div class="site-footer__socials">
            <a href="#" aria-label="YouTube">
                <img src="assets/images/icons/icon-white-youtube.svg" alt="">
            </a>
            <a href="https://www.instagram.com/digital_maker_lab?igsh=OTJsN2YzczlsZzVx" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                <img src="assets/images/icons/icon-white-instagram.svg" alt="">
            </a>
        </div>
    </div>
    <div class="site-footer__legal">
        <a href="#">Mentions légales</a>
        <a href="#">Conditions générales</a>
    </div>
    <p class="site-footer__copy">Tous droits réservés. 2026 - made by DC Paris</p>
</footer>

<div class="orientation-modal" id="orientation-modal" aria-hidden="true">
    <div class="orientation-modal__backdrop" data-orientation-close></div>
    <section class="orientation-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="orientation-modal-title">
        <div class="orientation-modal__panel">
            <header class="orientation-modal__hero">
                <button class="orientation-modal__close" type="button" aria-label="Fermer le questionnaire" data-orientation-close>&times;</button>
                <h2 id="orientation-modal-title">QUESTIONNAIRES<br>D&rsquo;ORIENTATION</h2>
            </header>
            <div class="orientation-modal__content" data-orientation-content></div>
        </div>
    </section>
</div>

<script src="assets/js/finder.js"></script>
<script src="assets/js/orientation.js"></script>
