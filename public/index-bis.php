<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 1. Inclusions de sécurité (Puisque tes namespaces ne suivent pas tous l'arborescence)
require_once '../src/Core/Router.php';
require_once '../src/Models/Job/JobModel.php';
require_once '../src/Models/Specialty/SpecialtyModel.php';
require_once '../src/Controllers/specialty/AdminSpecialtyController.php';
require_once '../src/Controllers/job/AdminJobController.php';

// 2. Connexion unique à la BDD
try {
    $db = new PDO("mysql:host=127.0.0.1;port=8889;dbname=digital_maker_lab;charset=utf8", "root", "root");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erreur BDD : " . $e->getMessage());
}

// 3. Initialisation du Routeur
$router = new \Core\Router();

// --- CARTOGRAPHIE DE TES URLS (ROUTES) ---

// Routes pour les Spécialités
$router->add('GET',  '/admin/specialties',             'AdminSpecialtyController', 'index');
$router->add('GET',  '/admin/specialties/create',      'AdminSpecialtyController', 'create');
$router->add('POST', '/admin/specialties/store',       'AdminSpecialtyController', 'store');
$router->add('GET',  '/admin/specialties/{id}/edit',   'AdminSpecialtyController', 'edit');
$router->add('POST', '/admin/specialties/{id}/update', 'AdminSpecialtyController', 'update');
$router->add('POST', '/admin/specialties/{id}/toggle', 'AdminSpecialtyController', 'toggle'); // Pour l'œil en AJAX
$router->add('GET',  '/admin/specialties/{id}/delete', 'AdminSpecialtyController', 'delete');

// Routes pour les Métiers
$router->add('GET',  '/admin/jobs',             'AdminJobController', 'index');
$router->add('GET',  '/admin/jobs/create',      'AdminJobController', 'create');
$router->add('POST', '/admin/jobs/store',       'AdminJobController', 'store');
$router->add('GET',  '/admin/jobs/{id}/edit',   'AdminJobController', 'edit');
$router->add('POST', '/admin/jobs/{id}/update', 'AdminJobController', 'update');
$router->add('POST', '/admin/jobs/{id}/toggle', 'AdminJobController', 'toggle'); // Pour l'œil en AJAX
$router->add('GET',  '/admin/jobs/{id}/delete', 'AdminJobController', 'delete');

// 4. Exécution du Routeur
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD'], $db);