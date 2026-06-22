(function () {
    'use strict';

    // ── Gestion des onglets ──
    var tabs   = document.querySelectorAll('.metiers-tab');
    var panels = document.querySelectorAll('.metiers-panel');

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            var target = tab.dataset.tab;

            tabs.forEach(function (t) {
                t.classList.remove('is-active');
                t.setAttribute('aria-selected', 'false');
            });
            panels.forEach(function (p) {
                p.classList.remove('is-active');
                p.setAttribute('aria-hidden', 'true');
            });

            tab.classList.add('is-active');
            tab.setAttribute('aria-selected', 'true');

            var panel = document.getElementById('panel-' + target);
            if (panel) {
                panel.classList.add('is-active');
                panel.removeAttribute('aria-hidden');
            }
        });
    });

    // ── Bouton "Ouvrir l'assistant" dans l'onglet Impact ──
    var ctaBtn  = document.querySelector('.js-open-bubble');
    var bubble  = document.querySelector('.ai-bubble');

    if (ctaBtn && bubble) {
        ctaBtn.addEventListener('click', function () {
            bubble.click();
        });
    }
}());
