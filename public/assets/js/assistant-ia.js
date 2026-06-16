/**
 * Assistant IA — Bulle et panneau latéral
 * Ticket #32 : Intégration front-end sur les pages métiers
 *
 * Usage : inclure ce script sur une page métier avec l'attribut
 * data-metier-id sur le bouton .assistant-ia-bubble
 *
 * Exemple :
 *   <button class="assistant-ia-bubble" data-metier-id="5">...</button>
 */

(function () {
    'use strict';

    // -------------------------------------------------------
    // Sélecteurs
    // -------------------------------------------------------
    const bubble  = document.querySelector('.assistant-ia-bubble');
    const overlay = document.querySelector('.assistant-ia-overlay');
    const panel   = document.querySelector('.assistant-ia-panel');
    const closeBtn = document.querySelector('.assistant-ia-panel__close');
    const panelBody = document.querySelector('.assistant-ia-panel__body');

    if (!bubble || !overlay || !panel) return;

    const metierIdAttr = bubble.getAttribute('data-metier-id');
    const metierId = metierIdAttr ? parseInt(metierIdAttr, 10) : null;

    let isOpen    = false;
    let isLoaded  = false;

    // -------------------------------------------------------
    // Ouvrir / fermer le panneau
    // -------------------------------------------------------
    function openPanel() {
        panel.classList.add('is-open');
        overlay.classList.add('is-open');
        bubble.setAttribute('aria-expanded', 'true');
        panel.setAttribute('aria-hidden', 'false');
        isOpen = true;

        if (!isLoaded && metierId) {
            loadApps(metierId);
        }
    }

    function closePanel() {
        panel.classList.remove('is-open');
        overlay.classList.remove('is-open');
        bubble.setAttribute('aria-expanded', 'false');
        panel.setAttribute('aria-hidden', 'true');
        isOpen = false;
    }

    // -------------------------------------------------------
    // Appel API
    // -------------------------------------------------------
    function loadApps(jobId) {
        showLoader();

        fetch('/api/assistant/' + jobId)
            .then(function (res) {
                if (!res.ok) throw new Error('Erreur réseau : ' + res.status);
                return res.json();
            })
            .then(function (data) {
                if (!data.success || !data.apps) {
                    throw new Error(data.error || 'Données introuvables.');
                }
                renderApps(data.apps);
                isLoaded = true;
            })
            .catch(function (err) {
                showError('Impossible de charger les applications. Veuillez réessayer.');
                console.error('[AssistantIA]', err);
            });
    }

    // -------------------------------------------------------
    // Rendu des cartes
    // -------------------------------------------------------
    function renderApps(apps) {
        var html = '';

        apps.forEach(function (app, index) {
            var tags = app.tags
                .split(',')
                .map(function (t) { return '<span class="assistant-ia-app-card__tag">' + escapeHtml(t.trim()) + '</span>'; })
                .join('');

            var source = app.source
                ? '<span class="assistant-ia-app-card__source">' + escapeHtml(app.source) + '</span>'
                : '';

            html += '<article class="assistant-ia-app-card">' +
                '<div class="assistant-ia-app-card__header">' +
                    '<h3 class="assistant-ia-app-card__name">' + escapeHtml(app.app_name) + '</h3>' +
                    '<span class="assistant-ia-app-card__number" aria-hidden="true">' + (index + 1) + '</span>' +
                '</div>' +
                '<div class="assistant-ia-app-card__tags">' + tags + '</div>' +
                '<p class="assistant-ia-app-card__description">' + escapeHtml(app.description) + '</p>' +
                source +
            '</article>';
        });

        panelBody.innerHTML = html;
    }

    // -------------------------------------------------------
    // États du panneau
    // -------------------------------------------------------
    function showLoader() {
        panelBody.innerHTML =
            '<div class="assistant-ia-panel__loader" role="status" aria-live="polite">' +
                '<div class="assistant-ia-panel__loader-spinner" aria-hidden="true"></div>' +
                '<span>Chargement des applications...</span>' +
            '</div>';
    }

    function showError(message) {
        panelBody.innerHTML =
            '<p class="assistant-ia-panel__error">' + escapeHtml(message) + '</p>';
    }

    // -------------------------------------------------------
    // Sécurité : échapper le HTML
    // -------------------------------------------------------
    function escapeHtml(str) {
        var div = document.createElement('div');
        div.appendChild(document.createTextNode(str));
        return div.innerHTML;
    }

    // -------------------------------------------------------
    // Événements
    // -------------------------------------------------------
    bubble.addEventListener('click', function () {
        if (isOpen) {
            closePanel();
        } else {
            openPanel();
        }
    });

    if (closeBtn) {
        closeBtn.addEventListener('click', closePanel);
    }

    overlay.addEventListener('click', closePanel);

    // Fermeture via Escape
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && isOpen) {
            closePanel();
        }
    });

    // Init attributs d'accessibilité
    bubble.setAttribute('aria-expanded', 'false');
    bubble.setAttribute('aria-controls', 'assistant-ia-panel');
    panel.setAttribute('aria-hidden', 'true');
    panel.setAttribute('id', 'assistant-ia-panel');

}());
