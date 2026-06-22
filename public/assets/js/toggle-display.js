"use strict";
// On s'assure que le HTML est totalement chargé avant d'exécuter le script
document.addEventListener('DOMContentLoaded', function() {
    
    const toggleButtons = document.querySelectorAll('.toggle-btn');

    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            
            const id = this.getAttribute('data-id');
            let currentDisplay = parseInt(this.getAttribute('data-display'));
            const imgElement = this.querySelector('img');

            // Envoi de la requête AJAX
            fetch(`/test_admin_specialties.php?action=toggle&id=${id}`, {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Mise à jour de l'affichage
                    const newDisplay = currentDisplay === 1 ? 0 : 1;
                    this.setAttribute('data-display', newDisplay);

                    if (newDisplay === 1) {
                        imgElement.src = '/assets/images/icons/icon-eye-opened.svg';
                    } else {
                        imgElement.src = '/assets/images/icons/icon-eye-closed.svg';
                    }
                } else {
                    alert("Une erreur est survenue lors de la mise à jour.");
                }
            })
            .catch(error => {
                console.error("Erreur Fetch:", error);
            });
        });
    });
    
});