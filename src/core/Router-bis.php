<?php
namespace Core;

class Router
{
    private array $routes = [];

    /**
     * Enregistre une route (GET ou POST)
     */
    public function add(string $method, string $url, string $controller, string $action): void
    {
        // On transforme les "{id}" en ([0-9]+) pour capter les nombres dans l'URL
        $url = preg_replace('/\{id\}/', '([0-9]+)', $url);
        
        $this->routes[] = [
            'method'     => strtoupper($method),
            'url'        => '#^' . $url . '$#',
            'controller' => $controller,
            'action'     => $action
        ];
    }

    /**
     * Analyse l'URL actuelle et lance le bon contrôleur
     */
    public function dispatch(string $uri, string $requestMethod, \PDO $db): void
    {
        // On nettoie l'URL (on enlève les paramètres après le ?)
        $uri = strtok($uri, '?');

        foreach ($this->routes as $route) {
            // Si la méthode (GET/POST) et l'URL correspondent au pattern
            if ($route['method'] === $requestMethod && preg_match($route['url'], $uri, $matches)) {
                
                // On retire le premier élément (qui est l'URL complète) pour ne garder que l'ID
                array_shift($matches); 

                // On instancie le contrôleur dynamiquement
                $controllerName = "\\Controllers\\" . $route['controller'];
                $controller = new $controllerName($db);
                
                // On appelle la méthode (ex: edit) en lui passant l'ID s'il existe
                call_user_func_array([$controller, $route['action']], $matches);
                return;
            }
        }

        // Si aucune route ne correspond : 404
        http_response_code(404);
        echo "<h1 style='text-align:center;margin-top:50px;'>Erreur 404 : Page introuvable</h1>";
    }
}