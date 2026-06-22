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
    if (link.textContent.trim() === 'Métiers Du Digital' || link.textContent.trim() === 'Les métiers du digital') {
        link.classList.add('is-active');
    } else {
        link.classList.remove('is-active');
    }

    const href = link.getAttribute('href');
    if (href && href.startsWith('#')) {
        link.setAttribute('href', `../home.php${href}`);
    }
});

/* ── Données dynamiques venant de finder.php ── */
const jobsByCategory = window.finderJobsByCategory || {};

const escapeHtml = (value) => {
    return String(value)
        .replaceAll('&', '&amp;')
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;')
        .replaceAll('"', '&quot;')
        .replaceAll("'", '&#039;');
};

/* ── Sub-sidebar ── */
const subSidebar = document.getElementById('finder-subsidebar');
const subSidebarTitle = document.getElementById('finder-subsidebar-title');
const subSidebarList = document.getElementById('finder-subsidebar-list');
const subSidebarBack = document.querySelector('.finder-subsidebar__back');
const categoryLinks = document.querySelectorAll('.finder-sidebar__list a[data-category]');

const openSubSidebar = (category, label) => {
    if (!subSidebar || !subSidebarTitle || !subSidebarList) {
        return;
    }

    const jobs = jobsByCategory[category] || [];
    subSidebarTitle.textContent = label;

    if (jobs.length === 0) {
        subSidebarList.innerHTML = `
            <li class="finder-subsidebar__empty">
                Aucun métier visible pour cette catégorie.
            </li>
        `;
    } else {
        subSidebarList.innerHTML = jobs
            .map((job) => {
                const href = job.slug ? `/metiers/${escapeHtml(job.slug)}` : '#';

                return `
                    <li>
                        <a href="${href}" data-job="${escapeHtml(job.name)}">
                            ${escapeHtml(job.name)}
                            <span aria-hidden="true">›</span>
                        </a>
                    </li>
                `;
            })
            .join('');
    }

    subSidebar.classList.add('is-open');
    subSidebar.setAttribute('aria-hidden', 'false');
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
            categoryLinks.forEach((categoryLink) => categoryLink.classList.remove('is-active'));
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

if (categoryLinks.length && isDesktop()) {
    const firstLink = categoryLinks[0];
    firstLink.classList.add('is-active');
    openSubSidebar(firstLink.getAttribute('data-category'), firstLink.textContent.trim());
}

/* ── Accordéons de la fiche métier ── */
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
