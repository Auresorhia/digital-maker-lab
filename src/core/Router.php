<?php
class Router
{

    public function start()
    {
        // 1. On lit le chemin demandé dans l'URL
        $chemin = $_SERVER['REQUEST_URI'];

        // 2. DÉTECTION DYNAMIQUE : On trouve le dossier de base automatiquement
        $basePath = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);

        // 3. On soustrait la base du chemin pour ne garder que la route pure (ex: /metiers)
        if (substr($chemin, 0, strlen($basePath)) == $basePath) {
            $chemin = substr($chemin, strlen($basePath));
        }

        // 4. On nettoie l'URL (paramètres ?id=1) et on sécurise le premier slash
        $chemin = parse_url($chemin, PHP_URL_PATH);
        $chemin = '/' . trim($chemin, '/');

        // 5. Le Routage
        if ($chemin === '/') {
            // Appel du Contrôleur de la page d'accueil
            require_once '../src/Controllers/HomeController.php';
            $controller = new HomeController();
            $controller->index();
        } elseif ($chemin === '/metiers') {
            echo "Voici la page des métiers";
        } else {
            echo "<h1>Erreur 404</h1><p>Page introuvable.</p>";
        }
    }
}
