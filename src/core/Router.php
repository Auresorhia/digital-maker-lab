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
        } elseif ($chemin === '/demo-assistant') {
            require_once '../src/Views/front/metiers/demo-assistant.php';
        } elseif (preg_match('#^/api/assistant/jobs/(\d+)$#', $chemin, $matches)) {
            require_once '../config/database.php';
            require_once '../src/Models/AssistantIA/AssistantIAModel.php';
            require_once '../src/Controllers/AssistantIA/AssistantIAController.php';
            $controller = new \Controllers\AssistantIA\AssistantIAController(Database::getInstance());
            $controller->getJobs((int) $matches[1]);
        } elseif (preg_match('#^/api/assistant/(\d+)$#', $chemin, $matches)) {
            require_once '../config/database.php';
            require_once '../src/Models/AssistantIA/AssistantIAModel.php';
            require_once '../src/Controllers/AssistantIA/AssistantIAController.php';
            $controller = new \Controllers\AssistantIA\AssistantIAController(Database::getInstance());
            $controller->getApps((int) $matches[1]);
        } else {
            echo "<h1>Erreur 404</h1><p>Page introuvable.</p>";
        }
    }
}
