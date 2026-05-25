<?php
class Router {

    public function start() {
        // On lit le chemin demandé dans l'URL
        $chemin = $_SERVER['REQUEST_URI'];

        if ($chemin === '/') {// peut-être mettre un switch...bon ça à voir après
            echo "Voici la page d'accueil";
        } elseif ($chemin === '/metiers') {
            echo "Voici la page des métiers";
        }
    }
}