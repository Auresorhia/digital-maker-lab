const sidebar = document.querySelector('.finder-sidebar');
const overlay = document.querySelector('.finder-sidebar-overlay');
const toggleBtn = document.querySelector('.finder-sidebar__toggle');
const closeBtn = document.querySelector('.finder-sidebar__close');

const openSidebar = () => {
    if (!sidebar || !overlay || !toggleBtn) {
        return;
    }
    sidebar.classList.add('is-open');
    overlay.classList.add('is-open');
    toggleBtn.setAttribute('aria-expanded', 'true');
};

const closeSidebar = () => {
    if (!sidebar || !overlay || !toggleBtn) {
        return;
    }
    sidebar.classList.remove('is-open');
    overlay.classList.remove('is-open');
    toggleBtn.setAttribute('aria-expanded', 'false');
};

if (toggleBtn) {
    toggleBtn.addEventListener('click', openSidebar);
}

if (closeBtn) {
    closeBtn.addEventListener('click', closeSidebar);
}

if (overlay) {
    overlay.addEventListener('click', closeSidebar);
}

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        closeSidebar();
    }
});

const desktopLinks = document.querySelectorAll('.desktop-nav__link');
desktopLinks.forEach((link) => {
    if (link.textContent.trim() === 'Métiers Du Digital') {
        link.classList.add('is-active');
    } else {
        link.classList.remove('is-active');
    }

    const href = link.getAttribute('href');
    if (href && href.startsWith('#')) {
        link.setAttribute('href', `../home.php${href}`);
    }
});

/* ── Sub-sidebar ── */
const subSidebar = document.getElementById('finder-subsidebar');
const subSidebarTitle = document.getElementById('finder-subsidebar-title');
const subSidebarList = document.getElementById('finder-subsidebar-list');
const subSidebarBack = document.querySelector('.finder-subsidebar__back');
const categoryLinks = document.querySelectorAll('.finder-sidebar__list a[data-category]');

const jobSlugs = {
    'Consultant SEO': 'consultant-seo',
};

const jobsByCategory = {
    marketing: ['Chef de projet digital', 'Consultant SEO', 'Community Manager', 'Content Manager'],
    uxpo: ['UX Designer', 'UI Designer', 'Product Owner', 'UX Researcher'],
    videos: ['Motion Designer', 'Animateur 2D', 'Animateur 3D', 'Monteur Vidéo'],
    design: ['Graphiste', 'Motion Designer', 'Directeur artistique', 'Webdesigner'],
    developpement: ['Développeur Front-end', 'Développeur Back-end', 'Développeur Full-stack', 'DevOps']
};

const openSubSidebar = (category, label) => {
    if (!subSidebar || !subSidebarTitle || !subSidebarList) {
        return;
    }

    const jobs = jobsByCategory[category] || [];
    subSidebarTitle.textContent = label;
    subSidebarList.innerHTML = jobs
        .map((job) => {
            const slug = jobSlugs[job];
            const href = slug ? `/metiers/${slug}` : '#';
            return `<li><a href="${href}" data-job="${job}">${job} <span aria-hidden="true">›</span></a></li>`;
        })
        .join('');

    subSidebar.classList.add('is-open');
    subSidebar.setAttribute('aria-hidden', 'false');

    attachJobClickHandlers();
};

const closeSubSidebar = () => {
    if (!subSidebar) {
        return;
    }
    subSidebar.classList.remove('is-open');
    subSidebar.setAttribute('aria-hidden', 'true');
};

const isDesktop = () => window.innerWidth >= 1024;

if (categoryLinks.length) {
    categoryLinks.forEach((link) => {
        link.addEventListener('click', (event) => {
            event.preventDefault();
            categoryLinks.forEach((l) => l.classList.remove('is-active'));
            link.classList.add('is-active');
            const category = link.getAttribute('data-category');
            const label = link.textContent.trim();
            openSubSidebar(category, label);
        });
    });
}

