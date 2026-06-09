document.addEventListener("DOMContentLoaded", () => {
    const toggle = document.getElementById("accessibilityToggle");
    const cards = document.querySelectorAll(".article-card");

    // 1. Étape 1 : Injecter les boutons micros dynamiquement dans chaque conteneur
    cards.forEach(card => {
        const micBtn = document.createElement("button");
        micBtn.classList.add("mic-btn");
        micBtn.innerHTML = "🎤"; // Icône du micro
        micBtn.setAttribute("title", "Écouter le texte");
        card.appendChild(micBtn);

        // 2. Étape 3 : Quand on clique sur le micro, on joue la voix
        micBtn.addEventListener("click", (e) => {
            e.stopPropagation(); // Évite les comportements étranges du clic
            
            // On stoppe les voix en cours s'il y en a
            window.speechSynthesis.cancel();

            // On récupère le texte stocké dans l'attribut data-audio-text de la carte
            const textToSpeak = card.getAttribute("data-audio-text");
            
            // Configuration de la voix française
            const utterance = new SpeechSynthesisUtterance(textToSpeak);
            utterance.lang = "fr-FR";
            utterance.rate = 1.0; // Vitesse de la voix

            // Le navigateur parle !
            window.speechSynthesis.speak(utterance);
        });
    });

    // 3. Étape 2 : Activer/Désactiver le mode accessibilité via le Switch
    toggle.addEventListener("change", () => {
        if (toggle.checked) {
            document.body.classList.add("accessibility-active");
        } else {
            document.body.classList.remove("accessibility-active");
            window.speechSynthesis.cancel(); // Coupe le son si on désactive le switch
        }
    });
});