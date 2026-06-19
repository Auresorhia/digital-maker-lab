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
        link.setAttribute('href', `../public`);
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
        .map((job) => `<li><a href="#">${job} <span aria-hidden="true">›</span></a></li>`)
        .join('');

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