if (subSidebarBack) {
    subSidebarBack.addEventListener('click', closeSubSidebar);
}

document.addEventListener('click', (event) => {
    if (!subSidebar || !subSidebar.classList.contains('is-open') || isDesktop()) {
        return;
    }

    const target = event.target;
    const isInsideSubSidebar = subSidebar.contains(target);
    const isCategoryLink = target.closest('.finder-sidebar__list a[data-category]');

    if (!isInsideSubSidebar && !isCategoryLink) {
        closeSubSidebar();
    }
});

/* ── Job sheet ── */
const jobSheet = document.getElementById('finder-job-sheet');
const jobSheetTitle = document.getElementById('finder-job-sheet-title');
const jobSheetIntro = document.querySelector('.finder-job-sheet__intro');

const jobDescriptions = {
    'Chef de projet digital': 'Le chef de projet digital coordonne les équipes et les ressources pour mener à bien les projets numériques. Il définit les plannings, les budgets et les livrables tout en assurant la communication entre les parties prenantes.',
    'Consultant SEO': 'Consultant SEO, spécialiste SEO, expert SEO, référenceur web… Ce métier peut porter plusieurs noms différents, mais dans la finalité, sa mission reste la même : celle d’augmenter la visibilité et le trafic des sites web.<br><br>Alors, si tu aimes manier les mots, découvrir comment fonctionne le web, analyser des données et comprendre pourquoi certains contenus apparaissent sur les moteurs de recherche et d’autres non…<br><br>Peut-être que le métier de consultant SEO est fait pour toi !',
    'Community Manager': 'Le Community Manager anime les réseaux sociaux d’une marque. Il crée du contenu, modère les échanges et analyse l’engagement de la communauté.',
    'Content Manager': 'Le Content Manager pilote la production et la diffusion des contenus. Il veille à la cohérence éditoriale et à l’optimisation des supports.',
    'UX Designer': 'L’UX Designer conçoit des expériences utilisateur fluides et intuitives. Il réalise des recherches, des prototypes et des tests pour améliorer les produits numériques.',
    'UI Designer': 'L’UI Designer définit l’interface graphique des applications. Il choisit les couleurs, typographies et composants pour créer un design cohérent.',
    'Product Owner': 'Le Product Owner priorise les fonctionnalités du produit. Il représente les besoins utilisateurs et valide les livrables avec l’équipe de développement.',
    'UX Researcher': 'L’UX Researcher étudie les comportements utilisateurs pour guider les décisions de conception. Il mène des entretiens et analyse les données qualitatives.',
    'Motion Designer': 'Le Motion Designer crée des animations et des contenus vidéo dynamiques. Il travaille sur les transitions, les effets visuels et les supports promotionnels.',
    'Animateur 2D': 'L’Animateur 2D donne vie à des personnages et des décors en deux dimensions. Il réalise des storyboards, des animations et des séquences graphiques.',
    'Animateur 3D': 'L’Animateur 3D modélise et anime des éléments en trois dimensions. Il intervient dans le cinéma, le jeu vidéo ou la publicité.',
    'Monteur Vidéo': 'Le Monteur Vidéo assemble les plans, ajoute les effets et finalise les productions audiovisuelles. Il travaille sur le rythme, le son et la narration.',
    'Graphiste': 'Le Graphiste conçoit des supports visuels print et digital. Il maîtrise la composition, la typographie et les outils de création.',
    'Directeur artistique': 'Le Directeur artistique supervise l’identité visuelle et la direction créative. Il coordonne les équipes de designers et valide les propositions.',
    'Webdesigner': 'Le Webdesigner conçoit l’apparence des sites web. Il allie esthétique, ergonomie et contraintes techniques pour créer des interfaces attractives.',
    'Développeur Front-end': 'Le Développeur Front-end développe la partie visible des sites et applications. Il maîtrise HTML, CSS et JavaScript pour créer des interfaces interactives.',
    'Développeur Back-end': 'Le Développeur Back-end gère la partie serveur des applications. Il conçoit les bases de données, les API et la logique métier.',
    'Développeur Full-stack': 'Le Développeur Full-stack maîtrise à la fois le front-end et le back-end. Il est capable de concevoir une application complète de bout en bout.',
    'DevOps': 'Le DevOps automatise les déploiements et optimise l’infrastructure. Il assure la fiabilité, la sécurité et la scalabilité des systèmes.'
};

