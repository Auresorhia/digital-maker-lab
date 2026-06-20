
document.addEventListener("DOMContentLoaded", () => {
    const audioToggle = document.getElementById("audio-toggle");
    
    // 1. Trouver tous les éléments cibles et injecter automatiquement le bouton micro
    const audioElements = document.querySelectorAll(".audio-target");
    
    audioElements.forEach(element => {
        // On crée un vrai bouton HTML pour le micro
        const microBtn = document.createElement("button");
        microBtn.type = "button";
        microBtn.className = "audio-micro-btn";
        microBtn.innerText = "🎤";
        microBtn.setAttribute("aria-label", "Écouter le texte");

        // Événement au clic sur CE micro précis
        microBtn.addEventListener("click", (e) => {
            e.stopPropagation(); // Évite de déclencher d'autres clics sur la page
            
            // On récupère uniquement le texte de l'élément PARENT (en enlevant le symbole du micro lui-même)
            let textToRead = element.innerText.replace("🎤", "").trim();
            
            speakText(textToRead);
        });

        // On injecte le bouton directement à l'intérieur de l'élément cible
        element.appendChild(microBtn);
    });

    // 2. Gestion de la mémoire de l'interrupteur (localStorage)
    if (localStorage.getItem("audioMode") === "enabled") {
        audioToggle.checked = true;
        document.body.classList.add("audio-mode-active");
    }

    // 3. Écouteur sur le Switch On/Off
    audioToggle.addEventListener("change", () => {
        if (audioToggle.checked) {
            document.body.classList.add("audio-mode-active");
            localStorage.setItem("audioMode", "enabled");
            speakText("Mode audio activé.");
        } else {
            document.body.classList.remove("audio-mode-active");
            localStorage.setItem("audioMode", "disabled");
            window.speechSynthesis.cancel(); // Coupe le son direct
        }
    });

    // 4. Fonction universelle pour faire parler le navigateur
    function speakText(text) {
        window.speechSynthesis.cancel(); // Stoppe la lecture précédente si elle existe

        if (text !== "") {
            const utterance = new SpeechSynthesisUtterance(text);
            utterance.lang = "fr-FR";
            utterance.rate = 1.0;
            window.speechSynthesis.speak(utterance);
        }
    }
});
