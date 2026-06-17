<?php
class Router
{

    public function start(string $url)
    {
        $chemin = $url;

        // Le Routage
        if ($chemin === '/') {
            // Appel du Contrôleur de la page d'accueil
            require_once '../src/Controllers/HomeController.php';
            $controller = new HomeController();
            $controller->index();
        } elseif ($chemin === '/metiers') {
            echo "Voici la page des métiers";
        } elseif ($chemin === '/api/search') {
            require_once __DIR__ . '/../Controllers/SearchController.php';
            $controller = new SearchController();
            $controller->autocomplete();
        } else {
            echo "<h1>Erreur 404</h1><p>Page introuvable.</p>";
        }
    }
}
