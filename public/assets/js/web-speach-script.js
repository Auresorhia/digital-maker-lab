document.addEventListener("DOMContentLoaded", () => {
    const audioToggle = document.getElementById("audio-toggle");
    
    if (!audioToggle) return; // Sécurité si le nav_support n'est pas affiché sur une page

    // 1. Trouver et préparer tous les éléments cibles existants sur la page
    const audioElements = document.querySelectorAll(".audio-target");
    
    audioElements.forEach(element => {
        const microBtn = document.createElement("button");
        microBtn.type = "button";
        microBtn.className = "audio-micro-btn";
        microBtn.innerText = "🎤";
        microBtn.setAttribute("aria-label", "Écouter le texte");

        microBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            let textToRead = element.innerText.replace("🎤", "").trim();
            speakText(textToRead);
        });

        element.appendChild(microBtn);
    });

    // 2. Vérifier la mémoire locale (localStorage) au chargement de la page
    if (localStorage.getItem("audioMode") === "enabled") {
        document.body.classList.add("audio-mode-active");
        audioToggle.classList.add("is-active"); // Style visuel pour montrer qu'il est ON
    }

    // 3. Gestion du clic sur le bouton ☎ (On/Off toggle)
    audioToggle.addEventListener("click", (e) => {
        e.preventDefault(); // Empêche le lien de recharger la page ou de remonter en haut

        // On bascule l'état actif
        const isActive = document.body.classList.toggle("audio-mode-active");
        audioToggle.classList.toggle("is-active", isActive);

        if (isActive) {
            localStorage.setItem("audioMode", "enabled");
            speakText("Mode audio activé.");
        } else {
            localStorage.setItem("audioMode", "disabled");
            window.speechSynthesis.cancel(); // Coupe le son immédiatement
        }
    });

    // 4. Moteur de synthèse vocale
    function speakText(text) {
        window.speechSynthesis.cancel(); 

        if (text !== "") {
            const utterance = new SpeechSynthesisUtterance(text);
            utterance.lang = "fr-FR";
            utterance.rate = 1.0;
            window.speechSynthesis.speak(utterance);
        }
    }
});