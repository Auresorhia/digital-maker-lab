const jobsSlider = document.querySelector('.jobs__slider');
const jobCards = document.querySelectorAll('.job-card');
const jobDots = document.querySelectorAll('.jobs__dot');

const updateJobsPagination = () => {
    if (!jobsSlider || !jobCards.length || !jobDots.length) {
        return;
    }

    const sliderLeft = jobsSlider.getBoundingClientRect().left;
    let activeIndex = 0;
    let smallestDistance = Infinity;

    jobCards.forEach((card, index) => {
        const distance = Math.abs(card.getBoundingClientRect().left - sliderLeft);

        if (distance < smallestDistance) {
            smallestDistance = distance;
            activeIndex = index;
        }
    });

    jobDots.forEach((dot, index) => {
        dot.classList.toggle('is-active', index === activeIndex);
    });
};

if (jobsSlider) {
    jobsSlider.addEventListener('scroll', updateJobsPagination, { passive: true });
    jobsSlider.addEventListener('wheel', (event) => {
        if (Math.abs(event.deltaY) <= Math.abs(event.deltaX)) {
            return;
        }

        event.preventDefault();
        jobsSlider.scrollLeft += event.deltaY * 1.6;
    }, { passive: false });
    window.addEventListener('resize', updateJobsPagination);
    updateJobsPagination();
}

const allNavLinks = document.querySelectorAll('.desktop-nav__link, .mobile-menu__link, .site-footer__nav a');
const navSections = ['hero', 'about', 'jobs', 'news'];

allNavLinks.forEach((link) => {
    link.addEventListener('click', (event) => {
        const href = link.getAttribute('href');
        if (!href || href === '#') {
            return;
        }
        const target = document.querySelector(href);
        if (target) {
            event.preventDefault();
            target.scrollIntoView({ behavior: 'smooth' });
        }
    });
});

const navList = document.querySelector('.desktop-nav__list');
let navPill = null;

if (navList) {
    navPill = document.createElement('span');
    navPill.className = 'nav-pill';
    navList.appendChild(navPill);
}

const movePill = () => {
    if (!navPill || !navList) {
        return;
    }

    const activeLink = navList.querySelector('.desktop-nav__link.is-active');

    if (!activeLink) {
        return;
    }

    const listRect = navList.getBoundingClientRect();
    const linkRect = activeLink.getBoundingClientRect();

    navPill.style.left = `${linkRect.left - listRect.left}px`;
    navPill.style.width = `${linkRect.width}px`;
};

const updateActiveNav = () => {
    const viewportMiddle = window.scrollY + window.innerHeight * 0.45;
    let current = null;

    navSections.forEach((id) => {
        const section = document.getElementById(id);
        if (section && section.offsetTop <= viewportMiddle) {
            current = id;
        }
    });

    allNavLinks.forEach((link) => {
        const href = link.getAttribute('href');
        const expected = `#${current ?? 'hero'}`;
        link.classList.toggle('is-active', href === expected);
    });

    movePill();
};

window.addEventListener('scroll', updateActiveNav, { passive: true });
window.addEventListener('resize', movePill);
updateActiveNav();
