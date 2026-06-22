<?php
require_once __DIR__ . '/../Controllers/LoginController.php';
require_once __DIR__ . '/../Controllers/AdminController.php';
class Router
{

    public function start(string $url = '')
    {
        // Démarrage session
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Si pas d'URL passée en paramètre, on la lit depuis le serveur
        if ($url === '') {
            $basePath = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
            $chemin   = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $chemin   = '/' . trim(substr($chemin, strlen($basePath)), '/');
        } else {
            $chemin = $url;
        }

        if ($chemin === '/') {
            // Appel du Contrôleur de la page d'accueil
            require_once '../src/Controllers/HomeController.php';
            $controller = new HomeController();
            $controller->index();
        } elseif ($chemin === '/metiers') {
            require_once '../src/Models/MetierModel.php';
            require_once '../src/Controllers/MetierController.php';
            $controller = new MetierController();
            $controller->index();

        } elseif ($chemin === '/demo-assistant') {
            require_once '../src/Views/front/metiers/demo-assistant.php';

        } elseif (preg_match('#^/api/assistant/jobs/(\d+)$#', $chemin, $matches)) {
            require_once __DIR__ . '/../../config/database.php';
            require_once __DIR__ . '/../Models/AssistantIA/AssistantIAModel.php';
            require_once __DIR__ . '/../Controllers/AssistantIA/AssistantIAController.php';
            $controller = new \Controllers\AssistantIA\AssistantIAController(Database::getInstance());
            $controller->getJobs((int) $matches[1]);

        } elseif (preg_match('#^/api/assistant/(\d+)$#', $chemin, $matches)) {
            require_once __DIR__ . '/../../config/database.php';
            require_once __DIR__ . '/../Models/AssistantIA/AssistantIAModel.php';
            require_once __DIR__ . '/../Controllers/AssistantIA/AssistantIAController.php';
            $controller = new \Controllers\AssistantIA\AssistantIAController(Database::getInstance());
            $controller->getApps((int) $matches[1]);

        } elseif ($chemin === '/api/search') {
            require_once __DIR__ . '/../Controllers/SearchController.php';
            $controller = new SearchController();
            $controller->autocomplete();
        } elseif ($chemin === '/recherche') {
            require_once __DIR__ . '/../Controllers/SearchController.php';
            $controller = new SearchController();
            $controller->results();


            //Page admin dashbord
        } elseif ($chemin === '/admin/jobs') {
            require_once __DIR__ . '/../../config/database.php';

            require_once __DIR__ . '/../Models/Job/JobModel.php';
            require_once __DIR__ . '/../Models/Specialty/SpecialtyModel.php';

            require_once __DIR__ . '/../Controllers/job/AdminJobController.php';

            $db = Database::getInstance();
            $controller = new \Controllers\AdminJobController($db);
            $controller->index();


            //Page admin créer un métier
        } elseif ($chemin === '/admin/jobs/create') {
            require_once __DIR__ . '/../../config/database.php';
            require_once __DIR__ . '/../Models/Specialty/SpecialtyModel.php';

            require_once __DIR__ . '/../Controllers/specialty/AdminSpecialtyController.php';

            $db = Database::getInstance();
            $controller = new \Controllers\AdminSpecialtyController($db);
            $controller->create();

            //page spécialités
        } elseif ($chemin === '/admin/specialties') {

            require_once __DIR__ . '/../../config/database.php';
            require_once __DIR__ . '/../Models/Specialty/SpecialtyModel.php';
            require_once __DIR__ . '/../Controllers/specialty/AdminSpecialtyController.php';

            $db = Database::getInstance();

            $controller = new \Controllers\AdminSpecialtyController($db);
            $controller->index();


            //Page admin créer une spécialité
        } elseif ($chemin === '/admin/specialties/create') {
            require_once __DIR__ . '/../../config/database.php';
            require_once __DIR__ . '/../Models/Specialty/SpecialtyModel.php';


            require_once __DIR__ . '/../Controllers/specialty/AdminSpecialtyController.php';

            $db = Database::getInstance();
            $controller = new \Controllers\AdminSpecialtyController($db);
            $controller->create();

            //Page admin éditer un métier
            /*} elseif (preg_match('#^/admin/jobs/(\d+)/edit$#', $chemin, $matches)) {
            // L'ID capturé dans l'URL se trouve dans $matches[1]
            $id = (int) $matches[1];

            require_once __DIR__ . '/../../config/database.php';
            require_once __DIR__ . '/../Models/Job/JobModel.php';
            require_once __DIR__ . '/../Models/Specialty/SpecialtyModel.php'; // On le charge au cas où le formulaire d'édition en ait besoin pour un menu déroulant
            require_once __DIR__ . '/../Controllers/job/AdminJobController.php';

            $db = Database::getInstance();
            $controller = new \Controllers\AdminJobController($db);
            $controller->edit($id);*/


            //Page admin supprimer un métier
            /*} elseif (preg_match('#^/admin/jobs/(\d+)/delete$#', $chemin, $matches)) {
            // L'ID capturé dans l'URL se trouve dans $matches[1]
            $id = (int) $matches[1];

            require_once __DIR__ . '/../../config/database.php';
            require_once __DIR__ . '/../Models/Job/JobModel.php';
            require_once __DIR__ . '/../Controllers/job/AdminJobController.php';

            $db = Database::getInstance();
            $controller = new \Controllers\AdminJobController($db);
            $controller->delete($id);*/


            //Page ajouter des events
            /*} elseif ($chemin === '/admin/evenements/ajouter') {
            require_once __DIR__ . '/../../config/database.php';
            require_once __DIR__ . '/../Models/Event.php'; // D'après la ligne 11 de son code
            require_once __DIR__ . '/../Controllers/EventController.php';

            $db = Database::getInstance();

            $controller = new \EventController($db);
            
            $controller->create();*/


            //Partie Questionnaire d'orientation
        } elseif ($chemin === '/api/orientation/questions') {
            require_once __DIR__ . '/../Controllers/OrientationController.php';
            $controller = new OrientationController();
            $controller->questions();
        } elseif ($chemin === '/api/orientation/result') {
            require_once __DIR__ . '/../Controllers/OrientationController.php';
            $controller = new OrientationController();
            $controller->result();



            // --- ROUTES LOGIN ADMIN ---
        } elseif ($chemin === '/login') {
            $controller = new LoginController();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->handleLogin();
            } else {
                $controller->showLoginPage();
            }
        } elseif ($chemin === '/forgot-password') {
            $controller = new LoginController();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->handleForgotPassword();
            } else {
                $controller->showForgotPassword();
            }
        } elseif ($chemin === '/reset-password') {
            $controller = new LoginController();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->handleResetPassword();
            } else {
                $controller->showResetPassword();
            }
        } elseif ($chemin === '/new-password') {
            $controller = new LoginController();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->handleNewPassword();
            } else {
                $controller->showNewPassword();
            }
        } elseif ($chemin === '/admin/dashboard') {
            $controller = new AdminController();
            $controller->dashboard();
        } elseif ($chemin === '/logout') {
            $controller = new LoginController();
            $controller->logout();
        } else {
            http_response_code(404);
            require_once __DIR__ . '/../Views/errors/404.php';
        }
    }
}
