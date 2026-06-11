<?php

require_once __DIR__ . '/../../src/Controllers/SearchController.php';

$controller = new SearchController();
$controller->autocomplete();
