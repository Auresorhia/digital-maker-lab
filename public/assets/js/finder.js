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
    marketing: ['Consultant SEO'],
    uxpo: [],
    videos: [],
    design: [],
    developpement: []
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
    'Consultant SEO': 'Consultant SEO, spécialiste SEO, expert SEO, référenceur web… Ce métier peut porter plusieurs noms différents, mais dans la finalité, sa mission reste la même : celle d’augmenter la visibilité et le trafic des sites web.<br><br>Alors, si tu aimes manier les mots, découvrir comment fonctionne le web, analyser des données et comprendre pourquoi certains contenus apparaissent sur les moteurs de recherche et d’autres non…<br><br>Peut-être que le métier de consultant SEO est fait pour toi !'
};

const jobTitleMap = {
    'Consultant SEO': 'Le métier de consultant SEO'
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
            const href = link.getAttribute('href');
            if (href && href !== '#') {
                return;
            }
            event.preventDefault();
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