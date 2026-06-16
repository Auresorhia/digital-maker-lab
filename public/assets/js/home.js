const menuToggle = document.querySelector('.menu-toggle');
const menuClose = document.querySelector('.menu-close');
const mobileMenu = document.querySelector('.mobile-menu');
const menuLinks = document.querySelectorAll('.mobile-menu__link');
const jobsSlider = document.querySelector('.jobs__slider');
const jobCards = document.querySelectorAll('.job-card');
const jobDots = document.querySelectorAll('.jobs__dot');

const openMenu = () => {
    if (!mobileMenu || !menuToggle) {
        return;
    }

    document.body.classList.add('menu-open');
    mobileMenu.classList.add('is-open');
    mobileMenu.setAttribute('aria-hidden', 'false');
    menuToggle.setAttribute('aria-expanded', 'true');
};

const closeMenu = () => {
    if (!mobileMenu || !menuToggle) {
        return;
    }

    document.body.classList.remove('menu-open');
    mobileMenu.classList.remove('is-open');
    mobileMenu.setAttribute('aria-hidden', 'true');
    menuToggle.setAttribute('aria-expanded', 'false');
};

if (menuToggle) {
    menuToggle.addEventListener('click', openMenu);
}

if (menuClose) {
    menuClose.addEventListener('click', closeMenu);
}

menuLinks.forEach((link) => {
    link.addEventListener('click', closeMenu);
});

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        closeMenu();
    }
});

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
