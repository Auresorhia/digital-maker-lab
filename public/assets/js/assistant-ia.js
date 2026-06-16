(function () {
    'use strict';

    var JOB_COLORS = {
        1: '#FF806B',
        2: '#FBC246',
        3: '#6B7FFF',
        4: '#C5B0FF',
        5: '#4DE8D0',
        6: '#E85D75',
        7: '#FF9A56',
        8: '#95D47A'
    };

    var COLLAB_TEXTS = {
        1: 'L\'entrepreneur impulse la vision produit et définit les priorités stratégiques. Sa maîtrise du marché et des enjeux business est une ressource précieuse pour tous les métiers digitaux.',
        2: 'Le responsable CRM centralise les données clients et optimise chaque point de contact. Sa connaissance fine des audiences enrichit toutes les décisions de contenu et de produit.',
        3: 'Le consultant SEO pilote la visibilité organique sur les moteurs de recherche. Son expertise des intentions de recherche nourrit la stratégie de contenu et l\'architecture des parcours.',
        4: 'Le game designer structure des expériences interactives engageantes. Sa pensée systémique et sa créativité enrichissent la conception de tout produit numérique.',
        5: 'Le développeur web conçoit et implémente les solutions techniques. Ce partenaire essentiel traduit les idées en interfaces fonctionnelles et performantes.',
        6: 'Le community manager anime les communautés et amplifie la présence de marque. Sa relation directe avec les audiences fournit des retours précieux sur les usages réels.',
        7: 'Le vidéaste raconte des histoires avec l\'image et le son. Son sens du storytelling et de l\'esthétique élève l\'impact émotionnel de tout message de marque.',
        8: 'Le graphiste façonne l\'identité visuelle et garantit la cohérence de marque. Son sens de la composition et de la couleur renforce chaque communication.'
    };

    var bubble    = document.querySelector('.ai-bubble');
    var overlay   = document.querySelector('.ai-overlay');
    var modal     = document.querySelector('.ai-modal');
    var closeBtn  = document.querySelector('.ai-modal__close');
    var tabBtns   = document.querySelectorAll('.ai-tab');
    var jobsGrid  = document.querySelector('.ai-jobs-grid');
    var appsList  = document.querySelector('.ai-apps-list');
    var msgStatus = document.querySelector('.ai-message__status');
    var msgText   = document.querySelector('.ai-message__text');
    var hintEl    = document.querySelector('.ai-hint');
    var ctaBtn    = document.querySelector('.ai-cta');

    if (!bubble || !modal) return;

    var currentJobId   = parseInt(bubble.getAttribute('data-metier-id'), 10);
    var activeTab      = 'collabs';
    var selectedJobId  = null;
    var selectedAppIdx = null;
    var appsData       = null;
    var jobsData       = null;
    var isOpen         = false;

    function openModal() {
        overlay.classList.add('is-open');
        modal.classList.add('is-open');
        modal.setAttribute('aria-hidden', 'false');
        bubble.setAttribute('aria-expanded', 'true');
        isOpen = true;
        if (!appsData) loadCurrentApps();
        if (!jobsData) loadJobs();
    }

    function closeModal() {
        overlay.classList.remove('is-open');
        modal.classList.remove('is-open');
        modal.setAttribute('aria-hidden', 'true');
        bubble.setAttribute('aria-expanded', 'false');
        isOpen = false;
    }

    function switchTab(tab) {
        activeTab      = tab;
        selectedJobId  = null;
        selectedAppIdx = null;
        tabBtns.forEach(function (btn) {
            var active = btn.getAttribute('data-tab') === tab;
            btn.classList.toggle('is-active', active);
            btn.setAttribute('aria-selected', active ? 'true' : 'false');
        });
        renderJobs();
        renderAppsList();
        resetMessage();
    }

    function loadCurrentApps() {
        showAppsLoader();
        fetch('/api/assistant/' + currentJobId)
            .then(function (res) {
                if (!res.ok) throw new Error('HTTP ' + res.status);
                return res.json();
            })
            .then(function (data) {
                if (data.success && data.apps) {
                    appsData = data.apps;
                    renderAppsList();
                }
            })
            .catch(function () { showAppsError(); });
    }

    function loadJobs() {
        fetch('/api/assistant/jobs/' + currentJobId)
            .then(function (res) {
                if (!res.ok) throw new Error('HTTP ' + res.status);
                return res.json();
            })
            .then(function (data) {
                if (data.success && data.jobs) {
                    jobsData = data.jobs;
                    renderJobs();
                }
            })
            .catch(function () {
                jobsGrid.innerHTML = '<p style="font-size:12px;color:rgba(243,241,234,0.3);padding:8px 0;">Impossible de charger les métiers.</p>';
            });
    }

    function renderJobs() {
        if (!jobsData) return;
        var isPassive = activeTab === 'impact';
        var html = '';
        jobsData.forEach(function (job) {
            var numId    = parseInt(job.id_job, 10);
            var color    = JOB_COLORS[numId] || '#888888';
            var selected = numId === selectedJobId;
            var bgStyle  = selected ? 'background:' + hexToRgba(color, 0.09) + ';' : '';
            html += '<button class="ai-job-card' +
                (selected  ? ' is-selected' : '') +
                (isPassive ? ' is-passive'  : '') +
                '" type="button" data-job-id="' + numId + '"' +
                ' style="--job-color:' + color + ';' + bgStyle + '"' +
                (isPassive ? ' tabindex="-1"' : '') +
                '>' +
                '<span class="ai-job-card__circle"></span>' +
                '<span class="ai-job-card__name">' + escapeHtml(job.job_name) + '</span>' +
                '</button>';
        });
        jobsGrid.innerHTML = html;

        if (!isPassive) {
            jobsGrid.querySelectorAll('.ai-job-card').forEach(function (card) {
                card.addEventListener('click', function () {
                    onJobClick(parseInt(card.getAttribute('data-job-id'), 10));
                });
            });
        }
    }

    function onJobClick(jobId) {
        selectedJobId = (selectedJobId === jobId) ? null : jobId;
        renderJobs();
        if (selectedJobId) {
            var job  = jobsData.find(function (j) { return parseInt(j.id_job, 10) === selectedJobId; });
            var name = job ? job.job_name : 'Métier ' + selectedJobId;
            setMessage(name, COLLAB_TEXTS[selectedJobId] || '');
        } else {
            resetMessage();
        }
    }

    function renderAppsList() {
        if (!appsData) return;
        var isClickable = activeTab === 'impact';
        var html = '';
        appsData.forEach(function (app, index) {
            var selected = index === selectedAppIdx;
            html += '<button class="ai-app-item' +
                (isClickable ? ' is-clickable' : ' is-passive') +
                (selected    ? ' is-selected'  : '') +
                '" type="button" data-app-idx="' + index + '"' +
                (!isClickable ? ' tabindex="-1"' : '') +
                '>' +
                '<span class="ai-app-item__dot"></span>' +
                '<span class="ai-app-item__name">' + escapeHtml(app.app_name) + '</span>' +
                '</button>';
        });
        appsList.innerHTML = html;

        if (isClickable) {
            appsList.querySelectorAll('.ai-app-item').forEach(function (item) {
                item.addEventListener('click', function () {
                    onAppClick(parseInt(item.getAttribute('data-app-idx'), 10));
                });
            });
        }
    }

    function onAppClick(idx) {
        selectedAppIdx = (selectedAppIdx === idx) ? null : idx;
        renderAppsList();
        if (selectedAppIdx !== null && appsData[selectedAppIdx]) {
            var app = appsData[selectedAppIdx];
            setMessage(app.app_name, app.description);
        } else {
            resetMessage();
        }
    }

    function showAppsLoader() {
        appsList.innerHTML = '<div class="ai-loader"><span class="ai-loader__spinner"></span>Chargement...</div>';
    }

    function showAppsError() {
        appsList.innerHTML = '<p style="font-size:12px;color:rgba(243,241,234,0.3);padding:8px 0;">Impossible de charger.</p>';
    }

    function setMessage(status, text) {
        msgStatus.textContent = status;
        msgText.textContent   = text;
        msgText.classList.remove('ai-message__text--hint');
        if (hintEl) hintEl.classList.add('is-hidden');
    }

    function resetMessage() {
        msgStatus.textContent = 'En attente';
        msgText.textContent   = 'Clique sur un métier pour activer l\'assistant';
        msgText.classList.add('ai-message__text--hint');
        if (hintEl) hintEl.classList.remove('is-hidden');
    }

    function hexToRgba(hex, alpha) {
        var r = parseInt(hex.slice(1, 3), 16);
        var g = parseInt(hex.slice(3, 5), 16);
        var b = parseInt(hex.slice(5, 7), 16);
        return 'rgba(' + r + ',' + g + ',' + b + ',' + alpha + ')';
    }

    function escapeHtml(str) {
        var div = document.createElement('div');
        div.appendChild(document.createTextNode(str));
        return div.innerHTML;
    }

    bubble.addEventListener('click', function () {
        if (isOpen) { closeModal(); } else { openModal(); }
    });

    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    overlay.addEventListener('click', closeModal);

    tabBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            switchTab(btn.getAttribute('data-tab'));
        });
    });

    if (ctaBtn) {
        ctaBtn.addEventListener('click', function () {
            selectedJobId  = null;
            selectedAppIdx = null;
            renderJobs();
            renderAppsList();
            resetMessage();
        });
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && isOpen) closeModal();
    });

    resetMessage();

}());
