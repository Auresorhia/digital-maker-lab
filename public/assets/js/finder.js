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

const jobsByCategory = {
    marketing: ['Chef de projet digital', 'SEO Manager', 'Community Manager', 'Content Manager'],
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
        .map((job) => `<li><a href="#" data-job="${job}">${job} <span aria-hidden="true">›</span></a></li>`)
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

if (categoryLinks.length) {
    categoryLinks.forEach((link) => {
        link.addEventListener('click', (event) => {
            event.preventDefault();
            const category = link.getAttribute('data-category');
            const label = link.textContent.trim();
            openSubSidebar(category, label);
        });
    });
}

if (subSidebarBack) {
    subSidebarBack.addEventListener('click', closeSubSidebar);
}

/* ── Job sheet ── */
const jobSheet = document.getElementById('finder-job-sheet');
const jobSheetTitle = document.getElementById('finder-job-sheet-title');
const jobSheetText = document.getElementById('finder-job-sheet-text');
const jobSheetBack = document.querySelector('.finder-job-sheet__back');

const jobDescriptions = {
    'Chef de projet digital': 'Le chef de projet digital coordonne les équipes et les ressources pour mener à bien les projets numériques. Il définit les plannings, les budgets et les livrables tout en assurant la communication entre les parties prenantes.',
    'SEO Manager': 'Le SEO Manager optimise la visibilité des sites web sur les moteurs de recherche. Il analyse les performances, définit les stratégies de contenu et accompagne les équipes éditoriales.',
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

const openJobSheet = (job) => {
    if (!jobSheet || !jobSheetTitle || !jobSheetText) {
        return;
    }
    jobSheetTitle.textContent = job;
    jobSheetText.textContent = jobDescriptions[job] || `Découvrez le métier de ${job}.`;
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

if (jobSheetBack) {
    jobSheetBack.addEventListener('click', closeJobSheet);
}
