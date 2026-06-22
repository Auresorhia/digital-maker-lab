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
        $url = str_replace('{id}',   '([0-9]+)',     $url);
        $url = str_replace('{slug}', '([a-z0-9-]+)', $url);

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
    public function dispatch(string $uri, string $requestMethod): void
    {
        $uri = strtok($uri, '?');

        foreach ($this->routes as $route) {
            if ($route['method'] === $requestMethod && preg_match($route['url'], $uri, $matches)) {
                array_shift($matches);

                $controllerName = "\\Controllers\\" . $route['controller'];
                $controller = new $controllerName();

                call_user_func_array([$controller, $route['action']], $matches);
                return;
            }
        }

        http_response_code(404);
        require_once __DIR__ . '/../Views/errors/404.php';
    }
}