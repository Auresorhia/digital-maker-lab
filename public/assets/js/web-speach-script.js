document.addEventListener("DOMContentLoaded", () => {
    const audioToggle = document.getElementById("audio-toggle");
    
    if (!audioToggle) return;

    // 1. Trouver et préparer tous les éléments cibles
    const audioElements = document.querySelectorAll(".audio-target");
    
    audioElements.forEach(element => {
        const microBtn = document.createElement("button");
        microBtn.type = "button";
        microBtn.className = "audio-micro-btn";
        microBtn.innerText = "🔊";
        microBtn.setAttribute("aria-label", "Écouter le texte");

        microBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            
            // SECURITY CHECK : Si le mode audio n'est pas actif sur le site, on ne fait rien !
            if (!document.body.classList.contains("audio-mode-active")) {
                return; 
            }
            
            let textToRead = element.innerText.replace("🎤", "").trim();
            speakText(textToRead);
        });

        element.appendChild(microBtn);
    });

    // 2. Vérifier la mémoire locale (localStorage)
    if (localStorage.getItem("audioMode") === "enabled") {
        document.body.classList.add("audio-mode-active");
        audioToggle.classList.add("is-active"); 
    }

    // 3. Gestion du clic sur le bouton ☎
    audioToggle.addEventListener("click", (e) => {
        e.preventDefault(); 

        const isActive = document.body.classList.toggle("audio-mode-active");
        audioToggle.classList.toggle("is-active", isActive);

        if (isActive) {
            localStorage.setItem("audioMode", "enabled");
            speakText("Mode audio activé.");
        } else {
            localStorage.setItem("audioMode", "disabled");
            window.speechSynthesis.cancel(); 
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