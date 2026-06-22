document.addEventListener('DOMContentLoaded', function() {
    
    const toggleButtons = document.querySelectorAll('.toggle-btn');

    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            
            const id = this.getAttribute('data-id');
            const type = this.getAttribute('data-type'); // Récupère 'job' ou 'specialty'
            let currentDisplay = parseInt(this.getAttribute('data-display'));
            const imgElement = this.querySelector('img');

            // On construit la "belle URL" prise en charge par le Routeur
            const urlTarget = (type === 'job') ? `/admin/jobs/${id}/toggle` : `/admin/specialties/${id}/toggle`;

            // Envoi de la requête AJAX vers la bonne URL
            fetch(urlTarget, {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
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