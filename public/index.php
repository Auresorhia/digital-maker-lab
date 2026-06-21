<?php

session_start();

// On allume le moteur en appelant le fichier Router
require_once '../src/core/Router.php';

// On prépare l'URL nettoyée avant de la passer au routeur
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$basePath = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
if (str_starts_with($uri, $basePath)) {
    $uri = substr($uri, strlen($basePath));
}
$uri = '/' . trim($uri, '/');

// On dit au Routeur de faire son travail
$router = new Router();
$router->start($uri);
