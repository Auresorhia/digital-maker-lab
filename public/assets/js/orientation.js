const orientationModal = document.getElementById('orientation-modal');
const orientationPanel = document.querySelector('.orientation-modal__panel');
const orientationOpenButton = document.querySelector('.orientation-preview__button');
const orientationContent = document.querySelector('[data-orientation-content]');
const orientationCloseButtons = document.querySelectorAll('[data-orientation-close]');

let orientationQuestions = [];
let orientationCurrentQuestion = 0;
let orientationSelectedAnswerIds = [];

const escapeHtml = (value) => String(value)
    .replaceAll('&', '&amp;')
    .replaceAll('<', '&lt;')
    .replaceAll('>', '&gt;')
    .replaceAll('"', '&quot;')
    .replaceAll("'", '&#039;');

const renderOrientationMessage = (message) => {
    if (!orientationContent) {
        return;
    }

    orientationPanel?.classList.remove('is-result');
    orientationContent.innerHTML = `<p class="orientation-question__title">${escapeHtml(message)}</p>`;
};

const fetchOrientationQuestions = async () => {
    const response = await fetch('/api/orientation/questions', {
        headers: { Accept: 'application/json' },
    });

    if (!response.ok) {
        throw new Error('Impossible de charger le questionnaire.');
    }

    const data = await response.json();
    return Array.isArray(data.questions) ? data.questions : [];
};

const fetchOrientationResult = async () => {
    const response = await fetch('/api/orientation/result', {
        method: 'POST',
        headers: {
            Accept: 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ answer_ids: orientationSelectedAnswerIds }),
    });

    if (!response.ok) {
        throw new Error('Impossible de calculer le resultat.');
    }

    return response.json();
};

const renderOrientationQuestion = () => {
    if (!orientationContent) {
        return;
    }

    const question = orientationQuestions[orientationCurrentQuestion];

    if (!question) {
        renderOrientationMessage('Aucune question disponible pour le moment.');
        return;
    }

    orientationPanel?.classList.remove('is-result');

    const answersMarkup = question.answers.map((answer) => `
        <button class="orientation-question__answer" type="button" data-answer-id="${answer.id_answer}">
            <span class="orientation-question__dot"></span>
            <span>${escapeHtml(answer.answer_text)}</span>
        </button>
    `).join('');

    orientationContent.innerHTML = `
        <div class="orientation-question">
            <p class="orientation-question__step">Questions ${orientationCurrentQuestion + 1}/${orientationQuestions.length}</p>
            <h3 class="orientation-question__title">${escapeHtml(question.question_text)}</h3>
            <div class="orientation-question__answers">${answersMarkup}</div>
        </div>
    `;
};

const normalizeSpecialtyScores = (scores) => {
    const maxScore = Math.max(...scores.map((score) => Number(score.score) || 0), 1);

    return scores.slice(0, 3).map((score) => ({
        ...score,
        display_percent: Math.round(((Number(score.score) || 0) / maxScore) * 100),
    }));
};

const renderOrientationResult = (result) => {
    if (!orientationContent) {
        return;
    }

    const mainSpecialty = result.main_specialty;
    const topJob = Array.isArray(result.top_jobs) ? result.top_jobs[0] : null;
    const specialtyScores = normalizeSpecialtyScores(result.specialty_scores ?? []);
    const specialtyColors = ['#ff6b35', '#6b7fff', '#ffc84d'];

    if (!mainSpecialty || !topJob) {
        renderOrientationMessage('Resultat indisponible pour le moment.');
        return;
    }

    orientationPanel?.classList.add('is-result');

    const scoresMarkup = specialtyScores.map((score, index) => `
        <div class="orientation-result__score">
            <span class="orientation-result__swatch" style="background:${specialtyColors[index]}"></span>
            <span>${escapeHtml(score.specialty)}</span>
            <strong>${score.display_percent}%</strong>
        </div>
    `).join('');

    orientationContent.innerHTML = `
        <div class="orientation-result">
            <div class="orientation-result__hero">
                <div>
                    <h3>${escapeHtml(mainSpecialty.specialty)}</h3>
                    <span>100%</span>
                </div>
            </div>
            <div class="orientation-result__scores">${scoresMarkup}</div>
            <p class="orientation-result__job-label">Métier à explorer</p>
            <div class="orientation-result__job">
                <strong>${escapeHtml(topJob.job_name)}</strong>
                <span>${escapeHtml(topJob.specialty)}</span>
            </div>
            <button class="orientation-result__restart" type="button" data-orientation-restart>Recommencer</button>
        </div>
    `;
};

const openOrientationModal = async () => {
    if (!orientationModal) {
        return;
    }

    orientationCurrentQuestion = 0;
    orientationSelectedAnswerIds = [];
    orientationModal.classList.add('is-open');
    orientationModal.setAttribute('aria-hidden', 'false');
    document.body.classList.add('menu-open');
    renderOrientationMessage('Chargement du questionnaire...');

    try {
        orientationQuestions = await fetchOrientationQuestions();
        renderOrientationQuestion();
    } catch (error) {
        renderOrientationMessage(error.message);
    }
};

const closeOrientationModal = () => {
    if (!orientationModal) {
        return;
    }

    orientationModal.classList.remove('is-open');
    orientationModal.setAttribute('aria-hidden', 'true');
    document.body.classList.remove('menu-open');
};

if (orientationOpenButton) {
    orientationOpenButton.addEventListener('click', openOrientationModal);
}

orientationCloseButtons.forEach((button) => {
    button.addEventListener('click', closeOrientationModal);
});

if (orientationContent) {
    orientationContent.addEventListener('click', (event) => {
        const answerButton = event.target.closest('[data-answer-id]');
        const restartButton = event.target.closest('[data-orientation-restart]');

        if (restartButton) {
            orientationCurrentQuestion = 0;
            orientationSelectedAnswerIds = [];
            renderOrientationQuestion();
            return;
        }

        if (!answerButton) {
            return;
        }

        answerButton.classList.add('is-selected');
        orientationSelectedAnswerIds[orientationCurrentQuestion] = Number(answerButton.dataset.answerId);

        window.setTimeout(async () => {
            if (orientationCurrentQuestion >= orientationQuestions.length - 1) {
                renderOrientationMessage('Calcul du resultat...');

                try {
                    renderOrientationResult(await fetchOrientationResult());
                } catch (error) {
                    renderOrientationMessage(error.message);
                }

                return;
            }

            orientationCurrentQuestion += 1;
            renderOrientationQuestion();
        }, 180);
    });
}

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && orientationModal?.classList.contains('is-open')) {
        closeOrientationModal();
    }
});
