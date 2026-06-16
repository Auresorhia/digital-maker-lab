<?php

// On allume le moteur en appelant le fichier Router
require_once '../src/core/Router.php';

// On dit au Routeur de faire son travail
$router = new Router();
$router->start();

?>
