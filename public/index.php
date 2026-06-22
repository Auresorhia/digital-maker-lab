<?php
session_start();

// --- Noyau ---
require_once '../config/database.php';
require_once '../src/core/Router.php';
require_once '../src/core/Controller.php';
require_once '../src/core/Model.php';

// --- Modèles ---
require_once '../src/Models/MetierModel.php';
require_once '../src/Models/AdminModel.php';
require_once '../src/Models/Job/JobModel.php';
require_once '../src/Models/Specialty/SpecialtyModel.php';
require_once '../src/Models/AssistantIA/AssistantIAModel.php';
require_once '../src/Models/Test-dorientation/OrientationQuestionnaireModel.php';

// --- Contrôleurs ---
require_once '../src/Controllers/HomeController.php';
require_once '../src/Controllers/FinderController.php';
require_once '../src/Controllers/SearchController.php';
require_once '../src/Controllers/JobSheetController.php';
require_once '../src/Controllers/LoginController.php';
require_once '../src/Controllers/AdminController.php';
require_once '../src/Controllers/OrientationController.php';
require_once '../src/Controllers/job/AdminJobController.php';
require_once '../src/Controllers/specialty/AdminSpecialtyController.php';
require_once '../src/Controllers/AssistantIA/AssistantIAController.php';

// --- Routeur ---
$router = new \Core\Router();

// Routes frontend
$router->add('GET', '/',              'HomeController',   'index');
$router->add('GET', '/metiers',       'FinderController', 'index');
$router->add('GET', '/metiers/{slug}','JobSheetController','show');
$router->add('GET', '/api/search',    'SearchController', 'autocomplete');
$router->add('GET', '/recherche',     'SearchController', 'results');

// Routes orientation
$router->add('GET',  '/api/orientation/questions', 'OrientationController', 'questions');
$router->add('POST', '/api/orientation/result',    'OrientationController', 'result');

// Routes assistant IA
$router->add('GET', '/api/assistant/apps/{id}', 'AssistantIA\\AssistantIAController', 'getApps');
$router->add('GET', '/api/assistant/jobs/{id}', 'AssistantIA\\AssistantIAController', 'getJobs');

// Routes login / auth
$router->add('GET',  '/login',           'LoginController', 'showLoginPage');
$router->add('POST', '/login',           'LoginController', 'handleLogin');
$router->add('GET',  '/logout',          'LoginController', 'logout');
$router->add('GET',  '/forgot-password', 'LoginController', 'showForgotPassword');
$router->add('POST', '/forgot-password', 'LoginController', 'handleForgotPassword');
$router->add('GET',  '/reset-password',  'LoginController', 'showResetPassword');
$router->add('POST', '/reset-password',  'LoginController', 'handleResetPassword');
$router->add('GET',  '/new-password',    'LoginController', 'showNewPassword');
$router->add('POST', '/new-password',    'LoginController', 'handleNewPassword');
$router->add('GET',  '/admin/dashboard', 'AdminController', 'dashboard');

// Routes admin — spécialités
$router->add('GET',  '/admin/specialties',             'AdminSpecialtyController', 'index');
$router->add('GET',  '/admin/specialties/create',      'AdminSpecialtyController', 'create');
$router->add('POST', '/admin/specialties/store',       'AdminSpecialtyController', 'store');
$router->add('GET',  '/admin/specialties/{id}/edit',   'AdminSpecialtyController', 'edit');
$router->add('POST', '/admin/specialties/{id}/update', 'AdminSpecialtyController', 'update');
$router->add('POST', '/admin/specialties/{id}/toggle', 'AdminSpecialtyController', 'toggle');
$router->add('GET',  '/admin/specialties/{id}/delete', 'AdminSpecialtyController', 'delete');

// Routes admin — métiers
$router->add('GET',  '/admin/jobs',             'AdminJobController', 'index');
$router->add('GET',  '/admin/jobs/create',      'AdminJobController', 'create');
$router->add('POST', '/admin/jobs/store',       'AdminJobController', 'store');
$router->add('GET',  '/admin/jobs/{id}/edit',   'AdminJobController', 'edit');
$router->add('POST', '/admin/jobs/{id}/update', 'AdminJobController', 'update');
$router->add('POST', '/admin/jobs/{id}/toggle', 'AdminJobController', 'toggle');
$router->add('GET',  '/admin/jobs/{id}/delete', 'AdminJobController', 'delete');

// --- Dispatch ---
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$basePath = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
if (str_starts_with($uri, $basePath)) {
    $uri = substr($uri, strlen($basePath));
}
$uri = '/' . trim($uri, '/');

$router->dispatch($uri, $_SERVER['REQUEST_METHOD']);