const jobTitleMap = {
    'Consultant SEO': 'Le métier de consultant SEO',
    'Chef de projet digital': 'Le métier de chef de projet digital',
    'Community Manager': 'Le métier de community manager',
    'Content Manager': 'Le métier de content manager',
    'UX Designer': 'Le métier d’UX designer',
    'UI Designer': 'Le métier d’UI designer',
    'Product Owner': 'Le métier de product owner',
    'UX Researcher': 'Le métier d’UX researcher',
    'Motion Designer': 'Le métier de motion designer',
    'Animateur 2D': 'Le métier d’animateur 2D',
    'Animateur 3D': 'Le métier d’animateur 3D',
    'Monteur Vidéo': 'Le métier de monteur vidéo',
    'Graphiste': 'Le métier de graphiste',
    'Directeur artistique': 'Le métier de directeur artistique',
    'Webdesigner': 'Le métier de webdesigner',
    'Développeur Front-end': 'Le métier de développeur front-end',
    'Développeur Back-end': 'Le métier de développeur back-end',
    'Développeur Full-stack': 'Le métier de développeur full-stack',
    'DevOps': 'Le métier de DevOps'
};

const openJobSheet = (job) => {
    if (!jobSheet || !jobSheetTitle || !jobSheetIntro) {
        return;
    }
    jobSheetTitle.textContent = jobTitleMap[job] || `Le métier de ${job}`;
    jobSheetIntro.innerHTML = `
        <h2 class="finder-job-sheet__section-title">titre H2</h2>
        <p>${jobDescriptions[job] || `Découvrez le métier de ${job}.`}</p>
    `;
    jobSheet.classList.add('is-open');
    jobSheet.setAttribute('aria-hidden', 'false');
};

const closeJobSheet = () => {
    if (!jobSheet) {
        return;
    }
    jobSheet.classList.remove('is-open');
    jobSheet.setAttribute('aria-hidden', 'true');
};

const attachJobClickHandlers = () => {
    const jobLinks = document.querySelectorAll('.finder-subsidebar__list a[data-job]');
    jobLinks.forEach((link) => {
        link.addEventListener('click', (event) => {
            event.preventDefault();
            const job = link.getAttribute('data-job');
            openJobSheet(job);
        });
    });
};

if (categoryLinks.length && isDesktop()) {
    const firstLink = categoryLinks[0];
    firstLink.classList.add('is-active');
    openSubSidebar(firstLink.getAttribute('data-category'), firstLink.textContent.trim());
}

const accordionTriggers = document.querySelectorAll('.finder-job-sheet__accordion-trigger');
accordionTriggers.forEach((trigger) => {
    const icon = trigger.querySelector('[aria-hidden="true"]');
    if (icon) {
        icon.textContent = '▶';
    }

    trigger.addEventListener('click', () => {
        const isExpanded = trigger.getAttribute('aria-expanded') === 'true';
        const panel = document.getElementById(trigger.getAttribute('aria-controls'));

        trigger.setAttribute('aria-expanded', String(!isExpanded));
        if (panel) {
            panel.classList.toggle('is-open', !isExpanded);
        }

        if (icon) {
            icon.style.transform = isExpanded ? 'rotate(0deg)' : 'rotate(90deg)';
        }
    });
});

document.addEventListener('finder:openJob', (e) => {
    const titre = e.detail.titre;
    if (titre) {
        openJobSheet(titre);
    }
});