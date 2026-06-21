document.addEventListener("DOMContentLoaded", () => {
    const audioToggle = document.getElementById("audio-toggle");
    
    if (!audioToggle) return;

    // FIX : Déclaration indispensable de la variable pour récupérer les cibles !
    const audioElements = document.querySelectorAll(".audio-target");

    // 1. Préparer tous les éléments cibles
    audioElements.forEach(element => {
        const microBtn = document.createElement("button");
        microBtn.type = "button";
        microBtn.className = "audio-micro-btn";
        
        // MODIFICATION : Colle ici le code SVG récupéré de Figma pour l'icône volume
        microBtn.innerHTML = `
            <svg class="audio-icon-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" fill="currentColor">
                <path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02z"/>
            </svg>
        `;
        microBtn.setAttribute("aria-label", "Écouter le texte");

        microBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            
            if (!document.body.classList.contains("audio-mode-active")) {
                return; 
            }
            
            let textToRead = element.textContent.replace(/[\r\n]+/g, " ").replace(/\s+/g, " ").trim();
            speakText(textToRead);
        });

        element.appendChild(microBtn);
    });

    // 2. Vérifier la mémoire locale (localStorage)
    if (localStorage.getItem("audioMode") === "enabled") {
        document.body.classList.add("audio-mode-active");
        audioToggle.classList.add("is-active"); 
    }

    // 3. Gestion du clic sur le casque
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