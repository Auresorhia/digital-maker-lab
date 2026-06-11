document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('search-input');
    const dropdown = document.getElementById('search-dropdown');

    if (!input || !dropdown) return;

    let debounceTimer = null;

    input.addEventListener('input', () => {
        const query = input.value.trim();

        clearTimeout(debounceTimer);
        dropdown.innerHTML = '';
        dropdown.classList.add('search-dropdown--hidden');

        if (query.length < 1) return;

        debounceTimer = setTimeout(() => {
            fetch(`/api/search.php?q=${encodeURIComponent(query)}`)
                .then(res => res.json())
                .then(resultats => {
                    dropdown.innerHTML = '';

                    if (resultats.length === 0) {
                        dropdown.classList.add('search-dropdown--hidden');
                        return;
                    }

                    resultats.forEach(metier => {
                        const item = document.createElement('li');
                        item.classList.add('search-dropdown__item');

                        const titreHighlight = highlighterTexte(metier.titre, query);
                        item.innerHTML = `
                            <span class="search-dropdown__icon">&#128269;</span>
                            <span class="search-dropdown__titre">${titreHighlight}</span>
                            <span class="search-dropdown__specialite">${metier.specialite}</span>
                        `;

                        item.addEventListener('mousedown', (e) => {
                            e.preventDefault();
                            // TODO : adapter l'URL quand la route /metier/{id} sera créée par le lead dev
                            window.location.href = `/metier/${metier.id}`;
                        });

                        dropdown.appendChild(item);
                    });

                    dropdown.classList.remove('search-dropdown--hidden');
                })
                .catch(() => {
                    dropdown.classList.add('search-dropdown--hidden');
                });
        }, 200);
    });

    input.addEventListener('blur', () => {
        setTimeout(() => {
            dropdown.classList.add('search-dropdown--hidden');
        }, 150);
    });

    input.addEventListener('focus', () => {
        if (dropdown.children.length > 0) {
            dropdown.classList.remove('search-dropdown--hidden');
        }
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            dropdown.classList.add('search-dropdown--hidden');
            input.blur();
        }
    });

    function highlighterTexte(texte, query) {
        const escaped = query.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        const regex = new RegExp(`(${escaped})`, 'gi');
        return texte.replace(regex, '<strong>$1</strong>');
    }
});
