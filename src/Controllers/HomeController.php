<?php

class HomeController {
    
    // Méthode par défaut pour la page d'accueil
    public function index() {
        // On appelle la vue correspondante
        require_once '../src/Views/front/home.php';
    }
}
?>